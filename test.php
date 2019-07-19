<?php
//foreach ($_POST as $value){
//    $q = $value;
//}
//require_once($_SERVER['DOCUMENT_ROOT'] . '/fallout/_functions.php');
//require_once($_SERVER['DOCUMENT_ROOT'] . '/fallout/_db.php');
//$link = Db::getDbLink();
//$s_characters = 'SELECT * FROM characters where id = '.$q[0];
//$r_characters = mysqli_query($link, $s_characters);
//$row = mysqli_fetch_assoc($r_characters);
//foreach ($row as $values){
//    echo $values . PHP_EOL;
//}
//


require_once($_SERVER['DOCUMENT_ROOT'] . '/fallout/_functions.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/fallout/_db.php');

$link = Db::getDbLink();

$q_characters = 'SELECT * FROM characters';
$r_characters = mysqli_query($link, $q_characters);
$characters_count = mysqli_num_rows($r_characters);
$row = mysqli_fetch_assoc($r_characters);
var_dump($row['id']);

$q_all_id = "SELECT id FROM characters";
$r_all = mysqli_query($link, $q_all_id);
$fir = mysqli_num_rows($r_all);
$row = mysqli_fetch_assoc($fir);

