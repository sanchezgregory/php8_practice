<?php

namespace App;

class SortingArray
{

    private $arr =[
        ["name" => "Option 4","type" => "Delivery","cost" => 10,"estimated_days" => 8],
        ["name" => "Option 1","type" => "Delivery","cost" => 10,"estimated_days" => 5],
        ["name" => "Option 2","type" => "Custom","cost" => 5,"estimated_days" => 4],
        ["name" => "Option 3","type" => "Pickup","cost" => 7,"estimated_days" => 1],
        ["name" => "Option 5","type" => "Pickup","cost" => 5,"estimated_days" => 3]
    ];

    public function getSortedArray()
    {
        usort($this->arr, function($a, $b) {
            if ($a['cost'] == $b['cost']) {
                return $a['estimated_days'] - $b['estimated_days'];
            }
            return $a['cost'] - $b['cost'];
        });
        return $this->arr;
    }
}

$a = new SortingArray();
print_r($a->getSortedArray());