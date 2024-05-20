<?php

namespace App;

use PHPUnit\Framework\TestCase;
include 'SortPackage.php';

final class SortPackageTest extends TestCase
{
 
    public function testCase1()
    {
        $w0 = 80;
        $w1 = 120;
        $w2 = 90;
        $expetected = 1;
        $result = solve($w0, $w1, $w2);
        $this->assertEquals($expetected, $result);
    }

    public function testCase2()
    {
        $w0 = 67;
        $w1 = 67;
        $w2 = 67;
        $expetected = 0;
        $result = solve($w0, $w1, $w2);
        $this->assertEquals($expetected, $result);
    }

    public function testCase3()
    {
        $w0 = 67;
        $w1 = 67;
        $w2 = 90;
        $expetected = 2;
        $result = solve($w0, $w1, $w2);
        $this->assertEquals($expetected, $result);
    }

    public function testCase4()
    {
        $w0 = 40;
        $w2 = 100;
        $expetected = 2;
        $result = solve($w0, null, $w2);
        $this->assertEquals($expetected, $result);
    }

    public function testCase5()
    {
        $expetected = 'empty belts';
        $result = solve(null, null, null);
        $this->assertEquals($expetected, $result);
    }

   

}