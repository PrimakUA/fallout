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

function getCountries()
{
    $link = Db::getDbLink();

    $query = 'SELECT * FROM countries ORDER BY name';
    $result = mysqli_query($link, $query);

    $row_count = mysqli_num_rows($result);
    $countries = [];
    for ($i = 0; $i < $row_count; $i++) {
        $row = mysqli_fetch_assoc($result);
        $countries[$row['id']] = $row['name'];
    }

    return $countries;
}

function getDrivers()
{
    $link = Db::getDbLink();

    $query = 'SELECT * FROM drivers ORDER BY name';
    $result = mysqli_query($link, $query);

    $row_count = mysqli_num_rows($result);
    $drivers = [];
    for ($i = 0; $i < $row_count; $i++) {
        $row = mysqli_fetch_assoc($result);
        $drivers[$row['id']] = $row['first_name' . 'last_name'];
    }

    return $drivers;
}

function getTeams()
{
    $link = Db::getDbLink();

    $query = 'SELECT * FROM teams ORDER BY name';
    $result = mysqli_query($link, $query);

    $row_count = mysqli_num_rows($result);
    $teams = [];
    for ($i = 0; $i < $row_count; $i++) {
        $row = mysqli_fetch_assoc($result);
        $teams[$row['id']] = $row['name'];
    }

    return $teams;
}

/*
{
    $teams =[
        1=>'Mersedes AMG',
        2=>'Scuderia Ferrari',
        3=>'Red Bull Racing',
        4=>'Williams F1 Team',
        5=>'Sauber F1 Team',
        6=>'McLaren Honda',
        7=>'Scuderia Toro Rosso',
        8=>'Force India F1 Team',
        9=>'Lotus F1 Team',
        10=>'Manor'
    ];

    return $teams;
}*/

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

$n = 0;

/*$result = '';
foreach ($array_arr as $key =>$value) {
    $result = $result .$value .$glue_str;

$n++;
    }
return $result;
}*/

function getPersonalStandings()
{
    $racer = [
        [
            'name' => 'С. ghfghfghfghgfhfghfghФеттель',
            'team' => 'Red Bull',
            'country' => 'GER',
            'points' => 78
        ],
        [
            'name' => 'М. Уэббер',
            'team' => 'Red Bull',
            'country' => 'AUS',
            'points' => 78
        ],
        [
            'name' => 'Ф. Алонсо',
            'team' => 'Ferrari',
            'country' => 'ESP',
            'points' => 75
        ],
        [
            'name' => 'Д. Баттон',
            'team' => 'McLaren',
            'country' => 'GBR',
            'points' => 70
        ],
        [
            'name' => 'Ф. Масса',
            'team' => 'Ferrari',
            'country' => 'BRA',
            'points' => 61
        ],
        [
            'name' => 'Л. Хемильтон',
            'team' => 'McLaren',
            'country' => 'GBR',
            'points' => 59
        ],
        [
            'name' => 'Р. Кубица',
            'team' => 'Renault',
            'country' => 'POL',
            'points' => 59
        ],
        [
            'name' => 'Н. Росберг',
            'team' => 'Mersedes',
            'country' => 'GER',
            'points' => 56
        ],
        [
            'name' => 'М. Шумахер',
            'team' => 'Mersedes',
            'country' => 'GER',
            'points' => 22
        ],
        [
            'name' => 'А. Сутил',
            'team' => 'Force India',
            'country' => 'GER',
            'points' => 20
        ],
        [
            'name' => 'В. Люцци',
            'team' => 'Force India',
            'country' => 'ITA',
            'points' => 10
        ],
        [
            'name' => 'Р. Баррикелло',
            'team' => 'Williams',
            'country' => 'BRA',
            'points' => 7
        ],
        [
            'name' => 'В. Петров',
            'team' => 'Renault',
            'country' => 'RUS',
            'points' => 6
        ],
        [
            'name' => 'Х. Альгессуари',
            'team' => 'Toro Rosso',
            'country' => 'ESP',
            'points' => 3
        ],
        [
            'name' => 'Н. Хюлькенберг',
            'team' => 'Williams',
            'country' => 'GER',
            'points' => 1
        ],
        [
            'name' => 'С. Буэми',
            'team' => 'Toro Rosso',
            'country' => 'CHE',
            'points' => 1
        ],
        [
            'name' => 'П. Де Ларосса',
            'team' => 'Sauber',
            'country' => 'ESP',
            'points' => 0
        ],
        [
            'name' => 'Х. Ковалайнен',
            'team' => 'Lotus',
            'country' => 'FIN',
            'points' => 0
        ],
        [
            'name' => 'К. Чандхок',
            'team' => 'HRT',
            'country' => 'IND',
            'points' => 0
        ],
        [
            'name' => 'Б. Сенна',
            'team' => 'HRT',
            'country' => 'BRA',
            'points' => 0
        ],
        [
            'name' => 'Я. Трулли',
            'team' => 'Lotus',
            'country' => 'ITA',
            'points' => 0
        ],
        [
            'name' => 'К. Кобаяши',
            'team' => 'Sauber',
            'country' => 'JAP',
            'points' => 0
        ],

    ];
    return $racer;
}
