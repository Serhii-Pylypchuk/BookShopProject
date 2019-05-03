
//Создаем класс Controller 
function Controller(myModel,myView){
	
	var model = myModel;//Создаем 'ссылку' на объект класа myModel
	var view = myView;//Создаем 'ссылку' на объект класа myView
	var self = this;//Ссылка на собственный объект
	
	var user_form = document.forms.user_form;//document.querySelector(".user_data_form");
	var el_count_form = document.forms.el_count_form;//Получает форму ввода количества елементов на странице
	var set_el_count_button = el_count_form.elements.set_el_count_button;//Получает кнопку отправки формы	
	
	//Установка событий страницы со списком книг
	this.start_books_controller = function(){
		//Показывает форму при клике на кнопку заказа книги
		self.on_click_show_form = function(){view.show_form();}	
		
		//Срабатывает на изменение # урла
		window.addEventListener("hashchange",view.show_changed_books_list,false);
		
		//Срабатывает на загрузку документа
		window.addEventListener("load",view.show_books_list,false);
		
		//Отмена отправки форм по умолчанию (onsubmit будет работать через AJAX)
		el_count_form.addEventListener("submit",
			function(event){
				event.preventDefault();//Oтмена отправки по умолчанию
				view.show_changed_books_list();//Запрос в базу с измененным количеством элементов на странице
				view.show_first_page();//После установки нового количества, отображаем первую страницу нового списка
			}
		);
		
		user_form.addEventListener("submit", 
			function(event){
				event.preventDefault();//Oтмена отправки по умолчанию
				model.submit_user_form();//Отправка данных через AJAX
			}
		);
		
		//Прячет и очищает форму, при нажатии на кнопку reset
		user_form.addEventListener("reset",view.hide_form,false);
		
	}
	
	//Установка событий страницы со списком писателей
	this.start_writers_controller = function(){
		//При загрузке получаем первую страницу
		model.get_first_page();
		
		//Срабатывает на загрузку документа
		window.addEventListener("load",view.show_writers_list,false);
		
		//Срабатывает на изменение # урла
		window.addEventListener("hashchange",view.show_changed_writers_list,false);
		
		//Отмена отправки формы по умолчанию (onsubmit будет работать через AJAX)
		el_count_form.addEventListener("submit",
			function(event){
				event.preventDefault();//Oтмена отправки по умолчанию
				view.show_changed_writers_list();//Запрос в базу с измененным количеством элементов на странице
				view.show_first_page();//После установки нового количества, отображаем первую страницу нового списка
			}
		);
		
	}
}