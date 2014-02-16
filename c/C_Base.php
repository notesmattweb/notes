<?php
	// контроллер C_Base
	class C_Base extends C_Controller{
		protected $title;		// заголовок страницы
		protected $content;		// содержание страницы
		protected $start_time;  // время в начале отображнения страницы
		protected $exec_time;  // время в конце отображнения страницы	

		//
		// Конструктор.
		//
		function __construct()
		{				
		}
		
		//
		// Виртуальный обработчик запроса.
		//
		protected function OnInput()
		{
			// создаем подключение к БД
			//M_DBase::Set_connect();
			
			
			$this->start_time = microtime(true);
			$this->title = 'IT-блог';
			$this->content = '';
		}
		
		//
		// Виртуальный генератор HTML.
		//	
		protected function OnOutput()
		{
			$this->Set_charset("utf-8");
			$this->exec_time = microtime(true) - $this->start_time;
			$vars = array('title' => $this->title, 'content' => $this->content);	
			$page = $this->Template('v/v_main.php', $vars);
			$page .= sprintf("<!-- Время генерации страницы %0.5f сек. -->", $this->exec_time);
			
			$page_length = strlen($page) + strlen(sprintf ("<!-- Передано байт: %03d -->", $page_length));
			$page .= sprintf ("<!-- Передано байт: %03d -->", $page_length);
						
 			echo $page;
		}
	}
?>