<?php

namespace r567tw\focus\core;

use r567tw\focus\exceptions\NotFoundException;
/**
 * @author r567tw <r567tw@gmail.com>
 * @package core
 */
class Router
{

    protected array $routes = [];
    public Request $request;
    public Response $response;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
    }

    public function get($path, $callback)
    {
        $this->routes["GET"][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes["POST"][$path] = $callback;
    }

    public function put($path, $callback)
    {
        $this->routes["PUT"][$path] = $callback;
    }

    public function patch($path, $callback)
    {
        $this->routes["PATCH"][$path] = $callback;
    }

    public function delete($path, $callback)
    {
        $this->routes["DELETE"][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();

        $callback = $this->routes[$method][$path] ?? false;
        if ($callback === false){
            throw new NotFoundException();
        }
        if (is_string($callback)) {
            $this->response->setStatusCode(200);
            return $callback;
        }
        if (is_array($callback)) {
            $controller = new $callback[0]();
            Application::$app->controller = $controller;
            $controller->action = $callback[1];
            $callback[0] = $controller;
            
            foreach ($controller->getMiddlewares() as $middleware) {
                $middleware->execute();
            }
        }
        
        $this->response->setStatusCode(200);
        $this->response->setHeader('Content-Type: application/json; charset=utf-8');
        return call_user_func($callback, $this->request,$this->response);
    }

}
