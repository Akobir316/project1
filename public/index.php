<?php
require_once dirname(__DIR__)."/vendor/autoload.php";
require_once dirname(__DIR__)."/config/routes.php";
$app = new \core\Application();
$app->run();

