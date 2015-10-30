<?php

//FRONT CONTROLLER
//

header("X-XSS-Protection: 0"); 
header("Content-Type: text/html; charset=utf-8");
// Початок буферу.
ob_start();
// Початок або продовження сесії.
session_start();




// 1. Загальні налаштування
	ini_set('display_errors', 1);
	error_reporting(E_ALL);


// 2. Підключення файлів системи
define ('ROOT', __DIR__);
require_once (ROOT . '/components/Router.php');



// 3. Підключення до БД
require_once (ROOT . '/components/Db.php');

// 4. Виклик Router
$router = new Router();
$router->run();