<?php
session_start();

require_once($_SERVER['DOCUMENT_ROOT'] . '/fallout/_db.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/_functions.php');

$femaleNames = [
    'Emma',
    'Olivia',
    'Ava',
    'Isabella',
    'Sophia',
    'Charlotte',
    'Mia',
    'Amelia',
    'Harper',
    'Evelyn',
    'Abigail',
    'Emily',
    'Elizabeth',
    'Mila',
    'Ella',
    'Avery',
    'Sofia',
    'Camila',
    'Aria',
    'Scarlett',
    'Victoria',
    'Madison',
    'Luna',
    'Grace',
    'Chloe',
    'Penelope',
    'Layla',
    'Riley',
    'Zoey',
    'Nora'];
$maleNames = [
    'Liam',
    'Noah',
    'William',
    'James',
    'Oliver',
    'Benjamin',
    'Elijah',
    'Lucas',
    'Mason',
    'Logan',
    'Alexander',
    'Ethan',
    'Jacob',
    'Michael',
    'Daniel',
    'Henry',
    'Jackson',
    'Sebastian',
    'Aiden',
    'Matthew',
    'Samuel',
    'David',
    'Joseph',
    'Carter',
    'Owen',
    'Wyatt',
    'John',
    'Jack',
    'Luke',
    'Jayden'];
$lastNames = [
    'Smith',
    'Johnson',
    'Williams',
    'Jones',
    'Brown',
    'Davis',
    'Miller',
    'Wilson',
    'Moore',
    'Taylor',
    'Anderson',
    'Thomas',
    'Jackson',
    'White',
    'Harris',
    'Martin',
    'Thompson',
    'Garcia',
    'Martinez',
    'Robinson',
    'Clark',
    'Rodriguez',
    'Lewis',
    'Lee',
    'Walker',
    'Hall',
    'Allen',
    'Young',
    'Hernandez',
    'King'];


function autoNewCharacterCreate(array $maleNames, array $femaleNames, array $lastNames)
{
    $newCharacter = [];
    $genderType = 'Female';
    $genderCreate = rand(0, 1);
    $gender = '';
    if ($genderCreate == 1) {
        $gender = $maleNames;
        $genderType = 'Male';
    } else $gender = $femaleNames;

    $age = rand(16, 50);

    $keyName = array_rand($gender);
    $newName = $gender[$keyName];

    $keyLastName = array_rand($lastNames);
    $newLastName = $lastNames[$keyLastName];

    $newCharacter[] = $newName . ' ' . $newLastName . ' ' . $age . ' ' . $genderType;

    return $newCharacter;
}

function special()
{

    $SPECIAL = ['S', 'P', 'E', 'C', 'I', 'A', 'L'];

    $groupMembers = count($SPECIAL);
    $maxSum = 40;
    $maxValue = 10;

    $groups = array();
    $member = 0;

    while ((array_sum($groups) != $maxSum)) {
        $res = rand(1, $maxSum / rand(($maxSum / $maxValue), $maxSum));
        $groups[$member] = $res;
        if (++$member == $groupMembers) {
            $member = 0;
        }
    }
    $resultArray = array_combine($SPECIAL, $groups);

    return $resultArray;
}



$first_name = "Baba";
$second_name = "Bobo";
$gender = "Femail";
$age = 66;
$s = 3;
$p = 8;
$e = 5;
$c = 7;
$i = 4;
$a = 3;
$l = 6;
$newCharacterCreated = array_merge(autoNewCharacterCreate($maleNames, $femaleNames, $lastNames), special());
echo 'Automatic character creation: ';
if($age != 0)
{
$link = Db::getDbLink();

$query = 'INSERT INTO characters (first_name, second_name, gender, age, s, p, e, c, i ,a, l) VALUES ("'.add_slashes($first_name).'", "'.add_slashes($second_name).'", "'.add_slashes($gender).'", '.add_slashes($age).', '.add_slashes($s).', '.add_slashes($p).', '.add_slashes($e).', '.add_slashes($c).', '.add_slashes($i).', '.add_slashes($a).', '.add_slashes($l).')';
$result = mysqli_query($link, $query);
if($result)
{
    $_SESSION['success'] = 'Гонщик успешно добавлен.';
    Header('Location: /fallout/index.php');
    exit;
}
else
{
    die('Ошибка ');
}}

//$characters = 'characters.txt';
//
//$fileWrite = fopen($characters, 'a+');
//fwrite($fileWrite, '****************************************************************' . PHP_EOL);
//foreach ($newCharacterCreated as $key => $value) {
//    fwrite($fileWrite, $key . ' - ' . $value . PHP_EOL);
//}
//fwrite($fileWrite, '****************************************************************' . PHP_EOL . PHP_EOL);
//fclose($fileWrite);
//$_SESSION['success'] = 'Персонаж успешно создан.';
//Header('Location: index.php');

