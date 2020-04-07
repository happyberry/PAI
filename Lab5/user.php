<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>PHP</title>
    <meta charset='UTF-8' />
</head>
<body>
    <?php
        require_once("funkcje.php");
        echo "Zalogowano<br>";
        if (isSet($_SESSION["zalogowany"])) {
            if($_SESSION["zalogowany"] == 1) {
                echo "Witaj, " . $_SESSION["zalogowanyImie"] . "<br>";
                if(isSet($_POST["myfile"])){
                    $currentDir = getcwd();
                    $uploadDirectory = "/zdjeciaUzytkownikow";
                    $fileName = $_FILES["myfile"]["name"];
                    $fileSize = $_FILES["myfile"]["size"];
                    $fileType = $_FILES["myfile"]["type"];
                    if($fileName != "" and ($fileType == "image/png" or $fileType == "image/jpeg"
                    or $fileType == "image/JPEG" or $fileType == "image/PNG")) {
                        $uploadPath = $currentDir . $uploadDirectory . $fileName;
                        if (move_uploaded_file($fileName, $uploadPath)) echo "Zdjęcie załadowane";
                    }
                }
            } else {
                header("Location: index.php");
            }
        }
    ?>
    <form action="user.php"  method='POST' enctype='multipart/form-data'>
        <fieldset>
        <legend>Wgraj zdjęcie</legend>
			<input name="myfile" type="file" value="Wyślij plik">
        </fieldset>
	</form>
    <img src = "zdjecie.png" alt="Zdjęcie bobra i wilka">
    <form action="index.php" method="post">
        <fieldset>
        <legend>Wyloguj</legend>
		    <input type="submit" name="wyloguj" value="Wyloguj">
        </fieldset>
	</form>
    <a href="index.php">Index</a>
</body>
</html>