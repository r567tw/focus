<?php
namespace r567tw\phpmvc\middlewares;

use r567tw\phpmvc\Application;
use r567tw\phpmvc\exceptions\ForbiddenException;
use r567tw\phpmvc\middlewares\BaseMiddleware;

class AuthMiddleware extends BaseMiddleware
{
    public array $actions =[];

    public function __construct(array $methods=[])
    {
        $this->actions = $methods;   
    }

    public function next()
    {
        if (Application::isGuest()){
            if (empty($this->actions) || in_array(Application::$app->controller->action,$this->actions)){
                throw new ForbiddenException();
            }
        }
    }
}
