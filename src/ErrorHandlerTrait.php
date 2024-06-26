<?php
namespace App;
trait ErrorHandlerTrait {
    public static function setCustomErrorHandler()
    {
        set_error_handler([self::class, 'customErrorHandler']);
    }
    public static function customErrorHandler($errno, $errstr, $errfile, $errline) {
        throw new \ErrorException($errstr, 0, $errno, $errfile, $errline);
    }
}