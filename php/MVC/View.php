<?php
//Подключаем скрипт с классом Модели
include_once "Model.php";

//Создаем клас отображения информации View, который наследует методы из класа Model, в котором реализуется логика
class View extends Model{
	//Функция выводит на экран список книг автора
	public function show_books_list($rows_count,$result,$elements_count,$current_page){
		$this -> create_books_list($rows_count,$result,$elements_count,$current_page);
	}
	
	//Функция выводит на экран список писателей
	public function show_writers_list($result,$rows_count,$elements_count,$current_page){
		$this -> create_writers_list($result,$rows_count,$elements_count,$current_page);
	}
	//Функция выводит на экран пагинацию
	public function show_pagination($rows_count, $elements_count, $current_page){
		$this -> create_pagination($rows_count, $elements_count, $current_page);
	}	
}

?>