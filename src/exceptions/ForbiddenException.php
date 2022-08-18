<?php
namespace r567tw\phpmvc\exceptions;


class ForbiddenException extends \Exception
{
    protected $message = '你沒有權限！';
    protected $code  = 403;
}
