<?php

function miManejadorDeErrores($errno, $errstr, $errfile, $errline) {
    echo "---- [[ Error: [$errno] $errstr en $errfile en la línea $errline ]] ----\n";
}
set_error_handler("miManejadorDeErrores");

class Connection {

    private $connect;
    public static $instance;
    private $execute;
    private function __construct() {
        $this->connect = "Mysql connected to DB";
    }

    public static function getInstance() {
        echo "\n looking for instance";
        if (!self::$instance) {
            echo "\n [[ NOT found, so, instancing]]";
            self::$instance = new self();
        }
        echo "\n returning instance";
        return self::$instance;
    }

    public function getData($query)
    {
        echo $this->execute = $query . ' executing query';
    }

    public function __get(string $method) {
        echo "\n No existing property: " . $method . "\n";
    }
    public function __call(string $method, array $args) {
        echo "\n No existing method: " . $method . " Args:  \n";
    }
}


$data = ['foo' => 'bar', 'baz' => 'qux'];
$exportedData = var_export($data, true);
echo $exportedData;

eval('$restoredData = ' . $exportedData . ';');
print_r($restoredData);


$conn = Connection::getInstance();
$conn->getData("\nother query");
$conn->getOtherProperty;
$conn->getNewMethod($a = 1);













//class Singleton {
//
//    private static $instance;
//    private string $connection;
//    private function __construct()
//    {
//        $this->connection = 'asdsadas';
//    }
//
//    public static function getInstance()
//    {
//        if (!self::$instance) {
//            self::$instance = new self();
//        }
//        return self::$instance;
//    }
//
//    public function anyMethod()
//    {
//        return serialize($this) . " hello world";
//    }
//}
//
//$a = Singleton::getInstance();
//var_dump($a->anyMethod());

