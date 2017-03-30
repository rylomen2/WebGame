<?php
	session_start();
	if(!isset($_SESSION['udanarejestracja'])){
		header('Location: index.php');
		exit();
	}else{
		unset($_SESSION['udanarejestracja']);
	}
?>

<!DOCTYPE HTML>
<html lang="pl">
	<head>
		<meta charset="utf-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
		<title>Osadnicy - gra przeglądarkowa</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link href="https://fonts.googleapis.com/css?family=Caveat+Brush" rel="stylesheet">
	</head>

	<body>
	<br/>
	Dziękuję za zarejestrowanie się na naszej stronie.
	<a href="index.php">Zaloguj<a>
	</body>
</html>