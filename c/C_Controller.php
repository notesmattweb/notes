<?php
	// контроллер C_Controller
	abstract class C_Controller{
		//
		// Конструктор.
		//
		function __construct()
		{		
		}
		
		//
		// Полная обработка HTTP запроса.
		//
		public function Request()
		{
			$this->OnInput();
			$this->OnOutput();
		}
		
		//
		// Виртуальный обработчик запроса.
		//
		protected function OnInput()
		{
		}
		
		//
		// Виртуальный генератор HTML.
		//	
		protected function OnOutput()
		{
		}
		
		//
		// Запрос произведен методом GET?
		//
		protected function IsGet()
		{
			return $_SERVER['REQUEST_METHOD'] == 'GET';
		}

		//
		// Запрос произведен методом POST?
		//
		protected function IsPost()
		{
			return $_SERVER['REQUEST_METHOD'] == 'POST';
		}

		//
		// Генерация HTML шаблона в строку.
		//
		protected function Template($fileName, $vars = array())
		{
			// Установка переменных для шаблона.
			foreach ($vars as $k => $v)
			{
				$$k = $v;
			}

			// Генерация HTML в строку.
			ob_start();
			include $fileName;
			return ob_get_clean();	
		}

		// устанавливаем кодировку
		protected function Set_charset($chaset){
		header("Content-type: text/html; charset=$chaset");
		}
		
		//
		// Сохраняем сообщения
		//	
		protected function SetMessOrErr($type=1, $message){
			$types = array("1"=>"error","2"=>"success");
			$_SESSION[$types[$type]] = $message;		
		}

	}
?>