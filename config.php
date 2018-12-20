<?php
define('CMSIF_WEBROOT', __DIR__);
define('CMSIF_COOKIE_LTIME', 3600);
define('CMSIF_TIMEZONE', 'Europe/Rome');
define('CMSIF_DEFAULT_LANG', 'en');

define('CMSIF_FILES', __DIR__.'/__FILES__/');
define('CMSIF_MODULES', __DIR__.'/__MODULES__/');
define('CMSIF_TEMPLATES', __DIR__.'/__TEMPLATES__/');

//DB
define('CMSIF_DB_HOST', 'localhost');
define('CMSIF_DB_USER', 'root');
define('CMSIF_DB_PASS', 'toor');
define('CMSIF_DB_NAME', 'app');

header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time() - 3600));