# Focus
> the smallest php framework

## Introduction
** Can not use on PRODUCTION **

Inspire by : https://packagist.org/packages/donatj/mock-webserver

## Installation 
You can install the latest version with composer:

```
composer require 'r567tw/focus'
```

## Demo and Example
you can reference from : [r567tw/focus-framework](https://github.com/r567tw/focus-framework)

## Usage
First, you can create file: `index.php`
### Basic
```
<?php
require_once __DIR__."/../vendor/autoload.php";

use app\controllers\MainController;
use r567tw\focus\core\Application;

// init our framework 
$app = new Application(dirname(__DIR__));

// you can create MainController.php or use **composer autoload**
$app->router->get('/',[MainController::class,'home']);

// or return string
$app->router->get('/hello', 'helloworld');

// or return callback
$app->router->get('/json',function(){
    return json_encode(['xxxx'=>'yyy']);
});

// run app
$app->run();
```

### Events
We have two events: `EVENT_BEFORE_REQUEST` & `EVENT_AFTER_REQUEST`
```
$app->on(Application::EVENT_BEFORE_REQUEST,function(){
    $time = date("F j, Y, g:i a");
    file_put_contents('.././logs/hello.log', "{$time} before request\n", FILE_APPEND);
});

$app->on(Application::EVENT_AFTER_REQUEST,function(){
    $time = date("F j, Y, g:i a");
    file_put_contents('.././logs/hello.log', "{$time} after request\n", FILE_APPEND);
});
```

### controller
```
<?php
namespace app\controllers;

use r567tw\focus\core\Application;
use r567tw\focus\core\Controller;
use r567tw\focus\core\Request;
use r567tw\focus\core\Response;
use app\middlewares\AuthMiddleware;

class MainController extends Controller
{
    public function __construct()
    {
        // you can create middleware
        $this->registMiddleWare(new AuthMiddleware(['contact']));
    }

    public function contact()
    {
        // response give you "file" for JSON response
        return response()->file(dirname(__DIR__)."/jsons/sample.json");
    }

    public function home(Request $req)
    {
        return response()->json(["hello"=> "world"]);
    }

    public function redirect()
    {
        return response()->redirect('https://tw.yahoo.com');
    }
}
```

