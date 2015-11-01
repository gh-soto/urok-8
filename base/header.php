<?php

/**
*підключення до файлу з контроллером авторизації 
*та відбір даних з статичному методу моделі цього контроллера
*/

require_once (ROOT . '/models/Authorization.php');
Authorization::logIn();
$editor = Authorization::logIn()['check_login'];

// Якщо раніше заголовок сторінки не був заданий, тоді ми його задаємо.
if (!isset($page_title)) {
	$page_title = 'Blog site';
}

?>
<!-- Виводимо основну структуру сайту. -->
<!DOCTYPE html>
<html>
<head>
	<title><?php print $page_title; ?></title>
	
	<link rel="stylesheet" type="text/css" href="/template/style/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/template/style/style.css">

	<script src="js/jquery-1.11.3.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,500' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Bad+Script&subset=latin,cyrillic' rel='stylesheet' type='text/css'>

	<meta charset="UTF-8">
</head>
<body>
<!-- Будуємо меню сайту. -->
<div class="header navbar navbar-default">
	<ul class="main-menu">
		<li><a href="/">Головна сторінка</a></li>
		<?php if ($editor): ?>
			<li><a href="/news/add_news">Додати статтю</a></li>
			<li><a href="/logout">Вихід</a></li>
		<?php endif; ?>
		<?php if (!$editor): ?>
			<li><a href="/login">Вхід</a></li>
		<?php endif; ?>
	</ul>
</div>
