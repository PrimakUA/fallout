<?php
session_start();
//require_once($_SERVER['DOCUMENT_ROOT'] . '/_db.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/_functions.php');


$first_name = '';
$last_name = '';
$team_id = 0;
$country_id = 0;

if(isset($_POST['first_name'])) $first_name = $_POST['first_name'];
if(isset($_POST['last_name'])) $last_name = $_POST['last_name'];
if(isset($_POST['team_id'])) $team_id = $_POST['team_id'];
if(isset($_POST['country_id'])) $country_id = $_POST['country_id'];

$racer_info = (isset($_POST['racer_info'])) ? $_POST['racer_info'] : '';

$errors = [];
if(isset($_POST['send']))
{
    if(strlen($first_name)<=0) $errors['first_name'] = 'Поле "Имя гонщика" не заполнено.';
    if(strlen($last_name)<=0) $errors['last_name'] = 'Поле "Фамилия гонщика" не заполнено.';
    if($team_id<=0) $errors['team_id'] = 'Команда не выбрана';
    if($country_id<=0) $errors['country_id'] = 'Страна не выбрана';

    if(count($errors)<=0)
    {
        $link = Db::getDbLink();

        $query = 'INSERT INTO drivers (first_name, last_name, team_id, country_id, info) VALUES ("'.add_slashes($first_name).'", "'.add_slashes($last_name).'", '.add_slashes($team_id).', '.add_slashes($country_id).', "'.add_slashes($racer_info).'")';
        $result = mysqli_query($link, $query);
        if($result)
        {
            $_SESSION['success'] = 'Гонщик успешно добавлен.';
            Header('Location: /drivers/drivers.php');
            exit;
        }
        else
        {
            die('Ошибка при сохранении гонщика');
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Formula 1</title>
    <link rel="stylesheet" href="/aaa/style.css">
</head>
<body>

<nav><a href="/index.php">Главная</a> | <a href="/drivers/drivers.php">Гонщики</a> | Новый гонщик</nav>
<article>
    <h2>Создание нового гонщика</h2>


    <form action="/drivers/add_racer.php" method="post">
        <input type="hidden" name="send" value="1">
        <div class="form-row">
            <label class="form-label">Имя гонщика<span class="form-star">*</span></label>
            <input type="text" class="form-field-text" name="first_name" value="<?php echo htmlspecialchars($first_name); ?>" placeholder="Введите имя гонщика">
            <?php
            if(isset($errors['first_name']))
            {
                echo '<div class="form-padding form-error">'.$errors['first_name'].'</div>';
            }
            ?>
        </div>

        <div class="form-row">
            <label class="form-label">Фамилия гонщика<span class="form-star">*</span></label>
            <input type="text" class="form-field-text" name="last_name" value="<?php echo htmlspecialchars($last_name); ?>" placeholder="Введите фамилию гонщика">
            <?php
            echo '<div class="form-padding form-error';
            if(!isset($errors['first_name'])) echo ' hidden';
            echo '">';
            if(isset($errors['first_name'])) echo $errors['first_name'];
            echo '</div>';
            ?>
        </div>

        <div class="form-row">
            <label class="form-label">Команда<span class="form-star">*</span></label>
            <select class="form-field" name="team_id">
                <option value="0">Выберите команду</option>
                <?php
                $teams = getTeams();
                foreach ($teams as $key =>$value) {
                    echo '<option value="'.$key.'"';
                    if($team_id==$key) echo ' selected="selected"';
                    echo '>'.$value.'</option>';
                }
                ?>
            </select>
            <?php
            if(isset($errors['team_id']))
            {
                echo '<div class="form-padding form-error">'.$errors['team_id'].'</div>';
            }
            ?>
        </div>

        <div class="form-row">
            <label class="form-label">Страна<span class="form-star">*</span></label>
            <select class="form-field" name="country_id">
                <option value="0">Выберите страну</option>
                <?php
                $countries = getCountries();
                foreach ($countries as $key =>$value) {
                    echo '<option value="'.$key.'"';
                    if($country_id==$key) echo ' selected="selected"';
                    echo '>'.$value.'</option>';
                }
                ?>
            </select>
            <?php
            if(isset($errors['country_id']))
            {
                echo '<div class="form-padding form-error">'.$errors['country_id'].'</div>';
            }
            ?>
        </div>

        <div class="form-row">
            <label class="form-label">Информация</label>
            <textarea class="form-field-text" placeholder="Введите информацию о гонщике" name="racer_info"><?= htmlspecialchars($racer_info); ?></textarea>
        </div>

        <div class="form-row">
            <div class="form-padding">
                <input type="submit" value="Сохранить" >
                <input type="reset" value="Очистить" >
            </div>
        </div>
    </form>
</article>
</body>
</html>

$characters = 'characters.txt';

$fileWrite = fopen($characters, 'a+');
fwrite($fileWrite, '****************************************************************' . PHP_EOL);
foreach ($newCharacterCreated as $key => $value) {
fwrite($fileWrite, $key . ' - ' . $value . PHP_EOL);
}
fwrite($fileWrite, '****************************************************************' . PHP_EOL . PHP_EOL);
fclose($fileWrite);



