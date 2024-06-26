<?php
namespace App;
require_once 'ErrorHandlerTrait.php';
class CatchAllErrors {
    use ErrorHandlerTrait;
    public function __construct(private string $name, private ?int $age= null)
    {
        self::setCustomErrorHandler();
    }
    public function getName()
    {
        return $name;
    }
    public static function create($name)
    {
        return new self($name);
    }
}
$person = CatchAllErrors::create('greg');
try {
    echo $person->getName();
} catch (\ErrorException $e) {
    echo "Error or warning caught: ", $e->getMessage(), "\n";
} catch (\Exception $e) {
    echo "Exception caught: ", $e->getMessage(), "\n";
}
