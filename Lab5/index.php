<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>PHP</title>
    <meta charset='UTF-8' />
</head>
<body>
	<?php
		echo "<h1> Nasz system </h1>";
		if (isSet($_POST["wyloguj"])){
			$_SESSION["zalogowany"] = 0;
		}
		if (isSet($_COOKIE["testoweCiasteczko"])) {
			echo "Wartość cookie: " . $_COOKIE["testoweCiasteczko"] . "<br>";
		}
	?>
	
	<form action="logowanie.php" method="post">
		<fieldset>
			<legend>Logowanie:</legend>
			Login: <input type="text" name="login"><br>
			Hasło: <input type="password" name="haslo"><br>
			<input type="submit" name="zaloguj" value="Zaloguj">
		</fieldset>
	</form>
	<form action="cookie.php" method="get">
		<fieldset>
		<legend>Cookie:</legend>
			<input type="number" name="czas"><br>
			<input type="submit" name="utworzCookie" value="Utworz cookie">
		</fieldset>
	</form>
	<a href="user.php">User</a>
</body>
</html>