<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/fallout/_functions.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/fallout/_db.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/fallout/classes/Character.php');


$character1 = new Character;
$character2 = new Character;

$firstCharacterObj = $character1->getRandomPerson();
$secondCharacterObj = $character2->getRandomPerson();


function preview($firstCharacterObj, $secondCharacterObj)
{
    $damageFirstCharacter = $firstCharacterObj->getDamage($secondCharacterObj->lucky);
    $damageSecondCharacter = $secondCharacterObj->getDamage($firstCharacterObj->lucky);
    echo $firstCharacterObj->firstName . ' ' . $firstCharacterObj->secondName . ' has ' . $firstCharacterObj->getHealth() . ' HP, and can cause damage max - ' . $damageFirstCharacter['max'] . ' HP.' . '<br>';
    echo $secondCharacterObj->firstName . ' ' . $secondCharacterObj->secondName . ' has ' . $secondCharacterObj->getHealth() . ' HP, and can cause damage max - ' . $damageSecondCharacter['max'] . ' HP.' . '<br>';

}


function fight_calculate($firstCharacterObj, $secondCharacterObj)
{

    $first_character_current_health = $firstCharacterObj->getHealth();
    $second_character_current_health = $secondCharacterObj->getHealth();
    $i = 1;
    echo "************** FIGHT **************" . '<br>';

    while ($first_character_current_health > 0 && $second_character_current_health > 0) {

        $damageFirstCharacter = $firstCharacterObj->getDamage($secondCharacterObj->lucky);
        $damageSecondCharacter = $secondCharacterObj->getDamage($firstCharacterObj->lucky);

        $first_character_dmg = rand($damageFirstCharacter['min'], $damageFirstCharacter['max']);
        $second_character_dmg = rand($damageSecondCharacter['min'], $damageSecondCharacter['max']);

        echo "************** ROUND" . $i . " **************" . '<br>';

        echo ">>>" . $firstCharacterObj->firstName . " " . $firstCharacterObj->secondName . " hits " . $secondCharacterObj->firstName . " " . $secondCharacterObj->secondName . " and deals " . $first_character_dmg . " damage" . '<br>';
        $second_character_current_health -= $first_character_dmg;
        echo $secondCharacterObj->firstName  . " " . $secondCharacterObj->secondName . " has " . $second_character_current_health . " health left" . '<br>';

        if ($first_character_current_health) {
            echo $secondCharacterObj->firstName . " " . $secondCharacterObj->secondName . " hits " . $firstCharacterObj->firstName . " " . $firstCharacterObj->secondName . " and deals " . $second_character_dmg . " damage" . '<br>';
            $first_character_current_health -= $second_character_dmg;
            echo ">>>" . $firstCharacterObj->firstName . " " . $firstCharacterObj->secondName . " has " . $first_character_current_health . " health left" . '<br>';
        } else {
            break;
        }

        $i++;
    }

    echo "************** WE HAVE A WINNER **************" . '<br>';

    if ($second_character_current_health <= 0) {
        echo $firstCharacterObj->firstName . " " . $firstCharacterObj->secondName . " WINS!" . " | " . $secondCharacterObj->firstName . " " . $secondCharacterObj->secondName . " bites the dust." . '<br>';

    } else if ($first_character_current_health <= 0) {
        echo $secondCharacterObj->firstName . " " . $secondCharacterObj->secondName . " WINS!" . " | " . $firstCharacterObj->firstName . " " . $firstCharacterObj->secondName . " bites the dust." . '<br>';

    }

}

preview($firstCharacterObj, $secondCharacterObj);
fight_calculate($firstCharacterObj, $secondCharacterObj);




















