<?php
session_start();

require_once($_SERVER['DOCUMENT_ROOT'] . '/fallout/_db.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/fallout/_functions.php');

$first_name = '';
$last_name = '';
$age = '';
$gender_id = 0;


if (isset($_POST['first_name'])) $first_name = $_POST['first_name'];
if (isset($_POST['last_name'])) $last_name = $_POST['last_name'];
if (isset($_POST['gender_id'])) $gender_id = $_POST['gender_id'];
if (isset($_POST['age'])) $age = $_POST['age'];

$errors = [];
if (isset($_POST['send'])) {
    if (strlen($first_name) <= 0) $errors['first_name'] = 'Поле "Имя персонажа" не заполнено.';
    if (strlen($last_name) <= 0) $errors['last_name'] = 'Поле "Фамилия персонажа" не заполнено.';
    if ($gender_id <= 0) $errors['gender_id'] = 'Пол не выбран';
    if ($age <= 0) $errors['age'] = 'Возраст не указан';

    if (count($errors) <= 0) {

        $newCharacterCreated = array_merge(newCharacterCreate($first_name, $last_name, $age, $gender_id), special());
        $gender = $newCharacterCreated[3];
        $s = $newCharacterCreated['S'];
        $p = $newCharacterCreated['P'];
        $e = $newCharacterCreated['E'];
        $c = $newCharacterCreated['C'];
        $i = $newCharacterCreated['I'];
        $a = $newCharacterCreated['A'];
        $l = $newCharacterCreated['L'];

        echo 'Manual creation: ';
        if ($newCharacterCreated > 0) {
            $link = Db::getDbLink();

            $query = 'INSERT INTO characters (first_name, second_name, gender, age, s, p, e, c, i ,a, l) VALUES ("' . add_slashes($first_name) . '", "' . add_slashes($last_name) . '", "' . add_slashes($gender) . '", ' . add_slashes($age) . ', ' . add_slashes($s) . ', ' . add_slashes($p) . ', ' . add_slashes($e) . ', ' . add_slashes($c) . ', ' . add_slashes($i) . ', ' . add_slashes($a) . ', ' . add_slashes($l) . ')';
            $result = mysqli_query($link, $query);
            if ($result) {
                $_SESSION['success'] = 'Character successfully created!';
                Header('Location: /fallout/index.php');
                exit;
            } else {
                die('Fail ');
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Fallout</title>
    <link rel="stylesheet" href="/fallout/style.css">
</head>
<body>
<nav><a href="index.php">Main</a> | Manual creation</nav>
<article>
    <h2>Creation new character</h2>

    <form action="form.php" method="post">
        <input type="hidden" name="send" value="1">
        <div class="form-row">
            <label class="form-label">First name<span class="form-star">*</span></label>
            <input type="text" class="form-field-text" name="first_name" value="<?php echo $first_name; ?>"
                   placeholder="Enter first name">
            <?php
            if (isset($errors['first_name'])) {
                echo '<div class="form-padding form-error">' . $errors['first_name'] . '</div>';
            }
            ?>
        </div>

        <div class="form-row">
            <label class="form-label">Last name<span class="form-star">*</span></label>
            <input type="text" class="form-field-text" name="last_name" value="<?php echo $last_name; ?>"
                   placeholder="Enter last name">
            <?php
            echo '<div class="form-padding form-error';
            if (!isset($errors['last_name'])) echo ' hidden';
            echo '">';
            if (isset($errors['last_name'])) echo $errors['last_name'];
            echo '</div>';
            ?>
        </div>

        <div class="form-row">
            <label class="form-label">Age<span class="form-star">*</span></label>
            <input type="text" class="form-field-text" name="age" value="<?php echo $age; ?>"
                   placeholder="Enter age">
            <?php
            if (isset($errors['age'])) {
                echo '<div class="form-padding form-error">' . $errors['age'] . '</div>';
            }
            ?>
        </div>

        <div class="form-row">
            <label class="form-label">Set gender<span class="form-star">*</span></label>
            <select class="form-field" name="gender_id">
                <option value="0">Set gender</option>
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
                <input type="submit" value="Save">
                <input type="reset" value="Clear">
            </div>
        </div>
    </form>
</article>
</body>
</html>