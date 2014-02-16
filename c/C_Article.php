<?php
	// контроллер C_Article
	class C_Article extends C_Base{
		private $article; // статья
		
		//конструктор
		public function __construct(){
		}
		
		// Виртуальный обработчик запроса.
		protected function OnInput()
		{
			// подключаем модель
			$mArticles = M_Articles::get_instance();
			
			parent::OnInput();
			
			if(isset($_GET["id"])){
				$art_id = (int) $_GET["id"];
				
				if($art_id > 0){
				  $this->article = $mArticles->articles_get($art_id);
				  				  				  
				  $this->title = $this->title.' - '.$this->article['title']; 
		  
				}
				else{
					die("Такой статьи не существует!");
				}
			}
			else{
				die("Не передан идентификатор статьи!");
			}
		}
		
		// Виртуальный генератор HTML.
		protected function OnOutput()
		{
			$vars = array('article' => $this->article);	
			$this->content = $this->Template('v/v_article.php', $vars);
			parent::OnOutput();
		}

	}
?>