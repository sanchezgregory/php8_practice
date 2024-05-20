<?php

namespace App;

use PHPUnit\Framework\TestCase;
include 'Temp.php';

final class TempTest extends TestCase
{
    // vendor/bin/phpunit src/SortPackageTest.php 
    
    public function testCase1()
    {
        $arr = [7, 5, 9, 1, 4];
        $expetected = 1;
        $result = computeClosestToZero($arr);
        $this->assertEquals($expetected, $result);
    }

    public function testCase2()
    {
        $arr = [-15,-7,-9,-14,-12];
        $expetected = -7;
        $result = computeClosestToZero($arr);
        $this->assertEquals($expetected, $result);
    }

    public function testCase3()
    {
        $arr = [-10,-10];
        $expetected = -10;
        $result = computeClosestToZero($arr);
        $this->assertEquals($expetected, $result);
    }

    public function testCase4()
    {
        $arr = [15,-7,9,14,7,12];
        $expetected = 7;
        $result = computeClosestToZero($arr);
        $this->assertEquals($expetected, $result);
    }

    public function testCase5()
    {
        $arr = [-273];
        $expetected = -273;
        $result = computeClosestToZero($arr);
        $this->assertEquals($expetected, $result);
    }

    public function testCase6()
    {
        $arr = [5526];
        $expetected = 5526;
        $result = computeClosestToZero($arr);
        $this->assertEquals($expetected, $result);
    }

    public function testCase7()
    {
        $arr = [];
        $expetected = 5526;
        $result = computeClosestToZero($arr);
        $this->assertEquals($expetected, $result);
    }


}