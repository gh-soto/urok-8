<?php
//
// Задаємо заголовок сторінки.
$page_title = "{$newsItem['title']} | Blog site";

// Підключаємо шапку сайту.
require('base/header.php');
?>

<!-- Виводимо статтю у тегах -->
<div class="article-item">
  <h1><?php print $newsItem['title']; ?></h1>
  <div class="info-wrapp">
    <span class="timestamp"><?php $newsItem['date']; ?></span>
    <? if($editor): ?>
      <a href="/news/edit/<?php print $newsItem['id']; ?>">Редагувати</a>
      <a href="/news/delete/<?php print $newsItem['id']; ?>">Видалити</a>
    <? endif; ?>
  </div>
  <div class="full-desc">
    <?php print $newsItem['content']; ?>
  </div>
</div>


<?php
// Підключаємо футер сайту.
require('base/footer.php');
?>
