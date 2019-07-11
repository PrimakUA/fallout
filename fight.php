<?php

$fallout = function () {

    fwrite(STDOUT, "Enter 1 to create characters manually, or 2 to automatically create: ");

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

    $special = ['S', 'P', 'E', 'C', 'I', 'A', 'L'];

    function newCharacterCreate()
    {


        fwrite(STDOUT, "Enter name: ");
        $name = trim(fgets(STDIN));
        fwrite(STDOUT, "Enter last Name: ");
        $lastname = trim(fgets(STDIN));
        fwrite(STDOUT, "Enter age: ");
        $age = trim(fgets(STDIN));
        fwrite(STDOUT, "Enter gender: 1-Male ,2 - Female ");
        $gender = trim(fgets(STDIN));
        if ($gender == 1) {
            $sex = 'Male';
        } else $sex = 'Female';

        $newCharacterHandCreate[] = $name . ' ' . $lastname . ' ' . $age . ' ' . $sex;

        return $newCharacterHandCreate;

    }


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


    function skillDiv($nameOfSkills, $sumOfSkills, $maxScore)
    {
        $groupMembers = count($nameOfSkills);
        $maxSum = $sumOfSkills;
        $maxValue = $maxScore;

        $groups = array();
        $member = 0;

        /*
        Проверяем наполняемый массив $groups. Если сумма элементов менее $sumOfSkills, разбрасываем остаток между элементами массива $groups.
        */
        while ((array_sum($groups) != $maxSum)) {
            $res = rand(1, intval($maxSum / rand(intval($maxSum / $maxValue), $maxSum)));
            $groups[$member] = $res;
            if (++$member == $groupMembers) {
                $member = 0;
            }
        }
        /*
        Объединяем полученный массив с массивом $SPECIAL (его содержимое станет ключами) и получаем новый массив $resultArray с соответствием названиями скилов и уровней.
        */
        $resultArray = array_combine($nameOfSkills, $groups);
        return $resultArray;
    }

    $characterChoice = trim(fgets(STDIN));
    if ($characterChoice == 1) {
        $handCreate = 0;
        $newCharacterCreated = array_merge(newCharacterCreate(), skillDiv($special, 40, 10));
        echo 'Manual creation: ';
        print_r($newCharacterCreated);

    } elseif ($characterChoice == 2) {
        $newCharacterCreated = array_merge(autoNewCharacterCreate($maleNames, $femaleNames, $lastNames), skillDiv($special, 40, 10));
        echo 'Automatic character creation: ';
        print_r($newCharacterCreated);

    } elseif ($characterChoice == 22 || $characterChoice == 11){
        $firstCharacterCreated = array_merge(autoNewCharacterCreate($maleNames, $femaleNames, $lastNames), skillDiv($special, 40, 10));
        $secondCharacterCreated = array_merge(autoNewCharacterCreate($maleNames, $femaleNames, $lastNames), skillDiv($special, 40, 10));
        echo 'First character: ';
        print_r($firstCharacterCreated);
        echo 'Second character: ';
        print_r($secondCharacterCreated);
    }

    else echo 'Invalid input';

    function get_name($player) {


        $full_string = $player[0];
        $space_counter = 0;
        $name_length = "";

        for ($i = 0; $i < mb_strlen($full_string); $i++) {

            if ($space_counter == 2) {
                $name_length = $i - 1;;
                break;
            }

            if ($full_string[$i] == " ") {
                ++$space_counter;
            }

        }
        $name = substr($full_string, 0, intval($name_length));
        return $name;

    }

    $player1_name = get_name($firstCharacterCreated);
    $player2_name = get_name($secondCharacterCreated);

    function get_damage($player){

        $p_lower_damage_limit = round($player[S] / 2 + 1);
        $p_higher_damage_limit = round($player[S] / 2 + 4);

        $damage_values = [$p_lower_damage_limit, $p_higher_damage_limit];
        return $damage_values;

    };

    $player1_damage = get_damage($firstCharacterCreated);
    $player2_damage = get_damage($secondCharacterCreated);


    function get_health($player) {

        $health = 30 + $player[S] + ($player[E] * 2);
        return $health;

    }

    $player1_health = get_health($firstCharacterCreated);
    $player2_health = get_health($secondCharacterCreated);

    function fight($player1_name, $player2_name, $player1_damage, $player2_damage, $player1_health, $player2_health) {

        $player_1_announcement = $player1_name . " has " . $player1_health . "HP " . "and has a weapon equipped with " . $player1_damage[0] . " - " . $player1_damage[1] . " Damage" . PHP_EOL;
        $player_2_announcement = $player2_name . " has " . $player2_health . "HP " . "and has a weapon equipped with " . $player2_damage[0] . " - " . $player2_damage[1] . " Damage" . PHP_EOL;
        echo $player_1_announcement;
        echo $player_2_announcement;

        $fighter_1 = [$player1_name, $player1_damage, $player1_health];
        $fighter_2 = [$player2_name, $player2_damage, $player2_health];


        fwrite(STDOUT, "Press 1 to for them to fight ");
        $starter = trim(fgets(STDIN));

        function fight_calculate($fighter_1, $fighter_2) {

            $fighter_1_curr_health = $fighter_1[2];
            $fighter_2_curr_health = $fighter_2[2];
            $i = 1;

            while ($fighter_1_curr_health > 0 && $fighter_2_curr_health > 0) {

                $player1_dmg = rand($fighter_1[1][0], $fighter_1[1][1]);
                $player2_dmg = rand($fighter_2[1][0], $fighter_2[1][1]);

                echo "************** ROUND". $i . " **************" . PHP_EOL;

                echo ">>>" . $fighter_1[0] . " hits " . $fighter_2[0] . " and deals " . $player1_dmg . " damage" . PHP_EOL;
                $fighter_2_curr_health -= $player1_dmg;
                echo $fighter_2[0] . " has " . $fighter_2_curr_health . " health left" . PHP_EOL;

                if ($fighter_1_curr_health) {
                    echo $fighter_2[0] . " hits " . $fighter_1[0] . " and deals " . $player2_dmg . " damage" . PHP_EOL;
                    $fighter_1_curr_health -= $player2_dmg;
                    echo ">>>" . $fighter_1[0] . " has " . $fighter_1_curr_health . " health left" . PHP_EOL;
                } else {
                    break;
                }

                $i++;
            }

            echo "************** WE HAVE A WINNER **************" . PHP_EOL;

            if ($fighter_2_curr_health <= 0) {
                echo $fighter_1[0] . " WINS!" . " | " . $fighter_2[0] . " bites the dust." . PHP_EOL;
                return true;
            } else if ($fighter_1_curr_health <= 0) {
                echo $fighter_2[0] . " WINS!" . " | " . $fighter_1[0] . " bites the dust." . PHP_EOL;
                return true;
            }

            return true;
        }

        if ($starter == 1) {
            echo "************** FIGHT **************" . PHP_EOL;
            fight_calculate($fighter_1, $fighter_2);
        } else {
            return false;
        }

    }

    fight($player1_name, $player2_name, $player1_damage, $player2_damage, $player1_health, $player2_health);

};

$fallout();





























