<?php

namespace r567tw\focus\core;

/**
 * @author r567tw <r567tw@gmail.com>
 * @package core
 */
class Response
{
    public function setStatusCode(int $code)
    {
        http_response_code($code);
    }

    public function setHeader(string $headers)
    {
        header($headers);
    }

    public function redirect(string $url)
    {
        header("location: {$url}");
    }

    public function json(array|string $params=[])
    {
        if (is_array($params)){
            return json_encode($params);
        }
        return json_encode(["data"=> $params]);
    }

    public function file(string $filePath)
    {
        if (pathinfo($filePath, PATHINFO_EXTENSION) !== 'json'){
            throw new NotJsonException();
        }
        
        if (file_exists($filePath) && filetype($filePath) === 'file'){
            return file_get_contents($filePath);
        }
        throw new NotFoundException();
    }
}
