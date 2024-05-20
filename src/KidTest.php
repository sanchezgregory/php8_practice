<?php


use Kid\Kiddy;
use PHPUnit\Framework\TestCase;

final class KidTest extends TestCase
{
    public function testConstructor()
    {
        // 1. TestConstructor
        $kid = new Kiddy('Jhonny', 14);
        $this->assertSame(14, $kid->getAge());
        $this->assertSame('Jhonny', $kid->getName());
        $this->assertEmpty($kid->getHobbies());
    }

    public function testGetName()
    {
        // 2. Testing getting name
        $kid = new Kiddy('Mike', 2);
        $this->assertIsString($kid->getName());
    }

    public function testGetAge()
    {
        $kid = new Kiddy('Mike', 2);
        $this->assertIsNumeric($kid->getAge());
    }

    public function testAddHobbie()
    {
       $kid = new Kiddy('Mike', 2);
       $kid->addHobbie('play');
       $this->assertStringContainsString('play', $kid->getHobbies());
    }


}