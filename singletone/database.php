<?php

class Database {
    private static $instance;
    public $pdo;
    private function __construct() {
        $dsn = 'mysql:host=localhost:33068;dbname=mysql80';
        $username = 'root';
        $password = 'root';
        $this->pdo = new PDO($dsn, $username, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    public function getConnection(): PDO
    {
        return $this->pdo;
    }

    public function getAllFromByTable($table)
    {
        $db = self::getInstance();
        $pdo = $db->getConnection();
        $stmt = $pdo->prepare("SELECT * FROM $table");
        $stmt->execute();
        return  $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
$db = Database::getInstance();


$name = "Product_1";
$description = "Nuevo product";
$number = '123';
$pdo = $db->getConnection();
$stmt = $pdo->prepare("INSERT INTO products (name, description, number) VALUES (:name, :description, :number)");
$stmt->bindParam(':name', $name);
$stmt->bindParam(':description', $description);
$stmt->bindParam(':number', $number);
$stmt->execute();

var_dump($db->getAllFromByTable('products'));