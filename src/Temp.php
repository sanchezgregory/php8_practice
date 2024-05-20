<?php

namespace App;

function computeClosestToZero(array $ts) {

// Write your code here
// To debug (equivalent to var_dump): error_log(var_export($var, true));
if (!count($ts)) {
  return 0;
}
$auxTempP = 9999;
$auxTempN = -9999;
foreach($ts as $value) {

  if ($value >= 0 && $value < $auxTempP) {
    $auxTempP = $value;
  }
  if ($value >= $auxTempN && $value <= 0) {
    $auxTempN = $value;
  }
}
if (abs($auxTempN) === $auxTempP) {
  return abs($auxTempN);
}
if ($auxTempN === -9999){ 
  return $auxTempP;
}

if ($auxTempP === 9999){ 
  return $auxTempN;
}

return $auxTempP;
}


//print_r(computeClosestToZero([-273])); // 273
// print_r(computeClosestToZero([5526])); // 5526
// print_r(computeClosestToZero([-15, -7, -9, -14, -12])); // 7
print_r(computeClosestToZero([-10, -10])); // -10
// print_r(computeClosestToZero([15,-7,9,14,7,12])); // 7