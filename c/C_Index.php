<?php
	// контроллер C_Index
	class C_Index extends C_Base{
	
		private $articles; // статьи
		private $ar_pages; // постраничная навигация
		private $start_from; // текущая позиция
		private $artperpage = 5; // статей на старнице
		
		//конструктор
		public function __construct(){
		}
		
		// Виртуальный обработчик запроса.
		protected function OnInput()
		{
			parent::OnInput();
			
			// подключаем модель
			$mArticles = M_Articles::get_instance();
						
			$this->title = $this->title . ' - Главная';
			
			// какую страницу показывать
			if(isset($_GET['start'])){
				$this->start_from = (int) $_GET['start'];
			}
			else{
				$this->start_from = 0;
			}
			
			// получаем все статьи
			$this->articles = $mArticles->articles_all($this->start_from, $this->artperpage);
			
			// обрезаем содержимое статьи до 200 символов
			foreach($this->articles as $key => $ar_art){
				  $this->articles[$key]["content"] = $mArticles->articles_intro($ar_art["content"],100);
			}
		}
		
		
		// Виртуальный генератор HTML.
		protected function OnOutput()
		{
			// подключаем модель
			$mArticles = M_Articles::get_instance();
			
			// навигация 
			$this->ar_pages = $mArticles->Make_navbar($this->start_from, $this->artperpage);			
			
			$vars = array('articles' => $this->articles, 'arpages'=>$this->ar_pages);	
			$this->content = $this->Template('v/v_index.php', $vars);
			parent::OnOutput();
		}

	}
?>