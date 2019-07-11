<?php

function autoNewCharacterCreate()
{
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

    $newCharacter[] = $newName;
    $newCharacter[] = $newLastName;
    $newCharacter[] = $age;
    $newCharacter[] = $genderType;

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

function newCharacterCreate($first_name, $last_name, $age, $gender_id)
{

    if ($gender_id == 1) {
        $sex = 'Male';
    } else $sex = 'Female';

    $newCharacterHandCreate[] = $first_name;
    $newCharacterHandCreate[] = $last_name;
    $newCharacterHandCreate[] = $age;
    $newCharacterHandCreate[] = $sex;

    return $newCharacterHandCreate;

}

function getParStr($params = [])
{
    $params_str = '';
    foreach ($params as $param) {
        if (isset($_GET[$param])) {
            $params_str .= '&' . $param . '=' . $_GET[$param];
        } else {

        }
    }

    return $params_str;
}

function add_slashes($text)
{
    $link = Db::getDbLink();

    $text = trim($text);
    $text = mysqli_real_escape_string($link, $text);
    return $text;
}

function add_slashesl($text)
{
    $text = trim($text);
    $text = str_replace('\\', '\\\\', $text);
    $text = mysqli_real_escape_string(Db::getDbLink(), $text);  //mysql_real_escape_string новая
    $text = addCslashes($text, '_%');
    return $text;
}

function changeColor($parColor)
{
    if ($parColor == '#000000') {
        $parColor = '#ffffff';
    } else {
        $parColor = '#000000';
    }
    return $parColor;

}

function setColor($color)
{
    return '<td bgcolor="' . $color . '"></td>';

}

function makePager($current_page, $pages_count, $side_pages, $url = null)
{
    if ($url) {
        $url .= '&';
    } else {
        $url .= '?';
    }

    // first page
    if ($current_page == 1) {
        echo '1 ';
    } else {
        echo '<a href="' . $url . 'page=1">1</a> ';
    }
    if ($current_page > ($side_pages + 2))
        echo '... ';

    $start_page = $current_page - $side_pages;
    $end_page = $current_page + $side_pages;
    $start_page = max(2, $start_page);
    $end_page = min(($pages_count - 1), $end_page);

    for ($i = $start_page; $i <= $end_page; $i++) {
        if ($current_page == $i) {
            echo $i . ' ';
        } else {
            echo '<a href="' . $url . 'page=' . $i . '">' . $i . '</a> ';
        }
    }

    // last page
    if ($pages_count > 1) {
        if (($current_page + $side_pages) < ($pages_count - 1)) echo '... ';
        if ($current_page == $pages_count) {
            echo $pages_count . ' ';
        } else {
            echo '<a href="' . $url . 'page=' . $pages_count . '">' . $pages_count . '</a> ';
        }
    }
}


function myImplode($glue_str, $array_arr)
{
    $array_pcs = count($array_arr);
    $result = '';
    for ($tr = 0; $tr < $array_pcs; $tr++) {

        //echo $tr.'=='.$array_pcs.'<br>';
        if ($tr == ($array_pcs - 1)) {
            //echo '+';
            //$result = $result . $array_arr[$tr];
            $result .= $array_arr[$tr];

        } else {
            //echo '-';
            $result .= $array_arr[$tr] . $glue_str;

        }

    }
    return $result;
}