<?php
namespace r567tw\focus\core;

use r567tw\focus\middlewares\BaseMiddleware;

class Controller
{
    protected array $middlewares = [];
    public string $action = '';

    public function render($view , $params=[])
    {
        return $params;
    }

    public function getMiddlewares()
    {
        return $this->middlewares;
    }
}
