<?php
namespace r567tw\focus;

use r567tw\focus\middlewares\BaseMiddleware;

class Controller
{
    protected array $middlewares = [];
    public string $action = '';

    public function render($view , $params=[])
    {
        return Application::$app->view->renderView($view, $params);
    }
}
