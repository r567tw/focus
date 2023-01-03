<?php
namespace r567tw\focus\helpers;
/**
 * @author r567tw <r567tw@gmail.com>
 * @package helpers
 */
if (! function_exists('hello')) {
    function hello($name = 'helper')
    {
        echo "Hello,{$name}";
    }
}