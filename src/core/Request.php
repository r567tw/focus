<?php

namespace r567tw\focus\core;
/**
 * @author r567tw <r567tw@gmail.com>
 * @package core
 */
class Request
{
    public function getPath()
    {
        $path = $_SERVER["REQUEST_URI"] ?? '/';
        $postion = strpos($path, '?');
        if ($postion === false){
            return $path;
        }
        return substr($path,0,$postion);
    }

    public function method()
    {
        return strtoupper($_SERVER["REQUEST_METHOD"]);
    }

    public function isGet()
    {
        return $this->method() === 'GET';
    }

    public function isPost()
    {
        return $this->method() === 'POST';
    }

    public function body()
    {
        $body = [];
        if ($this->isGet())
        {
            foreach ($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET,$key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        if ($this->isPost()) {
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }


        return $body;
    }

    public function header(string $key)
    {
        $header = strtoupper($key);
        if (isset($_SERVER["HTTP_{$header}"])){
            return $_SERVER["HTTP_{$header}"];
        } else {
            return null;
        }
    }
}
