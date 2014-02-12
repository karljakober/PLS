"""
This Fabfile contains the bootstrap and deploy methods plus related
subroutines required to deploy the PLS website.

`bootstrap` and `deploy` are executed as the command line ``fab`` program
and takes care of setting up a new system, installing required libraries
or programs, setting up the server, and deploying the newest version of the
website from github.

`fab environment action`

Available Environments:     Available Actions:
dev                         bootstrap:  Sets up system by installing programs,
production                              runs deploy afterwards
staging                     deploy:     uploads conf/ files and gets newest code 
tempdev <will be deleted>               from github 
                            get_database:will get the database rip from that
                                        server and store it in conf/
                            put_templates:will upload the newest templates from
                                          the conf/ directory

Useful commands:
`fab dev bootstrap` : this will install PLS
                      locally
`fab dev deploy` : this should be used to update to the newest version of the
                   website locally
`fab production deploy` : deploys the newest vers
ion of the website LIVE

The other callables defined in this module are internal only.
"""

from __future__ import with_statement
from fabric.contrib.files import exists, append, upload_template
from fabric.contrib.project import rsync_project
from fabric.colors import white, blue, red
from fabric.api import env, run as _run, sudo, local, put, cd, settings, hide, prompt, get
from fabric.utils import puts
from pprint import pprint

import time
import os
import string
import random

#environment variables shared
env.debug = False
env.project_name = 'PLS'
env.project_title = 'Pong Lan Software'
env.repository = 'git@github.com:KarlJakober/%s.git' % env.project_name
env.branch = "master"
env.db_root_password = None
env.templates = {}
env.colors = True
env.bootstrapping = False

def config_templates():
    env.templates = {
    "apache": {
        "local_path": "conf/vhosts.conf",
        "remote_directory": "/etc/apache2/sites-available/%s/"
            % env.project_name,
        "remote_path": "/etc/apache2/sites-available/%s"
            % env.project_name,
    },
    "config": {
        "local_path": "conf/envconfig.php",
        "remote_directory": "%s/app/Config/" % env.project_directory,
        "remote_path": "%s/app/Config/envconfig.php" % env.project_directory,
    },
}

def dev():
    env.name = 'development'
    env.db_name = 'pls_development'
    env.db_user = env.user
    env.db_password = 'devpassword'
    env.domain = 'localhost'
    env.hosts = [env.domain]
    env.debug = True
    env.project_directory = '/home/%s/%s' % (env.user, env.project_name)
    env.project_root = '/home/%s' % env.user
    env.is_live = 0
    config_templates()

def apt(packages):
    return sudo("apt-get install -y -q " + packages)

def run(command, show=True):
    with hide("running"):
        return _run(command)

def bootstrap():
    print(white("Creating environment %s" % env.name))

    """
    Runs once
    """
    sudo("apt-get update")
    
    #install vim to help edit files faster
    apt("vim")

    #install apc prerequisites
    apt("make libpcre3 libpcre3-dev re2c")
    
    #install_dependencies and lamp
    apt("tasksel rsync")
    apt("apache2 libapache2-mod-php5 mysql-server libapache2-mod-auth-mysql \
            php5-mysql")
    sudo("a2enmod php5")
    sudo("a2enmod rewrite") 
    sudo("a2enmod headers")
    sudo("a2enmod expires")

    #make sure we have curl instlalled before we restart the server
    apt("curl libcurl3 libcurl3-dev php5-curl")

    #ensure apache is started at this point
    restart_server()

    apt("php-pear php5-dev")

    #run this AFTER we install apache, or the following error will happen
    #apache2: Could not reliably determine the server's fully qualified domain name, using 127.0.1.1 for ServerName
    sudo('''sh -c "echo 'ServerName PLS' > /etc/apache2/httpd.conf"''')

    #install git
    apt("git-core")

    #install cakephp command line tools
    apt("cakephp-scripts")

    git_website()

    #set variable so it wont run git commands twice if we bootstrap
    env.bootstrapping = True

    init_db()

    deploy()
    
    create_required_folders()
    

def deploy():
    #UPDATE the server with the newest updates from github.

    print(white("Updating environment %s" % env.name))

    if env.bootstrapping == False:
        git_website()
        create_required_folders()

    #put new templates up every time
    put_templates()

    #make sure we have ssl enabled
    sudo('a2enmod ssl') 
        
    #make sure correct apache symlinks are created
    #and proper deploy config is loaded
    sudo('a2ensite %s' % env.project_name)

    #disable the default website
    sudo('a2dissite default')

    restart_server()

    upgrade_schema()


def start_server():
    #starts apache and mysql
    try:
        sudo("apache2ctl -k start", pty=False)
    except:
        pass

def stop_server():
    #stops apache and mysql
    try:
        sudo("apache2ctl -k stop", pty=False)
    except:
        pass


def restart_server():
    #this command will restart apache if it is running, and start it if it is not running
    sudo("apache2ctl -k restart", pty=False) #running this command after the system is up causes an issue, since the "service apache2 start" command does not work in this script, can we check if apache is running and skip


def create_required_folders():
    #make sure temp directory exists
    if not exists("%s/app/tmp/" % env.project_directory):
        with cd("%s/app/" % env.project_directory):
            sudo("mkdir tmp")

    if not exists("%s/app/tmp/cache/" % env.project_directory):
        with cd("%s/app/tmp/" % env.project_directory):
            sudo("mkdir cache")

    if not exists("%s/app/tmp/cache/persistent/" % env.project_directory):
        with cd("%s/app/tmp/cache/" % env.project_directory):
            sudo("mkdir persistent")

    if not exists("%s/app/tmp/cache/models/" % env.project_directory):
        with cd("%s/app/tmp/cache/" % env.project_directory):
            sudo("mkdir models")

    #make sure log directory exists in temp directory
    if not exists("%s/app/tmp/logs/" % env.project_directory):
        with cd("%s/app/tmp/" % env.project_directory):
            sudo("mkdir logs")

    if not exists("%s/log" % env.project_directory):
        with cd("%s" % env.project_directory):
            sudo("mkdir log")

    if not exists("%s/log/pls-error.log" % env.project_directory):
        with cd("%s/log" % env.project_directory):
            sudo("touch pls-error.log")


    #ensure temp directory is writable
    with cd("%s/app/" % env.project_directory):
        sudo("chmod 777 -R tmp/")

    #ensure log directory is writable
    with cd("%s/" % env.project_directory):
        sudo("chmod 777 -R log/")


def init_db():
    mysql_create_user(env.db_user, env.db_password)

    try:
        run('mysqladmin -u %s -p%s create %s' % (env.db_user, env.db_password, env.db_name))
    except:
        pass

    #put("conf/mysql-restore.sql", "/tmp/mysql-restore.sql")    
    #run("mysql -u %s -p%s %s < /tmp/mysql-restore.sql" % (env.db_user, env.db_password, env.db_name))

def git_website():
    #if the directory doesnt exist, clone the repository
    if not exists("%s" % env.project_directory):
        #TODO: do a more proper clone, so it doesnt say x commits ahead of origin/2.0
        with cd("%s" % env.project_root):
            #TODO: set up known_hosts before cloning to bypass key/security prompt
            run("git clone %s" % env.repository)
        #ensure we are in the right branch!
        with cd("%s" % env.project_directory):
            run("git checkout %s" % env.branch)

    #if the directory does exist, just fetch updates
    else:
        #ensure we are in the right branch!
        with cd("%s" % env.project_directory):
            run("git remote update")

            run("git checkout %s" % env.branch)
            #make sure we dont have any non-overwritable local changes
            #TODO, remove envconfig.php from repo, and remove the reset and clean commands.
            run("git reset --hard HEAD")
            #clean any untracked files so we have no conflicts
            run("git clean -f")
            run("git checkout %s" % env.branch)
            #then pull
            run("git pull %s %s" % (env.repository, env.branch))


def backup_database():
    date = time.strftime('%F-%H%M%S')

    filename = '/backups/%(environment)s/%(date)s-%(database)s-backup.sql.gz'\
        % {
        'environment': env.user,
        'database': env.db_name,
        'date': date,
        }

    if exists(filename):
        run('rm "%s"' % filename)

    run('mysqldump -u %(username)s -p %(password)s %(database)s | '
        'gzip > %(filename)s' % {'username': env.db_user,
        'password': env.db_password,
        'database': env.db_name,
        'filename': filename})


def restore_latest_backup():
    # TODO: use 'with cd(' if possible
    run('cd backups/%(environment)s | gunzip < $(ls -1 | tail -n 1) | \
            mysql -u %(username)s -p %(password)s %(database)s' %
        {'environment': env.user,
        'username': env.db_user,
        'password': env.db_password,
        'database': env.db_name})
    run('cd ../..')


def put_templates():
    for name in get_templates():
        upload_environment_templates(name)


def get_templates():
    """
    Injects environment varialbes into config templates
    """
    injected = {}
    for name, data in env.templates.items():
        injected[name] = dict([(k, v % env) for k, v in data.items()])
    return injected


def upload_environment_templates(name):
    print(blue("Uploading template: %s" % name))
    
    template = get_templates()[name]
    local_path = template["local_path"]
    remote_directory = template["remote_directory"]
    remote_path = template["remote_path"]
    owner = template.get("owner")
    mode = template.get("mode")
    
    print(blue("Found template: %s" % name))

    if not exists("%s" % remote_directory):
        sudo("mkdir %s" % remote_directory)

    upload_template(local_path, remote_path, env, use_sudo=True, backup=False)
    if owner:
        sudo("chown %s %s" % (owner, remote_path))
    if mode:
        sudo("chmod %s %s" % (mode, remote_path))

    print(blue("Uploaded template: %s" % name))

def generate_schema():
    with cd("%s/app/" % env.project_directory):
        run("Console/cake schema generate -f")

def add_user(user):
    sudo('useradd %s -s /bin/bash -m' % user)
    sudo('echo "%s ALL=(ALL) ALL" >> /etc/sudoers' % user)
    password = ''.join(random.choice(string.ascii_uppercase + string.digits) for x in range(8))
    sudo('echo "%s:%s" | chpasswd' % (user, password))
    print(red("Password for %s is %s" % (user, password)))

def mysql_create_user(db_user=None, db_password=None):
    """ Creates mysql user. """
    if _mysql_user_exists(db_user):
        puts('User %s already exists' % db_user)
        return

    sql = "GRANT ALL ON %s.* TO '%s'@'localhost' IDENTIFIED BY '%s';" % (env.db_name, db_user, db_password)

    mysql_execute(sql, 'root')


def _mysql_user_exists(db_user):
    sql = "SHOW GRANTS FOR '%s'@localhost" % db_user
    with settings(hide('warnings', 'running', 'stdout', 'stderr'), warn_only=True):
        result = mysql_execute(sql, 'root')
    return result.succeeded


def mysql_execute(sql, user=None, password=None):
    """ Executes passed sql command using mysql shell. """
    user = user or env.db_user

    if user == 'root' and password is None:
        password = _get_root_password()
    elif password is None:
        password = env.db_password

    sql = sql.replace('"', r'\"')
    return run('echo "%s" | mysql --user="%s" --password="%s"' % (sql, user , password))


def _get_root_password():
    """Ask root password only once if needed"""
    if env.db_root_password is None:
        env.db_root_password = prompt('Please enter MySQL root password:')
    return env.db_root_password


def get_database():
    with cd("~"):
        run("mysqldump -u %s -p%s %s >> mysql-restore.sql" 
        % (env.db_user, env.db_password, env.db_name))
        get("~/mysql-restore.sql", "conf/mysql-restore.sql")
        run("rm ~/mysql-restore.sql")

def upgrade_schema():
    with cd("%s" % env.project_directory):
        run('app/Console/cake Migrations.migration run all')