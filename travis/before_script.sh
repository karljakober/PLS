#!/bin/bash

if [ "$PHPCS" = '1' ]; then
    pear channel-discover pear.cakephp.org
    pear install --alldeps cakephp/CakePHP_Codesniffer
    phpenv rehash
    exit 0
fi

composer self-update

sudo mkdir ./vendors
sudo chmod -R 777 ./vendors
sudo mkdir ./app/tmp
sudo mkdir ./app/tmp/cache
sudo mkdir ./app/tmp/cache/models
sudo mkdir ./app/tmp/cache/persistent
sudo mkdir ./app/tmp/logs
sudo mkdir ./app/tmp/tests
sudo chmod -R 777 ./app/tmp

if [ '$DB' = 'mysql' ]; then
    mysql -e 'CREATE DATABASE cakephp_test; USE cakephp_test; CREATE TABLE testtable (id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT, name VARCHAR(40) NOT NULL, PRIMARY KEY (id));'
fi

if [ '$DB' = 'pgsql' ]; then
    psql -c 'CREATE DATABASE cakephp_test;' -U postgres;
fi

composer install --dev --no-interaction --prefer-source;

if [ "$COVERALLS" = '1' ]; then
    composer require --dev satooshi/php-coveralls:dev-master
fi

if [ "$PHPCS" != '1' ]; then
    composer global require 'phpunit/phpunit=3.7.33'
    ln -s ~/.composer/vendor/phpunit/phpunit/PHPUnit ./lib/PHPUnit
fi

phpenv rehash

set +H

echo "# for php-coveralls
src_dir: ./app
coverage_clover: build/logs/clover.xml
json_path: build/logs/coveralls-upload.json" > ./.coveralls.yml

echo "<?php
   class DATABASE_CONFIG {
     public \$default = array(
          'datasource' => 'Database/Mysql',
          'database' => 'cakephp_test',
          'host' => '127.0.0.1',
          'login' => 'root',
          'password' => '',
          'persistent' => false,
     );
     public \$test = array(
          'datasource' => 'Database/Mysql',
          'database' => 'cakephp_test',
          'host' => '127.0.0.1',
          'login' => 'root',
          'password' => '',
          'persistent' => false,
     );
   }
   define('DEFAULT_TIMEZONE', 'US/Central');" > ./app/Config/database.php
