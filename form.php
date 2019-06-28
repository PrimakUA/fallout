<?php
session_start();//correct2


$first_name = '';
$last_name = '';
$age = '';
$gender_id = 0;


if (isset($_POST['first_name'])) $first_name = $_POST['first_name'];
if (isset($_POST['last_name'])) $last_name = $_POST['last_name'];
if (isset($_POST['gender_id'])) $gender_id = $_POST['gender_id'];
if (isset($_POST['age'])) $age = $_POST['age'];


function newCharacterCreate($first_name, $last_name, $age, $gender_id)
{

    if ($gender_id == 1) {
        $sex = 'Male';
    } else $sex = 'Female';

    $newCharacterHandCreate[] = $first_name . ' ' . $last_name . ' ' . $age . ' ' . $sex;

    return $newCharacterHandCreate;

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

$errors = [];
if (isset($_POST['send'])) {
    if (strlen($first_name) <= 0) $errors['first_name'] = 'Поле "Имя персонажа" не заполнено.';
    if (strlen($last_name) <= 0) $errors['last_name'] = 'Поле "Фамилия персонажа" не заполнено.';
    if ($gender_id <= 0) $errors['gender_id'] = 'Пол не выбран';
    if ($age <= 0) $errors['age'] = 'Возраст не указан';

    if (count($errors) <= 0) {

        $newCharacterCreated = array_merge(newCharacterCreate($first_name, $last_name, $age, $gender_id), special());
        echo 'Manual creation: ';

        print_r($newCharacterCreated);

        if ($newCharacterCreated > 0) {
            $characters = 'characters.txt';
            print_r($gender_id);
            $fileWrite = fopen($characters, 'a+');
            fwrite($fileWrite, '****************************************************************' . PHP_EOL);
            foreach ($newCharacterCreated as $key => $value) {
                fwrite($fileWrite, $key . ' - ' . $value . PHP_EOL);
            }
            fwrite($fileWrite, '****************************************************************' . PHP_EOL . PHP_EOL);
            fclose($fileWrite);
            $_SESSION['success'] = 'Персонаж успешно создан.';
            Header('Location: index.php');
            exit;
        } else {
            die('Ошибка при создании персонажа');
        }
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>FalloutPHP10</title>
    <style>
        .form-label {
            width: 150px;
            float: left;
        }

        .form-field {
            width: 300px;
        }

        .form-field-text {
            width: 295px;
        }

        .form-padding {
            padding-left: 150px;
        }

        .form-star {
            color: red;
        }

        .form-error {
            color: red;
        }

        .form-row {
            padding-bottom: 15px;
        }
    </style>
</head>
<body>

<nav><a href="index.php">Главная</a> | Новый персонаж</nav>
<article>
    <h2>Создание нового персонажа</h2>

    <form action="form.php" method="post">
        <input type="hidden" name="send" value="1">
        <div class="form-row">
            <label class="form-label">Имя персонажа<span class="form-star">*</span></label>
            <input type="text" class="form-field-text" name="first_name" value="<?php echo $first_name; ?>"
                   placeholder="Введите имя персонажа">
            <?php
            if (isset($errors['first_name'])) {
                echo '<div class="form-padding form-error">' . $errors['first_name'] . '</div>';
            }
            ?>
        </div>

        <div class="form-row">
            <label class="form-label">Фамилия персонажа<span class="form-star">*</span></label>
            <input type="text" class="form-field-text" name="last_name" value="<?php echo $last_name; ?>"
                   placeholder="Введите фамилию персонажа">
            <?php
            echo '<div class="form-padding form-error';
            if (!isset($errors['last_name'])) echo ' hidden';
            echo '">';
            if (isset($errors['last_name'])) echo $errors['last_name'];
            echo '</div>';
            ?>
        </div>

        <div class="form-row">
            <label class="form-label">Возраст<span class="form-star">*</span></label>
            <input type="text" class="form-field-text" name="age" value="<?php echo $age; ?>"
                   placeholder="Введите возраст персонажа">
            <?php
            if (isset($errors['age'])) {
                echo '<div class="form-padding form-error">' . $errors['age'] . '</div>';
            }
            ?>
        </div>

        <div class="form-row">
            <label class="form-label">Выберите пол<span class="form-star">*</span></label>
            <select class="form-field" name="gender_id">
                <option value="0">Выберите пол</option>
                <?php
                $gender = [1 => 'Male', 2 => 'Female'];
                foreach ($gender as $key => $value) {
                    echo '<option value="' . $key . '"';
                    if ($gender_id == $key) echo ' selected="selected"';
                    echo '>' . $value . '</option>';
                }
                ?>
            </select>
            <?php
            if (isset($errors['gender_id'])) {
                echo '<div class="form-padding form-error">' . $errors['gender_id'] . '</div>';
            }
            ?>
        </div>

        <div class="form-row">
            <div class="form-padding">
                <input type="submit" value="Сохранить">
                <input type="reset" value="Очистить">
            </div>
        </div>
    </form>
</article>
</body>
</html>