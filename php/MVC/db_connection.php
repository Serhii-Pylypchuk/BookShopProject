<?php
	$host = 'localhost'; // адрес сервера 
	$database = 'book_shop_project'; // имя базы данных 
	$user = 'root'; // имя пользователя 
	$password = ''; // пароль
	
	//$link = mysqli_connect($host, $user, $password, $database) or die("<p class = 'neg_answer'> Ошибка подключения к базе </p>" . mysqli_error($link));
	$link = new mysqli($host, $user, $password, $database) or die("<p class = 'neg_answer'> Ошибка подключения к базе </p>" . mysqli_error($link));
	
?>