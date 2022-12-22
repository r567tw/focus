<?php
namespace r567tw\focus\exceptions;

/**
 * @author r567tw <r567tw@gmail.com>
 * @package exceptions
 */
class NotJsonException extends \Exception
{
    protected $message = 'not valid json file';
    protected $code  = 500;
}
