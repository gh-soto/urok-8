<?php
//
$page_title = "edit post";
require('base/header.php');


?>

<!-- Пишемо форму, метод ПОСТ, форма відправляє данні на цей же скрипт. -->
<?php if($editor): ?>
<div class="container container2">

  <form role="form" action="/news/edit/<?php print $newsItem['id']; ?>" method="POST">
    <div class="form-group">

      <label for="title">Заголовок</label>
      <input class="form-control" type="text" name="title" id="title" value=<?php print "\"" . $newsItem['title'] . "\""; ?> required maxlength="255">

      <label for="short_content">Короткий зміст</label>
      <textarea class="form-control" name="short_content" id="short_content" required maxlength="600"> <?php print $newsItem['short_content']; ?> </textarea>

      <label for="content">Повний зміст</label>
      <textarea class="form-control full-desc" name="content" id="content" required> <?php print $newsItem['content']; ?> </textarea>

      <label for="date">День редагування</label>
      <input class="form-control" type="date" name="date" id="date" required value="<?php print date('Y-m-d')?>">
      <label for="time">Час редагування</label>
      <input class="form-control" type="time" name="time" id="time" required value="<?php print date('G:i')?>">

      <input class="btn btn-info" type="submit" name="edit_post" value="Змінити">

    </div>

  </form>
</div>
<?php endif; ?>
<?php

// Підключаємо футер сайту.
require('base/footer.php');
?>