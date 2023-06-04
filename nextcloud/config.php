<?php
$CONFIG = array (
  'htaccess.RewriteBase' => '/',
  'memcache.local' => '\\OC\\Memcache\\APCu',
  'apps_paths' =>
  array (
    0 =>
    array (
      'path' => '/var/www/html/apps',
      'url' => '/apps',
      'writable' => false,
    ),
    1 =>
    array (
      'path' => '/var/www/html/custom_apps',
      'url' => '/custom_apps',
      'writable' => true,
    ),
  ),
  'instanceid' => 'ocnq50zgl0ws',
  'passwordsalt' => 'U4MnL99/lsW9kUWNJ43gr26ArlrhVS',
  'secret' => 'lxtQfQU9C2xbsPnomeIO5dn2oWEkYxmngM8iLPQmgN2El8jr',
  'trusted_domains' => array_filter(array_map('trim', explode(' ', getenv('TRUSTED_DOMAINS')))),
  'datadirectory' => '/var/www/html/data',
  'dbtype' => 'mysql',
  'version' => '26.0.1.1',
  'overwrite.cli.url' => 'http://' . getenv('APPLICATION_HOST'),
  'dbname' => getenv('MYSQL_DATABASE'),
  'dbhost' => getenv('MYSQL_HOST'),
  'dbport' => '',
  'dbtableprefix' => 'oc_',
  'mysql.utf8mb4' => true,
  'dbuser' => getenv('MYSQL_USER'),
  'dbpassword' => getenv('MYSQL_PASSWORD'),
  'installed' => true,
);
