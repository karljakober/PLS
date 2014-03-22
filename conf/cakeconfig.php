<?php
//PLS database information
define('MYSQL_HOST', 'localhost');
define('MYSQL_LOGIN', '%(db_user)s');
define('MYSQL_PASSWORD', '%(db_password)s');
define('MYSQL_DATABASE', '%(db_name)s');

//Forum bridge database information
define('FORUM_HOST', '');
define('FORUM_LOGIN', '');
define('FORUM_PASSWORD', '');
define('FORUM_DATABASE', '');

//Define this so your database datetimes match up with your app properly.
define('DEFAULT_TIMEZONE', 'UTC');
?>