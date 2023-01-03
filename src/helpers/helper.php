<?php
use r567tw\focus\core\Response;
/**
 * @author r567tw <r567tw@gmail.com>
 * @package helpers
 */
if (! function_exists('response')) {
    function response()
    {
        return new Response();
    }
}