<?php
//
// Задаємо заголовок сторінки.
$page_title = 'Add new article';

require('base/header.php');



?>
<!-- Пишемо форму, метод ПОСТ, форма відправляє данні на цей же скрипт. -->
<?php if($editor): ?>
<div class="container container2">

  <form role="form" action="/news/add_news" method="POST">
    <div class="form-group">

      <label for="title">Заголовок</label>
      <input class="form-control" type="text" name="title" id="title" required maxlength="255">

      <label for="short_content">Короткий зміст</label>
      <textarea class="form-control" name="short_content" id="short_content" required maxlength="600"></textarea>

      <label for="content">Повний зміст</label>
      <textarea class="form-control full-desc" name="content" id="content" required></textarea>

      <label for="date">День створення</label>
      <input class="form-control" type="date" name="date" id="date" required value="<?php print date('Y-m-d')?>">
      <label for="time">Час створення</label>
      <input class="form-control" type="text" name="time" id="time" required value="<?php print date('G:i')?>">

      <input class="btn btn-info" type="submit" name="submit" value="Зберегти">

    </div>

  </form>
</div>
<?php endif; ?>
<?php
// Підключаємо футер сайту.
require('base/footer.php');
?>
