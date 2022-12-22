<?php
namespace r567tw\focus\exceptions;

/**
 * @author r567tw <r567tw@gmail.com>
 * @package exceptions
 */
class NotFoundException extends \Exception
{
    protected $message = 'Not Found';
    protected $code  = 404;
}
