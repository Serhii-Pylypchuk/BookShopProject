<?php
//Подключаем скрипты
require_once 'MVC/Controller.php';
//Вызываем метод, который возвращает информацию на страницу со списком книг писателя
$book_shop_controller -> start_books_controller();
?>