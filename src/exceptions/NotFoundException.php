<?php
namespace r567tw\focus\exceptions;


class NotFoundException extends \Exception
{
    protected $message = 'Not Found';
    protected $code  = 404;
}
