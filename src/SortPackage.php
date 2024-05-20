<?php

namespace App;


/*
Implement the function solve($weight0, $weight1, $weight2) that takes 3 integer arguments: $weight0, $weight1 and $weight2.
These values represent the weight of the packages available on the conveyor belts with respective index 0, 1 and 2. When a conveyor belt is empty, the value is 0.

The function must return the index of the conveyor belt that has the heaviest package. 
For example, if the values for $weight0, $weight1 and $weight2 are 85, 100 and 90, then the expected answer is 1. In case of equality, any correct answer is accepted.

The function solve($weight0, $weight1, $weight2) will be called successively until all the conveyor belts are empty.
*/

function solve($weight0 = null, $weight1=null, $weight2=null) {
  // Write your code here
  // To debug (equivalent to var_dump): error_log(var_export($var, true));
  
  if ($weight0 === null && $weight1 === null && $weight2 === null) {
    return 'empty belts';
  }

  $tempBelts = [$weight0, $weight1, $weight2];



  for($i=0; $i <= 2; $i++) {
    $tempBox = "weight$i";
    $arr[] = $$tempBox;
  }
  rsort($arr);
  $heviest = array_search($arr[0], $tempBelts);
  
  return $heviest;
}

