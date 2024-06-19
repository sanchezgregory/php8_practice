<?php

namespace App;
abstract class ExpendMachine{
    protected function change(float $pay, float $price): array
    {
        $coins = [5, 1, 0.50, 0.25, 0.10];
        $result = [0, 0, 0, 0, 0];
        $vuelto = $pay - $price;

        for($i = 0; $i<count($coins); $i++) {
            $result[$i] = intval($vuelto/$coins[$i]);
            $vuelto -= ($result[$i] * $coins[$i]);
        }
        return $result;
    }
}

class ConcreteChangeDollar extends ExpendMachine {
    public function change(float $pay, float $price):array {
        return parent::change($pay, $price);
    }
}

class ConcreteChangeEuro extends ExpendMachine {

}


$obj = new ConcreteChangeDollar();
print_r($obj->change(50, 17.25));
