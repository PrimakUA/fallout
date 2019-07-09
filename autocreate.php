<?php
session_start();

require_once($_SERVER['DOCUMENT_ROOT'] . '/fallout/_db.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/fallout/_functions.php');


$newCharacterCreated = array_merge(autoNewCharacterCreate(), special());

$first_name = $newCharacterCreated[0];
$second_name = $newCharacterCreated[1];
$age = $newCharacterCreated[2];
$gender = $newCharacterCreated[3];
$s = $newCharacterCreated['S'];
$p = $newCharacterCreated['P'];
$e = $newCharacterCreated['E'];
$c = $newCharacterCreated['C'];
$i = $newCharacterCreated['I'];
$a = $newCharacterCreated['A'];
$l = $newCharacterCreated['L'];

if ($age >=1) {
    $link = Db::getDbLink();

    $query = 'INSERT INTO characters (first_name, second_name, gender, age, s, p, e, c, i ,a, l) VALUES ("' . add_slashes($first_name) . '", "' . add_slashes($second_name) . '", "' . add_slashes($gender) . '", ' . add_slashes($age) . ', ' . add_slashes($s) . ', ' . add_slashes($p) . ', ' . add_slashes($e) . ', ' . add_slashes($c) . ', ' . add_slashes($i) . ', ' . add_slashes($a) . ', ' . add_slashes($l) . ')';
    $result = mysqli_query($link, $query);
    if ($result) {
        $_SESSION['success'] = 'Персонаж успешно создан.';
        Header('Location: /fallout/index.php');
        exit;
    } else {
        die('Ошибка ');
    }
}

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

