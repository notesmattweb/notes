<?
/*
Базовый шаблон блога
========================
$title - заголовок
$content - содержимое - формируется вложенным шаблоном. 
*/
?>

<!DOCTYPE html>
<html>
<head>
	<title><?=$title?></title>
	<meta content="text/html; charset=utf-8" http-equiv="content-type">	
	<link rel="stylesheet" type="text/css" media="screen" href="v/style.css" /> 
</head>
<body>
	<h1>IT-блог</h1>
	<br/>
	<?if(empty($_GET['c'])):?>
	    <b>Главная</b> |
		<a href="index.php?c=editor">Консоль редактора</a>
	<?else:?>
		<?if($_GET['c'] == "editor"):?>
			<a href="index.php">Главная</a> | 
			<b>Консоль редактора</b> 
		<?else:?>
			<a href="index.php">Главная</a> | 
			<a href="index.php?c=editor">Консоль редактора</a>
		<?endif;?>
	<?endif;?>
	<hr/>
	<?if(isset($_SESSION["error"])):?>
		<span style="color:red;"><?=$_SESSION["error"];?></span>
		<?$_SESSION["error"] = null;?>
	<hr />
	<?elseif(isset($_SESSION["success"])):?>
		<span style="color:green;"><?=$_SESSION["success"];?></span>
		<?$_SESSION["success"] = null;?>
	<hr />
	<?endif;?>	
	
	<?=$content?>
	<small><a href="http://mattweb.ru">mattweb.ru</a> &copy;</small>
</body>
</html>