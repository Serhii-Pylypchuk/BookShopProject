
//Создаем класс View 
function View(myModel){
	var model = myModel;//Создаем ссылку на объект класа myModel
	var user_form = document.forms.user_form;//document.querySelector(".user_data_form");
	var form_container = document.querySelector(".upfloating_container");
	
	//Показывает список книг автора, с постраничным выводом по 5 елементов по умолчанию
	this.show_books_list = function(){model.get_ajax_elements_list("php/general_books.php","content");}
	
	//Показывает список писателей, с постраничным выводом по 5 елементов по умолчанию
	this.show_writers_list = function(){model.get_ajax_elements_list("php/general_writers.php","content");}
	
	//Показывает список книг автора с установленным количеством елементов и с постраничным выводом
	this.show_changed_books_list = function(){
		model.set_el_count_func("php/general_books.php");//Показывает установленное количество элементов
	}
	
	//Показывает список писателей с установленным количеством елементов и с постраничным выводом
	this.show_changed_writers_list = function(){
		model.set_el_count_func("php/general_writers.php");//Показывает установленное количество элементов
	}
	
	//Переход на первую страницу
	this.show_first_page = function(){
		model.get_first_page();
	}
	
	//Прячет и чистит форму и ее контейнер
	this.hide_form = function(){
		form_container.classList.remove('show');
		user_form.classList.remove('show');
		//Зачищает инфоблоки формы при ее отмене (reset event)
		model.clean_user_form();
	}
	
	//Показывает форму и ее контейнер
	this.show_form = function(){
		form_container.classList.add('show');
		user_form.classList.add('show');
		user_form.elements.book_id.value = model.get_book_id();
	}
}