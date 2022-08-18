<?php
namespace r567tw\focus\middlewares;


abstract class BaseMiddleware
{
    public array $actions =[];

    public function __construct(array $methods=[])
    {
        $this->actions = $methods;   
    }

    abstract public function next();
}
