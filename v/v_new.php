<?/*
Шаблон главной страницы
=======================
$title - заголовок
$content - содержание
*/?>
	<h2>IT-блог - новая статья</h2>
	<form method="post">
		Название:
		<br/>
		<input type="text" name="title" value="<?=$title?>" />
		<br/>
		<br/>
		Содержание:
		<br/>
		<textarea name="content"><?=$content?></textarea>
		<br/>
		<input type="submit" value="Добавить" />
	</form>
	<hr/>

