<?php

class CustomException extends Exception {
    public function __construct($message="", $code=0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

//    public function getCustomMessage(): string
//    {
//        return "Custom method for custom Exception";
//    }
}

try {
    //throw new CustomException('custom exception message');
    echo "hello world";

} catch (CustomException $exception) {
    echo "Caught custom exception: " . $exception->getMessage();
   // echo $exception->getCustomMessage();
} catch (Exception $e) {
    echo $e->getMessage();
} finally {
    echo "\n everything was executed";
}