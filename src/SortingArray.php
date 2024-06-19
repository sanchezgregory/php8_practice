<?php

namespace App;


$arr = [
  [
      'cost'=>10,
      'value'=>10,
      'price'=>10
  ],
    [
        'cost'=>9,
        'value'=>8,
        'price'=>7
    ],
    [
        'cost'=>5,
        'value'=>6,
        'price'=>7
    ],
    [
        'cost'=>9,
        'value'=>3,
        'price'=>1
    ],
    [
        'cost'=>1,
        'value'=>1,
        'price'=>1
    ],
];

function compare($a, $b) {
    if ($a['price'] < $b['price']) return -1;
    if ($a['price'] > $b['price']) return 1;
    if ($a['value'] < $b['value']) return -1;
    if ($a['value'] > $b['value']) return 1;
    if ($a['cost'] < $b['cost']) return -1;
    if ($a['cost'] > $b['cost']) return 1;
    return 0;
}

usort($arr, 'App\compare');

print_r($arr);























/*








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
*/