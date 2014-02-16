<?php
	// контроллер C_Editor
	class C_Editor extends C_Base{
		private $articles; // статьи
		
		//конструктор
		public function __construct(){
		}
		
		// Виртуальный обработчик запроса.
		protected function OnInput()
		{
			// подключаем модель
			$mArticles = M_Articles::get_instance();
			
			parent::OnInput();
			$this->title = $this->title . ' - Консоль редактора';
							
			// получаем все статьи
			$this->articles = $mArticles->articles_all($start_from, 5);
		}
		
		// Виртуальный генератор HTML.
		protected function OnOutput()
		{
			$vars = array('articles' => $this->articles);	
			$this->content = $this->Template('v/v_editor.php', $vars);
			parent::OnOutput();
		}

	}
?>