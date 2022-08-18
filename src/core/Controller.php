<?php
namespace r567tw\focus\core;

use r567tw\focus\middlewares\BaseMiddleware;

class Controller
{
    protected array $middlewares = [];
    public string $action = '';

    public function json($view ,array|string $params=[])
    {
        if (is_array($params)){
            return json_encode($params);
        }
        return json_encode(["data"=> $params]);
    }

    public function getMiddlewares()
    {
        return $this->middlewares;
    }
}
