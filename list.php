<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/fallout/_functions.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/fallout/_db.php');

$link = Db::getDbLink();

$q_teams_all = "SELECT COUNT(*) FROM `teams`";
$r_teams_all = mysqli_query($link, $q_teams_all);
$teams_count_all = mysqli_fetch_row($r_teams_all)[0];
$items_on_page = 15;
$num_pages = ceil($teams_count_all / $items_on_page);
$page = (isset($_GET['page'])) ? $_GET['page'] : 1;
$page = max(1, min($num_pages, intval($page)));

// сортировка
$sort = isset($_GET["sort"]) ? $_GET["sort"] : 'name';
$sort_by = isset($_GET["sort_by"]) ? 1 : 0;
if ($sort_by == 1) {
    $asc = " DESC";
    $desc = " ASC";
    $up = 0;
    $down = 1;
} else {
    $asc = " ASC";
    $desc = " DESC";
    $up = 1;
    $down = 0;
}
$sorts = [
    'id' => ['t.id ' . $asc, $up],
    'name' => ['t.name ' . $asc, $up],
    'constructor' => ['t.constructor ' . $asc, $up],
    'country' => ['country_name ' . $asc, $up],
];
$par_sort = ' ORDER BY ' . $sorts[$sort][0];
if ($sorts[$sort][1] == 1) {
    $order = '&#9650;';
    $sortstr = 'возрастающем';
} else {
    $order = '&#9660;';
    $sortstr = 'убывающем';
}


$q_teams = 'SELECT t.*, c.alias AS country_alias, c.name AS country_name FROM teams t
            LEFT JOIN countries c ON c.id=t.country_id
            ' . $par_sort . ' LIMIT ' . ($page - 1) * $items_on_page . ', ' . $items_on_page;

//echo $q_teams;
$r_teams = mysqli_query($link, $q_teams);
$teams_count = mysqli_num_rows($r_teams);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Formula 1</title>
    <link rel="stylesheet" href="/fallout/style.css">
</head>
<body bgcolor="#f5f5f5">

<nav><a href="/fallout/index.php">Главная</a> | Персонажи</nav>
<article>
    <h2>Список команд</h2>
    <div class="my-padding">
        <?php
        if (isset($_SESSION['success'])) {
            echo '<div class="success">' . $_SESSION['success'] . '</div>';
            unset($_SESSION['success']);
        }
        ?>
        <div style="width: 720px;">
            <?php
            $url_params = ['page'];
            ?>
            <table cellspacing="0" border="1" class="my-table">
                <tr>
                    <th width="50"><a href="teams.php?sort=id<?php echo getParStr($url_params);
                        if ($sort == 'id' && !$sort_by) echo '&sort_by=1'; ?>">Id<?php if ($sort == 'id') echo ' <span title="Отсортировано в ' . $sortstr . ' порядке">' . $order . '</span>'; ?></a>
                    </th>
                    <th width="250"><a href="teams.php?sort=name<?php echo getParStr($url_params);
                        if ($sort == 'name' && !$sort_by) echo '&sort_by=1'; ?>">Команда<?php if ($sort == 'name') echo ' <span title="Отсортировано в ' . $sortstr . ' порядке">' . $order . '</span>'; ?></a>
                    </th>
                    <th width="200"><a href="teams.php?sort=constructor<?php echo getParStr($url_params);
                        if ($sort == 'constructor' && !$sort_by) echo '&sort_by=1'; ?>">Конструктор<?php if ($sort == 'constructor') echo ' <span title="Отсортировано в ' . $sortstr . ' порядке">' . $order . '</span>'; ?></a>
                    </th>
                    <th width="150"><a href="teams.php?sort=country<?php echo getParStr($url_params);
                        if ($sort == 'country' && !$sort_by) echo '&sort_by=1'; ?>">Страна<?php if ($sort == 'country') echo ' <span title="Отсортировано в ' . $sortstr . ' порядке">' . $order . '</span>'; ?></a>
                    </th>
                    <th width="70"></th>
                </tr>
                <?php
                for ($i = 0; $i < $teams_count; $i++) {
                    $row = mysqli_fetch_assoc($r_teams);

                    echo '<tr>
                            <td>' . $row['id'] . '</td>
                            <td>' . $row['name'] . '</td>
                            <td>' . $row['constructor'] . '</td>
                            <td><img src="' . getFlag($row['country_alias']) . '" width="20"> ' . $row['country_name'] . '</td>
                            <td>
                                <a href="view_team.php?id=' . $row['id'] . '">П</a>
                                <a href="edit_team.php?id=' . $row['id'] . '">Р</a>
                                <a href="#" onclick="if(window.confirm(\'Вы действительно хотите удалить команду?\')) { window.location = \'delete_team.php?id=' . htmlspecialchars($row['id']) . '\'; } return false;">У</a>
                            </td>
                    </tr>';
                }

                ?>
            </table>

            <?php if ($num_pages > 1) : ?>
                <div style="text-align: center;">
                    Страница:
                    <?php
                    /*for($i=0; $i<$num_pages; $i++) {
                        if (($i+1) == $page) {
                            echo ($i+1)." ";
                        } else {
                            echo '<a href="'.$_SERVER['PHP_SELF'].'?page='.($i+1).'">'.($i+1)."</a> ";
                        }
                    }*/

                    $url_params = ['sort', 'sort_by'];
                    $url = 'teams.php?' . getParStr($url_params);
                    makePager($page, $num_pages, 2, $url);
                    ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

</article>
</body>
</html>