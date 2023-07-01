<?php
	$host = 'localhost'; // имя хоста
	$user = 'root';      // имя пользователя
	$pass = '';          // пароль
	$name = 'basket';      // имя базы данных
	
	$link = mysqli_connect($host, $user, $pass, $name);
	if (!$link) {
		die("Ошибка: " . mysqli_connect_error());
	}
?>