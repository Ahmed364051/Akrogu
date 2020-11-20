<?php
	session_start();
	require_once 'connect.php';

	$login = $_POST['login'];
	$password = $_POST['password'];

	$check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");

	if (mysqli_num_rows($check_user) > 0) {

		$user = mysqli_fetch_assoc($check_user);

		$_SESSION['user'] = [
			"id_user" => $user['id_user'],
			"nickname" => $user['nickname'],
			"login" => $user['login'],
			"userpic" =>  $user['userpic']
		];

		header('Location: ../profile.php');
	}
	else {
		$_SESSION['msg'] = "Неверный логин или пароль!";
		header('Location: ../signin.php');
	}