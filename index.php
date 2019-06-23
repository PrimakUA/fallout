<?php
session_start();

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

        .success {
            color: #00ff00;
        }

        .my-padding {
            padding-left: 160px;
        }

        .my-table {
            border: 1px #555555 solid;
            border-collapse: collapse;
        }
    </style>
</head>
<body bgcolor="#f5f5f5">

<article>
    <h1>Главная</h1>
    <form action="index.php" method="post">

        <div class="form-row">
            <div class="form-padding">
                <input type="button" value="Создать автоматически" onClick='location.href="autocreate.php"'>
                <input type="button" value="Создать вручную" onClick='location.href="form.php"'>
            </div>
        </div>

        <div style="width:670px;" class="my-padding">
            <?php
            if (isset($_SESSION['success'])) {
                echo '<div class="success">' . $_SESSION['success'] . '</div>';
                unset($_SESSION['success']);
            }
            ?>
        </div>

        <label>
            <div align="center"><img src="logo.jpg"></div>
        </label>
    </form>

</article>
</body>
</html>