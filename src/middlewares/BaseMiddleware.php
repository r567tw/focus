<?php
namespace r567tw\focus\middlewares;

use r567tw\focus\core\Application;
/**
 * @author r567tw <r567tw@gmail.com>
 * @package middlewares
 */
abstract class BaseMiddleware
{
    public array $actions =[];

    public function __construct(array $methods=[])
    {
        $this->actions = $methods;   
    }

    public function execute()
    {
        $action = Application::$app->controller->action;

        if (count($this->actions) > 0){
            if (in_array($action,$this->actions)){
                $this->next();
            }
        } else {
            $this->next();
        }
    }

    abstract public function next();
}
