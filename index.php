<?php
// Открытие сессии.
session_start();
//error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

//подключаем контроллеры и модель, используя функцию __autoload()
function __autoload($classname){
	switch($classname[0]){
		case "C":
			include_once("c/$classname.php");
			break;
		case "M":
			include_once("m/$classname.php");
			break;	
	}
}

// выбираем контроллер
switch($_GET["c"]){
	case "article":
		$controller = new C_Article();
		break;
	case "editor":
		$controller = new C_Editor();
		break;
	case "new":
		$controller = new C_New();
		break;
	case "edit":
		$controller = new C_Edit();
		break;
	default:
		$controller = new C_Index();
}

$controller->Request();
?>