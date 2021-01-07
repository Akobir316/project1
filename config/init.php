<?php
define("MODE", 1);//константа для ошибок, режим: 1-разработка, 0-продакшн
define("ROOT", dirname(__DIR__));
define("CONFIG", ROOT.'/config');
define("WWW", ROOT.'/public');
define("PATH",'http://'.$_SERVER['HTTP_HOST']);

require_once ROOT.'/vendor/autoload.php';

