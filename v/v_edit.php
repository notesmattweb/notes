<?/*
Шаблон редактирования статьи
=======================
$art_id - ИД статьи
$title - заголовок
$content - содержание
*/?>
	<h2>IT-блог - редактирование статьи</h2>
	<form method="post">
	    <input type="hidden" name="id_article" value="<?=$id_article?>" />
		Название:
		<br/>
		<input type="text" name="title" value="<?=$title?>" />
		<br/>
		<br/>
		Содержание:
		<br/>
		<textarea name="content"><?=$content?></textarea>
		<br/>
		<input type="submit" name="save_art" value="Сохранить" />
		<input type="submit" name="del_art" value="Удалить" />
	</form>
	<hr/>
