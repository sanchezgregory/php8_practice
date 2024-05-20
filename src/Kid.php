<?php

namespace Kid;

class Kiddy
{
    private $name;
    private $age;
    private $hobbies = [];

    public function __construct($name, $age)
    {
        $this->name = $name;
        $this->age = $age;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    public function getName()
    {
        return $this->name;
    }

    public function addHobbie($hobbie)
    {
        $this->hobbies[] = $hobbie;
    }

    public function removeHobbie($hobbie)
    {
        if (!in_array($hobbie, $this->hobbies)) {
            throw new \Exception('no such hobbie found to remove');
        }
        unset($this->hobbies[array_search($hobbie, $this->hobbies)]);
    }

    public function getHobbies()
    {
        return implode(',' , $this->hobbies);
    }
}

$kid = new Kiddy('Greg', '30');
$kid->addHobbie('Play CS');
$kid->addHobbie('Watch cartoons');
echo $kid->getHobbies();
