<?php

define("VAL", 23);
class Base {
    public static function who() {
        echo "Base\n";
    }

    public static function testSelf() {
        self::who();
    }

    public static function testStatic() {
        static::who();
    }
}

class Derived extends Base {
    const B = 10;
    public static function who() {
        $a = self::B;
        echo "Derived: " . $a . VAL;
    }
}

$derived = new Derived();
$derived->testSelf();   // Salida: Base
$derived::testStatic(); // Salida: Derived