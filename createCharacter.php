<?php
session_start();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Fallout</title>
    <link rel="stylesheet" href="/fallout/style.css">
</head>
<body bgcolor="#f5f5f5">
<nav><a href="/fallout/index.php">Main</a> | <a href="/fallout/list.php">Character list</a> | Сreate</nav>
<article>
    <h1>Select creation method</h1>
    <form action="list.php" method="post">
        <div class="form-row">
            <div class="form-padding">
                <input type="button" value="Auto creation" onClick='location.href="autocreate.php"'>
                <input type="button" value="Manual creation" onClick='location.href="form.php"'>
            </div>
        </div>
        <label>
            <div align="center"><img src="create.jpg"></div>
        </label>
    </form>

</article>
</body>
</html>