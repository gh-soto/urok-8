<?php
//
$page_title = 'Login page';

require_once (ROOT . '/base/header.php');

// Якщо запис у користувача про сесію вже є, тоді пропонуємо йому розлогінитися.
// Тобто вийти з сайту.

?>

<!-- Якщо користувач немає запису у сесії, тоді виводимо йому форму. -->
<?php if(!$editor): 

  print '<h3>' . Authorization::logIn()['error_login'] . '</h3>';
?>

  <div class="container">
    <form class="form-inline " role="form" action="/login" method="POST">
      <div class="form-group">

        <label for="name">Логін</label>
        <input class="form-control" type="text" name="name" id="name" placeholder="admin" required>

        <label for="name">Пароль</label>
        <input class="form-control" type="password" name="pass" placeholder="123" required>

        <input class="btn btn-danger" type="submit" name="submit" value="Відправити">

      </div>
    </form>
  </div>

<?php else: ?>

<h3>You have already loged in</h3>

<?php endif;?>


<?php
// Підключаємо футер сайту.
require('base/footer.php');
?>
