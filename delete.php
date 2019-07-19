<?php

session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/fallout/_functions.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/fallout/_db.php');

$character_id = $_GET['id'];

$link = Db::getDbLink();

$query = 'SELECT * FROM characters WHERE id=' . $character_id;

if ($character_id > 0) {

    $query = 'DELETE FROM characters WHERE id=' . $character_id;
    $update = mysqli_query($link, $query);
    if ($query) {
        $_SESSION['success'] = 'Character delete.';
        Header('Location: /fallout/list.php');
        exit;
    }


}

