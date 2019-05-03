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
	<script src = "js/general/writers_general.js" defer></script><!--Только после полной загрузки страницы начнет исполняться скрыпты -->
	
  </head>
  <body>
  
    <header>
      <h1><i class="fa fa-newspaper-o  fa-lg"></i> Книжный магазин</h1>
    </header>
	
	<div class = 'upfloating_container show'>
	
		<p class = 'messageBox show'>
			<i class="fa fa-spinner fa-5x fa-spin" aria-hidden="true"></i></br></br>
			<span>Подождите, идет загрузка информации...</span>
		</p>
		
    </div>
    
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