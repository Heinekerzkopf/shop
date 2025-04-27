<?php

define("DEBUG", 1);
define("ROOT", dirname(__DIR__));
define("WWW", ROOT . '/public');
define("APP", ROOT . '/app');
define("CORE", ROOT . '/vendor/wfm');
define("HELPERS", ROOT . '/vendor/wfm/helpers');
define("CACHE", ROOT . '/temp/cache');
define("LOGS", ROOT . '/temp/logs');
define("CONFIG", ROOT . '/config');
define("LAYOUT", 'project');
define("PATH", 'http://localhost/shop/project');
define("ADMIN", 'http://localhost/shop/project/admin');
define("NO_IMAGE", 'uploads/no_image.jpg');

require_once ROOT . '/vendor/autoload.php';
