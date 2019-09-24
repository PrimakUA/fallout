<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/fallout/classes/RecordGetter.php');

class Character extends RecordGetter
{
    public $firstName;
    public $secondName;
    public $age;
    public $gender;
    public $strong;
    public $power;
    public $e;
    public $c;
    public $i;
    public $a;
    public $lucky;

    protected function getTable()
    {
        return 'characters';
    }

    public static function getCharacterById($id)
    {
        $character = new self();

        $character->getById($id);

        return $character;
    }

    public function getHealth()
    {
        $health = 70 + $this->e * 3;
        return $health;
    }

    public function getDamage($enemyLucky)
    {
        $min = round((($this->strong * 2) - $enemyLucky) / 2);
        if ($min >= 0) {
            $min_damage = $min;
        } else {
            $min_damage = 0;
        }

        $max_damage = round($this->strong + $this->lucky);

        $damage = ['min' => $min_damage, 'max' => $max_damage];
        return $damage;
    }

}