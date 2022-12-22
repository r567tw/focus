<?php
namespace r567tw\focus\core;

use r567tw\focus\exceptions\NotFoundException;
use r567tw\focus\exceptions\NotJsonException;
use r567tw\focus\middlewares\BaseMiddleware;
/**
 * @author r567tw <r567tw@gmail.com>
 * @package core
 */
class Controller
{
    protected array $middlewares = [];
    public string $action = '';

    public function getMiddlewares()
    {
        return $this->middlewares;
    }

    public function registMiddleWare(BaseMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }
}
