<?php
	session_start();
	require_once 'connect.php';
	
	$title = $_POST['list_name'];
	$text = $_POST['comment'];
	$rating = $_POST['rating'];

	// var_dump($_FILES);

	$path = 'posters/' . time() . $_FILES['poster']['name'];
	move_uploaded_file($_FILES['poster']['tmp_name'], '../' . $path);

	// var_dump($path);

	$user_id = $_POST['user_id'];

	
	$insert = insert("INSERT INTO `list` (`list_name`, `comment`, `rating`, `user_id`, `poster`) VALUES ('$title', '$text', '$rating', '$user_id', '$path')"); 
		if($insert){
			header('Location: ../profile.php');
		} else {
			echo 'Ошибка добавления';
		}





		// NULL писать не обязательно, вообще первый столбик который выступает в роли ID можно не указывать
	
	
		
		//header('Location: ../index.php');
	
