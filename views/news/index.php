<?php
//
// Підключаємо хедер сайту.
require(ROOT . '/base/header.php');

?>

<h1> Welcome to blog site!</h1>
<!-- Виводимо статті у тегах -->
<div class="articles-list">

  <?php if (empty($newsList)): ?>
    <!-- У випадку, якщо статтей немає - виводимо повідомлення. -->
    Статті відсутні.
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
    <!-- Пейджер на розробці. -->
    Pager this!
  </div>

</div>

<?php
// Підключаємо футер сайту.
require('base/footer.php');
?>
