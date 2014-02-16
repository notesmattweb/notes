<?/*
Шаблон главной страницы блога
========================
$article - массив со статьей
*/?>
<? foreach ($articles as $article): ?>
		<h2><a href="index.php?c=article&id=<?=$article['id_article']?>"><?=$article['title']?></a></h2>	
		<p><?=$article['content']?></p>
		<hr/>
<? endforeach ?>

<?if(count($arpages) > 0):?>
<div id="navbar">
	<?if(!is_null($arpages["prev_start"])):?>
		<a href="?start=<?=$arpages["prev_start"]?>">Предыдущая</a>&nbsp; 
	<?endif;?>

	<?foreach($arpages as $p_num => $start_from):?>
	  <?if ($p_num == "prev_start" || $p_num == "next_start") continue;?>
	  <?if($_GET['start'] == $start_from || (!isset($_GET['start']) && $start_from == 0)):?>
		<span><?=$p_num?></span>&nbsp;
	 <?else:?>
		<a href="?start=<?=$start_from?>"><?=$p_num?></a>&nbsp; 
	 <?endif;?>
	<?endforeach;?>

	<?if(!is_null($arpages["next_start"])):?>
		&nbsp;<a href="?start=<?=$arpages["next_start"]?>">Следующая</a> 
	<?endif;?>
</div>
<?endif;?>
