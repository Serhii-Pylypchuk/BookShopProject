function AjaxRequest(){
	
	var self = this;//Ссылка на собственный объект
	
	//Создает AJAX запрос с учетом особенностей броузера
	function CreateRequest(){
		var Request = false;//По умолчанию Request равен false

		if (window.XMLHttpRequest){
			//Gecko-совместимые браузеры, Safari, Konqueror
			Request = new XMLHttpRequest();//Request равен объекту запроса
		}
		else if (window.ActiveXObject){
			//Internet explorer
			try{
				 Request = new ActiveXObject("Microsoft.XMLHTTP");//Request равен объекту запроса
			}    
			catch (CatchException){
				 Request = new ActiveXObject("Msxml2.XMLHTTP");//Request равен объекту запроса
			}
		}
		
		if (!Request){
			alert("Невозможно создать XMLHttpRequest");
		}
		return Request; //Возвращаем объект запроса
	} 
	
	
	// Функция посылки запроса к файлу на сервере
	// r_method  - тип запроса: GET или POST
	// r_path    - путь к файлу
	// r_args    - аргументы вида a=1&b=2&c=3... или закодированный массив
	// r_handler - функция-обработчик ответа от сервера
	
	
	//Создаём запрос
	var Request = CreateRequest(); 
	
	//Отсылает запрос с учетом пареметров
	this.SendRequest = function(r_method, r_path, r_args, r_handler){
		
		//Проверяем существование запроса еще раз
		if (!Request){
			return false;
		}
		
		//Назначаем пользовательский обработчик
		Request.onreadystatechange = function(){
			
			//Если обмен данными завершен
			if (Request.readyState == 4){
				//Передаем управление обработчику пользователя
				r_handler(Request);
				unlock_window();//Снимает блокировку экрана, после успешной загрузки информации
			}
		}
		
		//Проверяем, если требуется сделать GET-запрос
		if (r_method.toLowerCase() == "get" && r_args.length > 0){
			r_path += "?" + r_args;
			
			//Инициализируем соединение
			Request.open(r_method, r_path, true);
		}
		
		if (r_method.toLowerCase() == "post"){
			//Если это POST-запрос
			Request.open(r_method, r_path, true);
			//Устанавливаем заголовок
			Request.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=utf-8");
			//Request.open(r_method, r_path, true);
			//Посылаем запрос
			Request.send(r_args);
		}
		else{
			//Если это неизвестный запрос
			//Посылаем нуль-запрос
			Request.send(null);
		}
	}
	
	//Снимает блокировку экрана, после успешной загрузки информации
	function unlock_window(){
		var unlock_window_elem = document.querySelector(".upfloating_container");
		var unlock_message_elem = document.querySelector(".messageBox");
		if(unlock_window_elem && unlock_message_elem){
			unlock_window_elem.classList.remove('show');
			unlock_message_elem.classList.remove('show');		
		}
		
	}
}