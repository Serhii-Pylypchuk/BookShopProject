//Создаем клас Model
function Model(ajaxObject,validationObject){
	
	//Ссылки на объекты
	var ajax = ajaxObject;//Создаем 'ссылку' на объект класа AjaxRequest
	var validation = validationObject;//Создаем 'ссылку' на объект класа Validation
	var self = this;//Создаем 'ссылку' на собственный объект
	
	//Ссылки на элементы формы
	var el_count_form = document.forms.el_count_form;//Получает форму ввода количества елементов на странице	
	var user_form = document.forms.user_form;//Получает форму заказа книги
	
	if(user_form){
		var user_name = user_form.elements.user_name;//Получает доступ к полю ввода имени заказчика
		var user_email = user_form.elements.user_email;//Получает доступ к полю ввода имени заказчика	
	}
	
	
	//Возвращает часть урла после хеша, который будет ключем к таблице с книгами автора
	function getUrlKey(arg){//searh или hash
		if(arg == 'searh'){
			
			var serch_string = window.location.search;//Получаем часть урла после знака ?
			if(serch_string){
				var searh_key = serch_string.substring(1);//Обрезаем знак ?
				return searh_key;//Возвращаем имя таблицы с книгами автора
			}else{
				return false;
			}
	
		}else if(arg == 'hash'){
			
			var hash_string = window.location.hash;//Получаем часть урла после знака #
			if(hash_string){
				var hash_key = hash_string.substring(4);//Обрезаем ненужное, получаем текущую страницу
				return hash_key;//Возвращаем текущую страницу
			}else{
				return 1;
			}
				
		}	
	}
	
	//Возвращает значение атрибута name, объекта по которому кликнули (для установки количества елементов на странице)
	this.get_book_id = function(){
		var current_book_id = event.target.name;//Получаем атрибут name дескриптора, по которому произошел клик 
		return current_book_id;//Возвращаем
	}
	
	//Получает и обрабатывает значение поля с количеством элементов
	function get_element_count(){
		if(el_count_form){
			var element_count_value = el_count_form.elements.el_count.value;//Получаем введенное количество элементов на странице
		}else{
			var element_count_value = 5; //По умолчанию 5 элементов на странице
		}

		if(element_count_value){
			return Math.round(element_count_value);//Округляем его к большему значению, если введено число типа float
		}else{
			return 0;
		}
	}
	
	//Функция перехода на первую страницу
	this.get_first_page = function(){
		window.location.hash = "PAG1";
	}
	
	//Делает запрос в базу, и выводит информацию в container 
	this.get_ajax_elements_list = function(filename,container,el_count){
		
		//Создаем функцию обработчик
		function Handler(Request){
			document.getElementById(container).innerHTML = Request.responseText;
			//Если конлейнер для списка книг или писателей пустой, перебросить на 1 страницу
			if(!validation.is_class_element_empty('.books_list')){self.get_first_page();}
			if(!validation.is_class_element_empty('.writers_list')){self.get_first_page();}
		}
		
		if(el_count){
			var count = el_count; //Количество елементов на странице
		}else{
			var count = 5;//По умолчанию 5
		}
		
		var book_table_key = getUrlKey('searh');//Получаем ключ к таблице со списком книг писателя через урл(символы между ? и #)
		var page = getUrlKey('hash');//Получаем номер текущей страницы через урл(символы после #)
		var parameters = {'book_table_key':book_table_key, 'page':page, 'count':count};
		var paramJSON = JSON.stringify(parameters);//Кодируем наш массив
		
		//Отправляем запрос
		ajax.SendRequest("GET",filename,"parameters="+paramJSON,Handler);
	}
	
	//Устанавливает  количество элементов на странице
	this.set_el_count_func = function(path){
		var count = get_element_count();
		if(count && el_count_form){
			if(validation.el_countValidation(count,el_count_form)){
				//Делаем запрос с указанием количества елементов на странице
				self.get_ajax_elements_list(path,"content",count);
				//После установки количества элементов на странице, 
				//переходим на первую страницу во избежании недоразумения
			}
		}else{
			self.get_ajax_elements_list(path,"content",count);
		}
	}
	
	//Очищает контейнер, куда приходит ответ из сервера об отправке заказа
	function clean_server_answer(server_answer_container) {
		server_answer_container.classList.remove('show');
		server_answer_container.innerHTML = '';
		
	}
	
	this.clean_user_form = function(){
		user_name.value = '';
		user_email.value = '';
		document.querySelectorAll("span[name = 'info']")[0].innerHTML = '';
		document.querySelectorAll("span[name = 'info']")[1].innerHTML = '';
	}
	
	//Отправляет данные на сервер через ajax
	function send_order_by_ajax(bookid, bookstablename, username, useremail){
		//Создаем функцию обработчик
		var order_handler = function(Request){
			var server_answer_container = document.querySelector('.user_form_server_answer');
			server_answer_container.classList.add('show');
			server_answer_container.innerHTML = Request.responseText;
			self.clean_user_form();

			setTimeout(clean_server_answer, 3000, server_answer_container);
		}

		var parameters = {'bookid':bookid, 'bookstablename':bookstablename, 'username':username, 'useremail':useremail};
		var paramJSON = JSON.stringify(parameters);//Кодируем наш массив
		
		//Отправляем запрос. Два варианта отправки. Данные пользователя решил отправить для эксперимента ка POST
		//ajax.SendRequest("GET","php/send_user_order.php","parameters="+paramJSON,order_handler);
		ajax.SendRequest("POST","php/mail/SendMail.php","parameters="+paramJSON,order_handler);
	}
	
	//Получает форму отправки данных о заказе и заказчике на почту заказчика через AJAX
	this.submit_user_form = function(){
		var bookid_value = user_form.elements.book_id.value;//Получаем id книги, которую пользователь хачет заказать
		var bookid = bookid_value.substring(2);
		var bookstablename = getUrlKey('searh');//Получаем имя таблицы со списком книг писателя через урл(символы между ? и #)
		var username = validation.userValidation(user_name);//Получаем валидированое имя пользователя
		var useremail = validation.emailValidation(user_email);//Получаем валидированый email пользователя
		
		if(bookid && bookstablename && username && useremail){	
			send_order_by_ajax(bookid, bookstablename, username, useremail);
		}
	}
	
}