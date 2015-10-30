<?php

//
// Задаємо заголовок сторінки.
$page_title = "{$newsItem['title']} | Blog site";

// Підключаємо шапку сайту.
require('base/header.php');


?>


<!--запита на видалення статті-->
<?php if($editor): ?>
	<div class="delete-button">
		<h2>Do you really want to delete this article?</h2>
		<form action="/news/delete/<?php print $newsItem['id']; ?>" method="POST">
			<input class="btn btn-danger" type="submit" name="delete_post" value="YES">
			<input class="btn btn-warning" type="submit" name="abort_delete" value="NO">
		</form>		
	</div>
<?php endif; ?>


<!-- Виводимо статтю у тегах -->
<div class="article-item article-delete">
	<h3><?php print $newsItem['title']; ?></h3>
	<div class="info-wrapp">
		<span class="timestamp"><?php $newsItem['date']; ?></span>
	</div>
	<div class="full-desc">
		<?php print $newsItem['content']; ?>
	</div>
</div>



<?php



// Підключаємо футер сайту.
require('base/footer.php');
?>
