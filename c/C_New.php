<?php
	// контроллер C_New
	class C_New extends C_Base{
		
		private $art_title;		// заголовок статьи
		private $art_content;	// содержимое статьи
				
		//конструктор
		public function __construct(){
		}
		
		// Виртуальный обработчик запроса.
		protected function OnInput()
		{
			// подключаем модель
			$mArticles = M_Articles::get_instance();
			
			parent::OnInput();
			$this->title = $this->title . ' - добавление новой статьи';
			
			// Обработка отправки формы.
			if ($this->IsPost())
			{
				if ($mArticles->articles_new($_POST['title'], $_POST['content']))
				{
					$this->SetMessOrErr(2, "Статья успешно добавлена!");
					header('Location: index.php?c=editor');
					die();
				}
				
				$this->art_title = $_POST['title'];
				$this->art_content = $_POST['content'];
			}
			else
			{
				$this->art_title = '';
				$this->art_content = '';
			}
		}
	
		// Виртуальный генератор HTML.
		protected function OnOutput()
		{
			$vars = array('title' => $this->art_title, 'content'=>$this->art_content);	
			$this->content = $this->Template('v/v_new.php', $vars);
			parent::OnOutput();
		}

	}
?>