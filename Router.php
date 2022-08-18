<?php

namespace r567tw\phpmvc;

use r567tw\phpmvc\exceptions\NotFoundException;

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
            return Application::$app->view->renderView($callback);
        }
        if (is_array($callback)) {
            $controller = new $callback[0]();
            Application::$app->controller = $controller;
            $controller->action = $callback[1];
            $callback[0] = $controller;

            foreach ($controller->getMiddlewares() as $middleware) {
                $middleware->next();
            }
        }
        
        $this->response->setStatusCode(200);
        return call_user_func($callback, $this->request,$this->response);
    }

}
