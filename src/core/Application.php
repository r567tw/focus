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
    public Session $session;
    public ?Controller $controller = null;
    // public Database $db;
    public $userClass;

    public function __construct($rootPath,array $config)
    {
        self::$rootPath = $rootPath;
        self::$app = $this;
        $this->router = new Router();
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        // $this->db = new Database($config['db']);
    }

    public function run()
    {
        // $this->triggerEvent(self::EVENT_BEFORE_REQUEST);
        try {
            echo $this->router->resolve();
        } catch (\Exception $ex) {
            $this->response->setStatusCode($ex->getCode());     
            echo $this->view->renderView("_error",[
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

    public function login(UserModel $user)
    {
       $this->user = $user;
       $primaryKey = $this->user->primaryKey();
       $this->session->set('user', $user->$primaryKey);
       return true;
    }

    public function logout()
    {
        $this->session->remove('user');
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
