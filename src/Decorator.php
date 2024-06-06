<?php

namespace App;

interface Coffee {
    public function getCost(): float;

    public function getDescription(): string;
}
class SimpleCoffee implements Coffee {
    public function getCost(): float
    {
        return 0.9;
    }
    public function getDescription(): string
    {
        return 'Coffee';
    }
}

class CoffeeDecorator extends SimpleCoffee {
    private Coffee $coffee;
    public function __construct(Coffee $coffee)
    {
        $this->coffee = $coffee;
    }
    public function getCost(): float
    {
        return $this->coffee->getCost() + $this->getToppingCost();
    }
    public function getDescription(): string
    {
        return $this->coffee->getDescription() . " Additional of: " . $this->getToppingNames();
    }
    public function getToppingCost(): float
    {
        return 0.0;
    }
    public function getToppingNames(): string
    {
        return '';
    }
}

class MilkCoffee extends CoffeeDecorator {
    public function getToppingCost(): float
    {
        return 0.60;
    }
    public function getToppingNames(): string
    {
        return 'Milk';
    }
}

class MokaCoffee extends CoffeeDecorator {
    public function getToppingCost(): float
    {
        return 1.20;
    }
    public function getToppingNames(): string
    {
        return 'Chocolate';
    }
}

class SugarMilkCoffee extends CoffeeDecorator {
    public function getToppingCost(): float
    {
        return 0.80;
    }
    public function getToppingNames(): string
    {
        return 'Sugar and Milk';
    }
}


// Example usage
$simpleCoffee = new SimpleCoffee();
echo "Simple coffee: Cost = {$simpleCoffee->getCost()}, Description: {$simpleCoffee->getDescription()}\n";

$milkCoffee = new MilkCoffee($simpleCoffee);
echo "Milk coffee: Cost = {$milkCoffee->getCost()}, Description: {$milkCoffee->getDescription()}\n";

$mokaCoffee = new MokaCoffee($simpleCoffee);
echo "Moka coffee: Cost = {$mokaCoffee->getCost()}, Description: {$mokaCoffee->getDescription()}\n";

$milkSugarCoffee = new SugarMilkCoffee(new MokaCoffee(new MilkCoffee($mokaCoffee)));
echo "Milk and sugar coffee: Cost = {$milkSugarCoffee->getCost()}, Description: {$milkSugarCoffee->getDescription()}\n";