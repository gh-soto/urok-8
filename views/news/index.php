<?php
//
// Підключаємо хедер сайту.
require(ROOT . '/base/header.php');

							/*
							print '<pre>';
							print_r ($_SERVER);
							print '</pre>';


							print '<pre>';
							print_r($newsList);
							print '</pre>';


							print('$_COOKIE["news-per-page"] --> ');
							print '<pre>';
							print_r($_COOKIE);
							print '</pre>';

							print('POST -- ><pre>'); print_r($_POST); print('</pre>');
							*/


?>

<h1> Welcome to blog site!</h1>
<!-- Виводимо статті у тегах -->
<div class="articles-list">

	<div class="small-menu"> 
		<?php print $news_per_page; ?> <p>статтей на сторінку</p>
	</div>


	<?php if (empty($newsList)): ?>
		<!-- У випадку, якщо статтей немає - виводимо повідомлення. -->
		<h2>Статті відсутні.</h2>
	<?php endif; ?>



	<?php foreach ($newsList as $newsItem): ?>
		<div class="article-item">

			<h2><a href="/news/<?php print $newsItem['id']; ?>"><?php print $newsItem['title']; ?></a></h2>

			<div class="description">
				<?php print $newsItem['short_content']; ?>
			</div>

			<div class="info">
				<div class="timestamp">
					<!-- Вивід відформатованої дати створення. -->
					<?php print $newsItem['date']; ?>
				</div>
				<div class="links">
					<a href="/news/<?php print $newsItem['id']; ?>">Читати далі</a>
					<!-- Посилання доступні тільки для редактора. -->
					<? if($editor): ?>
						<a href="/news/edit/<?php print $newsItem['id']; ?>">Редагувати</a>
						<a href="/news/delete/<?php print $newsItem['id']; ?>">Видалити</a>
					<? endif; ?>
				</div>
			</div>

		</div>
		
	<?php endforeach; ?>

		<div class="pager">
			<table>
					<tr>
						<td <?php print($newsItem['display_none_back']); ?>>
							<a href="/page/<?php print($newsItem['page'] + 1); ?>"></i>сюда</a>
						</td>						
						<td <?php print($newsItem['display_none_next']); ?>>
							<a  href="/page/<?php print($newsItem['page'] - 1); ?>">туда</a>
						</td>
					</tr>
			</table>
		</div>
			
</div>
	 
<?php
// Підключаємо футер сайту.

require('base/footer.php');
?>
	