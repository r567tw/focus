<?php
namespace r567tw\focus\core;

use r567tw\focus\exceptions\NotFoundException;
use r567tw\focus\exceptions\NotJsonException;
use r567tw\focus\middlewares\BaseMiddleware;

class Controller
{
    protected array $middlewares = [];
    public string $action = '';

    public function json(array|string $params=[])
    {
        if (is_array($params)){
            return json_encode($params);
        }
        return json_encode(["data"=> $params]);
    }

    public function jsonFromFile(string $filePath)
    {
        // todo : if file is not json ?
        if (pathinfo($filePath, PATHINFO_EXTENSION) !== 'json'){
            throw new NotJsonException();
        }
        
        if (file_exists($filePath) && filetype($filePath) === 'file'){
            return file_get_contents($filePath);
        }
        throw new NotFoundException();
    }

    public function getMiddlewares()
    {
        return $this->middlewares;
    }

    public function registMiddleWare(BaseMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }
}
