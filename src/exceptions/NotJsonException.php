<?php
namespace r567tw\focus\exceptions;


class NotJsonException extends \Exception
{
    protected $message = 'not valid json file';
    protected $code  = 500;
}
