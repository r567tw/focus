<?php
namespace r567tw\focus\exceptions;

/**
 * @author r567tw <r567tw@gmail.com>
 * @package exceptions
 */
class ForbiddenException extends \Exception
{
    protected $message = 'Permission Dend';
    protected $code  = 403;
}
