<?php

namespace r567tw\phpmvc;


class Response
{
    public function setStatusCode(int $code)
    {
        http_response_code($code);
    }

    public function redirect(string $url)
    {
        header("location: {$url}");
    }
}
