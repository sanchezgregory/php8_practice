<?php

interface ShippingStrategy {
    public function calculateCost(float $amount);

}