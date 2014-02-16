<?php
	// контроллер C_Edit
	class C_Edit extends C_Base{
		private $id_article;		// ИД статьи
		private $art_title;		// Заголовок статьи
		private $art_content;	// Содержимое статьи
		
		//конструктор
		public function __construct(){
		}
		
		// Виртуальный обработчик запроса.
		protected function OnInput()
		{
			// подключаем модель
			$mArticles = M_Articles::get_instance();
			
			parent::OnInput();
			$this->title = $this->title . ' - редактирование статьи';
			
			
			if(isset($_POST["save_art"])){
			  // изменяем статью
			  if($mArticles->articles_edit($_POST['id_article'], $_POST['title'], $_POST['content']))
			  {
				$this->SetMessOrErr(2, "Статья успешно изменена!");
				header("Location: index.php?c=editor");
				die();
			  }
			  $this->id_article = $_POST['id_article'];
			  $this->art_title = $_POST['title'];
			  $this->art_content = $_POST['content'];

			}
			else if(isset($_POST["del_art"])){
				// удаляем статью	
				  if($mArticles->articles_delete($_POST["id_article"])){
					
					$this->SetMessOrErr(2, "Статья успешно удалена!");
					header("Location: index.php?c=editor");
					die();
				  }
			}
			else{
				if(isset($_GET["id"])){
				// загружаем статью в форму для редактирования	
				$art_id = (int) $_GET["id"];
				
					if($art_id > 0){
					    $article = $mArticles->articles_get($art_id);
						
						$this->id_article = $article["id_article"];
						$this->art_title = $article["title"];		  		  
						$this->art_content = $article["content"];	
					
					}
					else{
						die("Такой статьи не существует!");
					}

				}else{
					die("Не передан идентификатор статьи");
				}
			}
		}
		
		// Виртуальный генератор HTML.
		protected function OnOutput()
		{
			$vars = array('id_article' => $this->id_article, 'title' => $this->art_title, 'content' => $this->art_content);	
			$this->content = $this->Template('v/v_edit.php', $vars);
			parent::OnOutput();
		}
		

	}
?>