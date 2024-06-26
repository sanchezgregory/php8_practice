<?php

class MiClase {
    public function __construct(private string $name){}

    public static function create(string $name): MiClase {
        return new self($name);
    }
    public function getName()
    {
        return $this->name;
    }
}


$a = new MiClase("MiClase");
echo $a->getName();

$b = MiClase::create('Miclase2');
echo $b->getName();

$c = clone $a;
echo $c->getName();



