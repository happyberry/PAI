<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>PHP</title>
    <meta charset='UTF-8' />
</head>
<body>
    <?php
        if(isSet($_GET["utworzCookie"])){
            $czas = $_GET["czas"];
            setcookie("testoweCiasteczko", "1500", time() + $czas, "/");
            echo "Wysłano cookie<br>";
        }
    ?>
    <a href="index.php">Wstecz</a>
</body>
</html>