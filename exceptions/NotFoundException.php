<?php
namespace r567tw\phpmvc\exceptions;


class NotFoundException extends \Exception
{
    protected $message = '沒有該網頁！';
    protected $code  = 404;
}
