<?php
namespace r567tw\focus\middlewares;

use r567tw\focus\Application;
use r567tw\focus\exceptions\ForbiddenException;
use r567tw\focus\middlewares\BaseMiddleware;

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
