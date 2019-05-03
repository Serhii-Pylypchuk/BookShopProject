<!DOCTYPE html>
<html>
  <head>
	<title>Книжный магазин</title>
   	<meta http-equiv="Content-Type" content="text/html; charset=utf8">

	<link href='https://fonts.googleapis.com/css?family=Amatic+SC&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Didact+Gothic&subset=latin,cyrillic-ext' rel='stylesheet' type='text/css'>
	
	<link rel="stylesheet" href="css/font-awesome.css">
	<link rel="stylesheet/less" href="css/main.less">
	<link rel="stylesheet/less" href="css/user_form.less">
	
	<script src = "js/less.js"></script>
	<script src = "js/AjaxRequest.js"></script>
	<script src = "js/Validation.js"></script>
	<script src = "js/MVC/Model.js"></script>
	<script src = "js/MVC/View.js"></script>
	<script src = "js/MVC/Controller.js"></script>
	<script src = "js/general/books_general.js" defer></script><!--Только после полной загрузки страницы начнет исполняться скрыпты -->
	
  </head>
  <body>
  
    <header>
      <h1><i class="fa fa-newspaper-o  fa-lg"></i> Книжный магазин</h1>
    </header>
	
	<div class = 'user_form_server_answer'></div>
	
	<div class = 'upfloating_container show'>
	
		<p class = 'messageBox show'>
			<i class="fa fa-spinner fa-5x fa-spin" aria-hidden="true"></i></br></br>
			<span>Подождите, идет загрузка информации...</span>
		</p>
		
		
		<form action  name='user_form' class = 'user_data_form' autocomplete='on'> 
	
			<span>Имя и Фамилия*</span><br> 
			<input type='text' name='user_name' placeholder='Введите  имя'><span name='info'></span>
										
			<span>Контактный email*</span><br> 
			<input type='text' name='user_email' placeholder='Введите  е-mail'><span name='info'></span>
			
			<input type='hidden' name='book_id'>	
			
			<input type='submit' value='Заказать' name='submit' class='buttonsOfForm'>
			<input type='reset' value='Oтменить' name='reset' class='buttonsOfForm'>
			
		</form>
		
    </div>
    
    <a href='index.php#PAG1'class = 'return_back' title = 'Вернуться к списку писателей'>Писатели</a>
    
	<form action  name = "el_count_form" title = 'Установить количество элементов'>
			<input type = 'number' name = 'el_count' min = 1 max = 50>
			<input type = 'submit' name = 'set_el_count_button' value = 'Применить'>
	</form><span></span></br>
	
    <div id = "content"></div>

    <footer>
	<br>
        &copy; Serhii Pylypchuk
    </footer>
  </body>
</html>