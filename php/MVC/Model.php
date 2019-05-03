<?php

//Создаем клас Model
class Model{
	
	//Функция формырует список книг автора
	protected function create_books_list($rows_count,$result,$elements_count,$current_page){
		echo "<div class = 'books_list'>";
			for ($i = 0; $i < $rows_count ; $i++){
				//$row = mysqli_fetch_row($result);//Получает очередной ряд
				$row = $result -> fetch_row();//Получает очередной ряд
				if($i < $elements_count && $current_page == 1){	
					echo "<p class = 'book'>";
						echo "<span class = 'book_name'>Название книги: <b>".htmlentities(trim($row[1]))."</b></span></br>";
						echo "<span class = 'writer_name'>Автор: <b>".trim($row[2])."</b></span></br></br>";
						echo "<img src = 'images/books/".trim($row[3])."' alt = '".trim($row[1])."' title = '".trim($row[1])."' width = 200 height = 200></br>";
						echo "<button type = 'button' name = 'id".trim($row[0])."' onclick='myController.on_click_show_form()' title = 'Оформить заявку на книгу'> Заказать книгу </button></br>";
						//echo "<hr></br>";
					echo "</p>";
				}else if($i >= ($elements_count*($current_page-1)) && $i < ($elements_count*$current_page) && $current_page != 1){
					echo "<p class = 'book'>";
						echo "<span class = 'book_name'>Название книги: <b>".trim($row[1])."</b></span></br>";
						echo "<span class = 'writer_name'>Автор: <b>".trim($row[2])."</b></span></br></br>";
						echo "<img src = 'images/books/".trim($row[3])."' alt = '".trim($row[1])."' title = '".trim($row[1])."' width = 200 height = 200></br>";
						echo "<button type = 'button' name = 'id".trim($row[0])."' onclick='myController.on_click_show_form()' title = 'Оформить заявку на книгу'> Заказать книгу </button></br>";
						//echo "<hr></br>";
					echo "</p>";
				}
			}
		echo "</div>";
	}
	
	//Функция формырует список писателей
	protected function create_writers_list($result,$rows_count,$elements_count,$current_page){
		echo "<div class = 'writers_list'>";
			for ($i = 0; $i < $rows_count ; $i++){
				//После вызова функции mysqli_fetch_row($result) указатель в наборе $result переходит к новой строке, 
				//поэтому с каждым новым вызовом мы извлекаем новую строку
				$row = $result -> fetch_row();//Получает очередной ряд
				if($i < $elements_count && $current_page == 1){	
					echo "<p class = 'writer'>";
						echo "<span class = 'writer_name'>Автор: <b>".trim($row[1])."</b></span></br></br>";
						echo "<img src = 'images/writers/".trim($row[2])."' alt = '".trim($row[1])."' title = '".trim($row[1])."' width = 200 height = 200></br>";
						echo "<button name ='".trim($row[0])."'><a href = 'book_list.php?writer_id".trim($row[0])."#PAG1'> Список книг </a></button></br>";
					echo "</p>";
				}else if($i >= ($elements_count*($current_page-1)) && $i < ($elements_count*$current_page) && $current_page != 1){
					echo "<p class = 'writer'>";
						echo "<span class = 'writer_name'>Автор: <b>".trim($row[1])."</b></span></br></br>";
						echo "<img src = 'images/writers/".trim($row[2])."' alt = '".trim($row[1])."' title = '".trim($row[1])."' width = 200 height = 200></br>";
						echo "<button name ='".trim($row[0])."'><a href = 'book_list.php?writer_id".trim($row[0])."#PAG1'> Список книг </a></button></br>";
					echo "</p>";
				}
			}
		echo "</div>";	 
	}
	
	//Cоздает кнопку пагинации
	private	function create_button($current_page,$i){
		if($current_page == $i){
			echo "<a href='#PAG".$i."' class = 'active'>".$i."</a>";
		}else{
			echo "<a href='#PAG".$i."'>".$i."</a>";
		}
	}
	
	//Функция формирует пагинацию исходя из списка книг или писателей и количества установленных (или по умолчанию)элементов на странице
	protected function create_pagination($rows_count, $elements_count, $current_page){
		if($elements_count < $rows_count){
			
			$pages_count = ceil($rows_count / $elements_count);//Получаем общее количество страниц
			$buttons_count = 5;//Максимальное количество кнопок пагинации
			
			echo "<div id = 'pagination' class = 'forPagButton'>";
			
				if($current_page <= 3){
					if($pages_count <= $buttons_count){
						for($i = 1; $i <= $pages_count; $i++){
							$this -> create_button($current_page,$i);
						}
					}else{
						for($i = 1; $i <= $buttons_count; $i++){
							$this -> create_button($current_page,$i);
						}
					}
				}
				if($current_page > 3){ 
				
					if($current_page <= $pages_count-2){
						for($i = $current_page - 2; $i <= $current_page+2; $i++){
							if($i){$this -> create_button($current_page,$i);}
						}
					}
					
					if($current_page > $pages_count-2 && $current_page <= $pages_count){
						if($current_page == $pages_count-1){
							for($i = $current_page - 3; $i <= $current_page+1; $i++){
								if($i){$this -> create_button($current_page,$i);}
							}
						}
						if($current_page == $pages_count){
							for($i = $current_page - 4; $i <= $current_page; $i++){
								if($i){$this -> create_button($current_page,$i);}
							}	
						}
					}
				}		
			echo "</div>";
		}
	}
	
}

?>