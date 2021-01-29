<?php

/**
 * Единая точка входа, куда сервер перенаправляет все запросы
 */

require_once dirname(__DIR__) . '/config/init.php';
require_once CONFIG . '/routes.php';
$config = include CONFIG . '/components.php';

$app = \core\Application::getInstance($config);
$app->run();

