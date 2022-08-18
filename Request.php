<?php

namespace r567tw\phpmvc;

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
        if ($this->method() === 'GET')
        {
            foreach ($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET,$key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        if ($this->method() === 'POST') {
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }


        return $body;
    }
}
