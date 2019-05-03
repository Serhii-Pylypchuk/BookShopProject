
function Validation(){
	
	//функция валидации поля email
	this.emailValidation = function(arg){
		var regExpResolt = arg.value.search(/[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}/i);
		var argLength = arg.value.length;

		if(regExpResolt != -1 && argLength >= 1 && argLength <= 50){
			emailOnSubmitInformation(arg,true);
			return arg.value;
		}     
		else{
			arg.focus();
			emailOnSubmitInformation(arg,false,regExpResolt,argLength);
			return false;
		}
	}
	
	//функция валидации поля автора
	this.userValidation = function(arg){ //rightLength - допустимая длина строки
		var rightLength = 50;
		var regExpResolt = arg.value.search(/[\<\>@#\$\^&\*\+=\\~\[\]\{\}\|\`,.\d\?:;№!%)(_"']/g);
		var argLength = arg.value.length;
		if(regExpResolt == -1 && argLength >= 1 && argLength <= rightLength){
			userOnSubmitInformation(arg,true);
			return arg.value;
		}     
		else{
			arg.focus();
			userOnSubmitInformation(arg,false,regExpResolt,argLength,rightLength);
			return false;
		}
	}
	
	//Валидация количества элементов
	this.el_countValidation = function(count,el_count_form){
		if(count && el_count_form){
			if(count >=1 && count <=50){
				el_count_form.nextSibling.innerHTML = 'Количество элементов на странице: '+count;
				el_count_form.nextSibling.classList.remove('error');
				el_count_form.nextSibling.classList.add('succes');
				return true;
			}else{
				el_count_form.nextSibling.innerHTML='Диапазон элементов от 1 до 50';
				el_count_form.nextSibling.classList.remove('succes');
				el_count_form.nextSibling.classList.add('error');
				return false;
			}
		}
	}
	
	//Используется для проверки дескриптора на пустоту
	this.is_class_element_empty = function(class_name){//если пустой - true, если заполнен - false
		var cur_element = document.querySelector(class_name);
		if(cur_element){
			var elems = cur_element.getElementsByTagName('*');
			if(!elems.length){
				return false;//Елемент существует!!!!!
			}else{
				return true;//Елемента не существует
			}
		}else{
			return true;//Елемента не существует
		}
	}
	

	//Выводит информацию в nextSibling после возвращения валидатором поля автора true или false
	function userOnSubmitInformation(element,boolean,regExpResolt,argLength,rightLength){
		var spanTest = element.nextSibling.nodeName;//проверяет наличие сестринского спана
		if(boolean && spanTest == 'SPAN'){
			element.nextSibling.innerHTML = 'Имя введено правильно';
			element.nextSibling.className = 'succes';
		}
		else{
			if(spanTest == 'SPAN'){
				if(regExpResolt != -1){
					element.nextSibling.innerHTML = '<i class="fa fa-exclamation-triangle  fa-fw"></i> Запрещенные символы:  0-9 < > @ # $ ^ & * + = \ ~ [ ] { } | ` , . ? : ; № ! % ) ( _ \" \'';
					element.nextSibling.className = 'error';
				}
				if(argLength == 0){
					element.nextSibling.innerHTML = '<i class="fa fa-exclamation-triangle  fa-fw"></i> Поле не заполнено. Допустимое количество символов: от 1 до '+ rightLength;
					element.nextSibling.className = 'error';
				}
				if(argLength > rightLength){
					element.nextSibling.innerHTML = '<i class="fa fa-exclamation-triangle  fa-fw"></i> Вы ввели '+argLength+' символов. Допустимое количество символов: от 1 до '+ rightLength;
					element.nextSibling.className = 'error';
				}
			}
		}		
	}
	
	//Выводит информацию в nextSibling после возвращения валидатором поля автора true или false
	function emailOnSubmitInformation(element,boolean,regExpResolt,argLength){
		var spanTest = element.nextSibling.nodeName;//проверяет наличие сестринского спана
		if(boolean && spanTest == 'SPAN'){
			element.nextSibling.innerHTML = 'E-mail введен правильно';
			element.nextSibling.className = 'succes';
		}
		else{
			if(spanTest == 'SPAN'){
				if(regExpResolt == -1){
					element.nextSibling.innerHTML = '<i class="fa fa-exclamation-triangle  fa-fw"></i> Неверный формал email. Правильный формат: test@test.test';
					element.nextSibling.className = 'error';
				}
				if(argLength == 0){
					element.nextSibling.innerHTML = '<i class="fa fa-exclamation-triangle  fa-fw"></i> Поле не заполнено. Допустимое количество символов: от 1 до 50';
					element.nextSibling.className = 'error';
				}
				if(argLength > 50){
					element.nextSibling.innerHTML = '<i class="fa fa-exclamation-triangle  fa-fw"></i> Вы ввели '+argLength+' символов. Допустимое количество символов: от 1 до 50';
					element.nextSibling.className = 'error';
				}
				
			}
		}		
	}
	
}

