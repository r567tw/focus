<?php

namespace r567tw\focus\core;

class Application
{
    const EVENT_BEFORE_REQUEST = 'beforeRequest';
    const EVENT_AFTER_REQUEST = 'afterRequest';

    protected array $eventListeners = [];

    public static string $rootPath;
    public static Application $app;
    public Router $router;
    public Request $request;
    public Response $response;
    public ?Controller $controller = null;
    public $userClass;

    public function __construct($rootPath)
    {
        self::$rootPath = $rootPath;
        self::$app = $this;
        $this->router = new Router();
        $this->request = new Request();
        $this->response = new Response();
    }

    public function run()
    {
        $this->triggerEvent(self::EVENT_BEFORE_REQUEST);
        try {
            echo $this->router->resolve();
            $this->triggerEvent(self::EVENT_AFTER_REQUEST);
        } catch (\Exception $ex) {
            $this->response->setStatusCode($ex->getCode());
            $this->response->setHeader('Content-Type: application/json; charset=utf-8');     
            echo json_encode([
                'error' => $ex->getCode(),
                'exception' => $ex
            ]);
        }
    }

    public function getController(): Controller
    {
        return $this->controller;
    }

    public function setController(Controller $controller): void 
    {
        $this->controller = $controller;
    }

    public function triggerEvent($eventName)
    {
        $callbacks = $this->eventListeners[$eventName] ?? [];
        foreach ($callbacks as $callback) {
            call_user_func($callback);
        }
    }

    public function on($eventName, $callback)
    {
        $this->eventListeners[$eventName][] = $callback;
    }
}
