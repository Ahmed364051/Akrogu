<?php

	$connect = mysqli_connect("localhost", "root", "root", "akrogu");

	if (!$connect) {
		die('Error connect to DB');
	}
	
	// Функция вставка нового значения по SQL запросу
	function insert($query){
		global $connect; // Объявляем переменную так как её не видно в пределах этой функции
		$result = mysqli_query($connect,$query);
		if($result){
			return true;
		} else {
			return false;
		}

	}
 
 	// Функция выгрузки из БД по SQL запросу
	function getAll($query){
		global $connect;
		$arr = []; // массив всех значений
		$res = mysqli_query($connect, $query); // запрос на сервер
		while ($result = mysqli_fetch_array($res)) { // проходится по всем записям
			$arr[]= $result; // записывает их в массив
		 }
		 if (count($arr)>0) { // если > 0 
		 	return $arr;
		 } else {
		 	return 'Error';
		 }
	}
	 	// Функция выгрузки из БД по SQL запросу
	function getOne($query){
		global $connect;
		$res = mysqli_query($connect, $query);
		$result = mysqli_fetch_assoc($res);
		 if ($result) {
		 	return $result;
		 } else {
		 	return 'Error';
		 }
	}