<?php

use r567tw\focus\core\Application;

$app = new Application(dirname(__DIR__));
$app->router->get('/',[MainController::class,'home']);
