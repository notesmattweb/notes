<?/*
Шаблон редактируемой страницы
=======================
$articles - список статей

статья:
id_article - идентификатор
title - заголвок
content - текст
*/?>
	<ul>
		<li>
			<b><a href="index.php?c=new">Новая статья</a></b>
		</li>	
		<? foreach ($articles as $article): ?>
			<li>
				<a href="index.php?c=edit&id=<?=$article['id_article']?>">
					<?=$article['title']?>
				</a>
			</li>
		<? endforeach ?>
	</ul>
	<hr/>	

