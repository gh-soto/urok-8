<?php

//
class Db
{

	public static function getConnection(){

		//підключення окремого файлу з масивом, в якому містяться всі дані для підключення
		$paramsPath = ROOT . '/config/db_params.php';
		$params = include($paramsPath);

		
		$db = new PDO("mysql:host={$params['host']}; dbname={$params['dbname']}", $params['user'], $params['password']);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		//створення необхідної таблиці в базі даних
		$query = $db->prepare ("CREATE TABLE IF NOT EXISTS `publication` (
								    `id` int(11) NOT NULL AUTO_INCREMENT,
								    `title` varchar(255) NOT NULL,
								    `date` timestamp,
								    `short_content` text NOT NULL,
								    `content` text NOT NULL,
								    `author_name` varchar(255) NOT NULL,
								    `preview` varchar(255) NOT NULL,
								    `type` varchar(255) NOT NULL,
								    PRIMARY KEY (`id`)
								  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;");
		$query->execute();
	
		
		

		return $db;
	}

}