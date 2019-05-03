<?php
 class Validation{
	
	//Создаем паттерны по которым будем проверять наши данные
	private $user_name_pattern = "/[\<\>@#\$\^&\*\+=\\~\[\]\{\}\|\`,.\d\?:;№!%)(_\"']/g";
	private $user_email_pattern = "/[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}/i";
	
	//Функция проверки имени пользователя на наличие запрещенных символов
	public function user_name_validation($username){
		$reg_exp_resolt = preg_match($user_name_pattern, $username);
		if(!$reg_exp_resolt){
			return $username;
		}else{
			return false;
		}
	}
	//Функция проверки email пользователя на наличие запрещенных символов
	public function user_email_validation($useremail){
		$reg_exp_resolt = preg_match($user_email_pattern, $useremail);
		if(!$reg_exp_resolt){
			return $useremail;
		}else{
			return false;
		}
	}

	//Получаем текущее время
	private function get_valid_date(){
		date_default_timezone_set("Europe/Minsk");//Устанавливает временную зону по умолчанию для всех функций даты/времени в скрипте
		$date = date('d-m-Y H:i:s',time());//Получаем системное время в заданом формате 
		return $date; 
	}
	
	//Отправляет почту, и возвращает true - если заказ отправлен успешшно, или false если нет
	public function send_valid_mail($useremail, $username, $book_name, $writer_name){
		date_default_timezone_set("Europe/Minsk");
		$current_date = $this -> get_valid_date();
		$subject = 'Заказ книги '.$book_name;
		$message = "Уважаемый ".$username.", вы заказали книгу: ".$book_name.".  Автор: ".$writer_name.".  Дата и время: ".$current_date;
		$headers = 'From: book_shop@company.com';
		
		if($book_name && $writer_name && $current_date){
			if(mail($useremail,$subject,$message,$headers)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
 }
 
?>