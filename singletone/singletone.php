<?php
class Singleton {

    private static $instance;
    private string $connection;
    private function __construct()
    {
        $this->connection = 'asdsadas';
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function anyMethod()
    {
        return serialize($this) . " hello world";
    }
}

$a = Singleton::getInstance();
var_dump($a->anyMethod());

