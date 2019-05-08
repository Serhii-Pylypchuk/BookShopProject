<?php
//Подключаем скрипт с информацией для mysql и валидации
require_once '../MVC/db_connection.php';
require_once 'Validation.php'; 

class SendMail extends Validation{
	
	private $db_link;
	
	public function __construct($link){
		$this -> db_link = $link; 
	}
	
	public function send_user_order(){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			
			if(isset($_POST)){//Если массив переданных данных существует
			
				//Полученый массив даных от клиента розшифровуется на сервере
				$parameters_arr = json_decode($_POST['parameters']);
				
				//Данные для запроса в базу
				$bookid = (int)htmlentities(trim($parameters_arr->{'bookid'}));//id строки
				$bookstablename = htmlentities(trim($parameters_arr->{'bookstablename'}));//имя таблицы
				 
				//Имя пользователя и его email проходят дополнительную проверку на теже шаблоны что и в js
				$username = $this -> user_name_validation(trim($parameters_arr->{'username'}));
				$useremail = $this -> user_email_validation(trim($parameters_arr->{'useremail'}));
				
				//Формируется запрос в таблицу к определенной строке с id = $bookid
				//$query = "SELECT * FROM ".$bookstablename." WHERE id=".$bookid;
				
				//указывает серверу нa необходимость перекодировать результаты запроса в определенную кодировку перед выдачей их клиенту. Это делается во избежании отображения кирилических символов как знаков вопроса
				$this -> db_link -> query("SET character_set_results='utf8'");
				
				//Результат запроса
				$result = $this -> db_link -> query("SELECT * FROM ".$bookstablename." WHERE id=".$bookid) or die("К сожалению данные отсутствуют");//die("Ошибка ".mysqli_error($link));
				if($result && $username && $useremail){
					//Получаем нужный нам ряд
					$row = $result -> fetch_row();
					
					$book_name = $row[1];//Название книги
					$writer_name = $row[2];//Имя автора
					
					//Отправляет данные о заказе на почту заказчика
					if($this -> send_valid_mail($useremail, $username, $book_name, $writer_name)){
						echo "<span class = 'succes'>Заказ успешно отправлен на вашу почту<span>";
					}else{
						echo "<span class = 'error'>Произошла ошибка при отправлении заказа</span>";
					}
					
					// очищаем результат
					$result -> free_result();
				}else{
					//Здесь можно вывести подробную информацию о причинах неправыльной отправки почты
					echo 'Произошла ошибка. Данные заказа не были переданы';
				}
				//Закрывает соединение
				$link -> close($link);
			}else{
				echo 'Произошла ошибка. Данные заказа не были переданы';
			}
		}else{
			echo 'Ajax запрос не удался ';
		}
	}
}

//Создаем объект класа SendMail
$send_mail = new SendMail($link);
//Вызываем метод отправки заказа на почту заказчика
$send_mail -> send_user_order();	
?>
