<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/fallout/_functions.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/fallout/_db.php');

$link = Db::getDbLink();
$q_all = "SELECT COUNT(*) FROM characters";
$r_all = mysqli_query($link, $q_all);
$characters_all = mysqli_fetch_row($r_all)[0];
$first_character = mysqli_fetch_assoc($r_all);
print_r($first_character);
$random_select1 = rand(1, $characters_all);
$random_select2 = rand(1, $characters_all);

$first_character_q = 'SELECT * FROM characters where id = ' . $random_select1;
$r_character_first = mysqli_query($link, $first_character_q);
$first_character = mysqli_fetch_assoc($r_character_first);

$second_character_q = 'SELECT * FROM characters where id = ' . $random_select2;
$r_character_second = mysqli_query($link, $second_character_q);
$second_character = mysqli_fetch_assoc($r_character_second);

function get_health(array $player)
{
    $health = 70 + ($player['e'] * 3);
    return $health;
}

function get_damage($player1, $player2)
{
    $min = round((($player1['s'] * 2) - $player2['l']) / 2);
    if ($min >= 0) {
        $min_damage = $min;
    } else
        $min_damage = 0;

    $max_damage = round($player1['s'] + $player1['l']);

    $damage = [$min_damage, $max_damage];
    return $damage;
}
function preview($first_character, $second_character)
{
    $damage_first_character = get_damage($first_character, $second_character);
    $damage_second_character = get_damage($second_character, $first_character);
    echo $first_character['first_name'] . ' ' . $first_character['second_name'] . ' has ' . get_health($first_character) . ' HP, and can cause damage max - ' . $damage_first_character[1] . ' HP.' . '<br>';
    echo $second_character['first_name'] . ' ' . $second_character['second_name'] . ' has ' . get_health($second_character) . ' HP, and can cause damage max - ' . $damage_second_character[1] . ' HP.' . '<br>';

}

function fight_calculate($first_character, $second_character)
{

    $first_character_current_health = get_health($first_character);
    $second_character_current_health = get_health($second_character);
    $i = 1;
        echo "************** FIGHT **************" . '<br>';

    while ($first_character_current_health > 0 && $second_character_current_health > 0) {

        $first_character_dmg = rand(get_damage($first_character, $second_character)[0], (get_damage($first_character, $second_character)[1]));
        $second_character_dmg = rand(get_damage($second_character, $first_character)[0], get_damage($second_character, $first_character)[1]);

        echo "************** ROUND" . $i . " **************" . '<br>';

        echo ">>>" . $first_character['first_name'] . " " . $first_character['second_name'] . " hits " . $second_character['first_name'] . " " . $second_character['second_name'] . " and deals " . $first_character_dmg . " damage" . '<br>';
        $second_character_current_health -= $first_character_dmg;
        echo $second_character['first_name'] . " " . $second_character['second_name'] . " has " . $second_character_current_health . " health left" . '<br>';

        if ($first_character_current_health) {
            echo $second_character['first_name'] . " " . $second_character['second_name'] . " hits " . $first_character['first_name'] . " " . $first_character['second_name'] . " and deals " . $second_character_dmg . " damage" . '<br>';
            $first_character_current_health -= $second_character_dmg;
            echo ">>>" . $first_character['first_name'] . " " . $first_character['second_name'] . " has " . $first_character_current_health . " health left" . '<br>';
        } else {
            break;
        }

        $i++;
    }

    echo "************** WE HAVE A WINNER **************" . '<br>';

    if ($second_character_current_health <= 0) {
        echo $first_character['first_name'] . " " . $first_character['second_name'] . " WINS!" . " | " . $second_character['first_name'] . " " . $second_character['second_name'] . " bites the dust." . '<br>';
        return true;
    } else if ($first_character_current_health <= 0) {
        echo $second_character['first_name'] . " " . $second_character['second_name'] . " WINS!" . " | " . $first_character['first_name'] . " " . $first_character['second_name'] . " bites the dust." . '<br>';
        return true;
    }
    return true;
}
echo preview($first_character, $second_character);
echo fight_calculate($first_character, $second_character);




















