<?php
//Подключаем скрипты
require_once 'db_connection.php'; 
require_once 'View.php';

//Создаем клас  Controller с которым будем взаимодействовать клиент, и который наследует методы из класа View
class Controller extends View{

	private $db_link;
	
	public function __construct($link){
		$this -> db_link = $link;
	}
	
	public function start_writers_controller(){
		if($_SERVER['REQUEST_METHOD'] == 'GET'){
			
			if(isset($_GET)){//Если массив существует
			
				$parameters_arr = json_decode($_GET['parameters']);//Розшифровуем массив переданной информации
				$writers_table_name = 'writers';//Получаем имя таблицы к которой будем обращаться
				$elements_count = (int)trim($parameters_arr->{'count'});//Получаем количество элементов на странице
				$current_page = (int)trim($parameters_arr->{'page'});//Получаем текущую страницу
			
				//Формируем запрос к таблице с именем $writers_table_name
				//$query = "SELECT * FROM ".$writers_table_name;
				
				//Получаем массив данных из базы по запросу $query
				$result = $this -> db_link -> query("SELECT * FROM ".$writers_table_name) or die("<p class = 'neg_answer'> К сожалению не удалось сформировать список писателей </p>");//$link -> error() - информация об ошибке

				if($result){
					//Количество полученных строк таблицы
					$rows_count = $result -> num_rows;

					//Отображение информации по запросу
					$this -> show_writers_list($result,$rows_count,$elements_count,$current_page);//Список писателей
					$this -> show_pagination($rows_count, $elements_count, $current_page);//Пагинация	
					
					// очищаем результат
					$result -> free_result();
				}
				//Закрывает соединение
				$this -> db_link -> close();
			}else{
				echo "<p class = 'neg_answer'> Данные не были переданы </p>";
			}
		}else{
			echo "<p class = 'neg_answer'> Ajax запрос не удался </p>";
		} 
	}
	
	public function start_books_controller(){
		
		if($_SERVER['REQUEST_METHOD'] == 'GET'){
			
			if(isset($_GET)){//Если массив
				
				$parameters_arr = json_decode($_GET['parameters']);//Розшифровуем массив переданной информации
				$book_table_name = trim($parameters_arr->{'book_table_key'});//Получаем имя таблицы к которой будем обращаться
				$elements_count = (int)trim($parameters_arr->{'count'});//Получаем количество элементов на странице
				$current_page = (int)trim($parameters_arr->{'page'});//Получаем текущую страницу
				
				//указывает серверу нa необходимость перекодировать результаты запроса в определенную кодировку перед выдачей их клиенту. Это делается во избежании отображения кирилических символов как знаков вопроса
				$this -> db_link -> query("SET character_set_results='utf8'");
				
				//OOP подход
				$result = $this -> db_link -> query("SELECT * FROM ".$book_table_name) or die("<p class = 'neg_answer'> К сожалению книги данного автора отсутствуют </p>");//$link -> error() - информация об ошибке
				 
				if($result){
					//Количество полученных строк таблицы
					$rows_count = $result -> num_rows;
					 
					//Отображение информации по запросу
					$this -> show_books_list($rows_count, $result, $elements_count, $current_page);//Список книг
					$this -> show_pagination($rows_count, $elements_count, $current_page);//Пагинация
					
					// очищаем результат
					$result -> free_result();
				}
				//Закрывает соединение
				$this -> db_link -> close();
			}else{
				echo "<p class = 'neg_answer'> Данные не были переданы </p>";
			}
		}else{
			echo "<p class = 'neg_answer'> Ajax запрос не удался </p>";
		} 
	}
}

$book_shop_controller = new Controller($link);

//$book_shop_controller -> start_books_controller();
//$book_shop_controller -> start_writers_controller();


?>
