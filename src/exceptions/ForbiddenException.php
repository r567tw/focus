<?php
namespace r567tw\focus\exceptions;


class ForbiddenException extends \Exception
{
    protected $message = 'Permission Dend';
    protected $code  = 403;
}
