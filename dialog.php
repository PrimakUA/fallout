<?php
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

} else echo 'Invalid input';


echo "The initial values of the character's skills" . PHP_EOL;
/*
Высчитываем процент развития всех навыков при создании персонажа в зависимости от значений SPECIAL
*/
$combatSkills = [
    "Small Guns" => $smallGuns = 35 + $newCharacterCreated[A] . "%",
    "Big Guns" => $bigGuns = 10 + $newCharacterCreated[A] . "%",
    "Energy Weapons" => $energyWeapons = 2 * $newCharacterCreated[A] . "%",
    "Unarmed" => $unarmed = 30 + ($newCharacterCreated[A] + $newCharacterCreated[S]) * 2 . "%",
    "Melee Weapons" => $meleeWeapons = 20 + ($newCharacterCreated[A] + $newCharacterCreated[S]) * 2 . "%",
    "Throwing" => $throwing = 4 * $newCharacterCreated[A] . "%"];

$activeSkills = [
    "First Aid" => $firstAid = 2 * $newCharacterCreated[P] . "%",
    "Doctor" => $doctor = 5 + ($newCharacterCreated[P] + $newCharacterCreated[I]) . "%",
    "Sneak" => $sneak = 5 + $newCharacterCreated[A] * 3 . "%",
    "Lockpick" => $lockpick = 10 + ($newCharacterCreated[P] + $newCharacterCreated[A]) . "%",
    "Steal" => $steal = 3 * $newCharacterCreated[A] . "%",
    "Traps" => $traps = 10 + ($newCharacterCreated[P] + $newCharacterCreated[A]) . "%",
    "Science" => $science = 10 + (2 * $newCharacterCreated[I]) . "%",
    "Repair" => $repair = 3 * $newCharacterCreated[I] . "%"];

$passiveSkills = [
    "Speech" => $speech = 5 * $newCharacterCreated[C] . "%",
    "Barter" => $barter = 4 * $newCharacterCreated[C] . "%",
    "Gambling" => $gambling = 5 * $newCharacterCreated[L] . "%",
    "Outdoorsman" => $outdoorsman = 2 * $newCharacterCreated[E] + 2 * $newCharacterCreated[I] . "%"];

$skills = ["Combat skills" => $combatSkills, "Active skills" => $activeSkills, "Passive skills" => $passiveSkills];

print_r($skills);