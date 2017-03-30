<?php
	session_start();
	require_once "connect.php";
	require_once "Bazy.php";
	if(!isset($_POST['login']) && !isset($_POST['haslo'])){
		header('Location: gra.php');
		exit();
	}
	
	$uzytkownicy = new Baza($host, $db_user, $db_password, $db_name);
	$uzytkownicy->zaloguj();
?>