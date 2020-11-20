<?php
	session_start();
	require_once 'connect.php';
	
	$nickname = $_POST['nickname'];
	$login = $_POST['login'];
	$password = $_POST['password'];
	$password_confirm = $_POST['password_confirm'];

	if ($password === $password_confirm) {
		mysqli_query($connect,"INSERT INTO `users` (`nickname`, `login`, `password`) VALUES ('$nickname', '$login', '$password')");
		header('Location: ../signin.html');
		$_SESSION['msg'] = "Вы успешно зарегистрировались!";
	}
	else {
		$_SESSION['msg'] = "Пароли не совпадают!";
		header('Location: ../index.php');
	}
