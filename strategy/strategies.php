<?php

require "interface.php";
class LandShipping implements ShippingStrategy {

    public function calculateCost(float $amount)
    {
        return $amount * 2;
    }
}

class SeaShipping implements ShippingStrategy {

    public function calculateCost(float $amount)
    {
        return $amount * 3;
    }
}

class AirShipping implements ShippingStrategy {

    public function calculateCost(float $amount)
    {
        return $amount * 4;
    }
}