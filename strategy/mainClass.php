<?php

    require "strategies.php";

    class ShippingCalculator
    {
        public ShippingStrategy $shippingStrategy;

        public function __construct(ShippingStrategy $strategy)
        {
            $this->shippingStrategy = $strategy;
        }

        public function getCost($merchandiseCost)
        {
            return $this->shippingStrategy->calculateCost($merchandiseCost);
        }
    }


    $strategy = new SeaShipping();
    $shipping = new ShippingCalculator($strategy);
    $type = get_class($strategy);
    echo "Tipo: " . $type . " cost: " . $shipping->getCost(90);

