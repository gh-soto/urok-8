<?php

//
include_once ROOT . '/models/News.php';
include_once ROOT . '/controllers/Request_errorController.php';

class NewsController
{
	
	//метод для перегляду всіх статтей
	public function actionIndex()
	{
		$newsList = array();
		$newsList = News::getNewsList();

		require_once (ROOT . '/views/news/index.php');
		
	}


	//метод для перегляду статті по відповідному їй id
	public function actionView($id)
	{
		if ($id) {
			$newsItem = News::getNewsItemById($id);

			//перевірка чи id новини в запиті має відповідну новину в таблиці бази даних
			//і якщо немає, то перенаправлення на сторінку помилки
			if ($id == $newsItem['id']) { require_once (ROOT . '/views/news/newsItem.php'); }
			else { Request_errorController::actionWrong_request(); }
		}
	}


	//метод для додавання нової статті
	public function actionAdd_news() 
	{
		News::addNewsItem();
		require_once (ROOT . '/views/news/add.php');

	}


	//метод редагування статті по відповідному їй id
	public function actionEdit($id)
	{

		if ($id) {
			$newsItem = News::editNewsItemById($id);

			//перевірка чи id новини в запиті має відповідну новину в таблиці бази даних
			//і якщо немає, то перенаправлення на сторінку помилки
			if ($id == $newsItem['id']) { require_once (ROOT . '/views/news/edit.php'); }
			else { Request_errorController::actionWrong_request(); }
		}
	}

	//метод видалення статті по відповідному їй id
	public function actionDelete_news($id)
	{
		if ($id) {
			$newsItem = News::deleteNewsItemById($id);

			//перевірка чи id новини в запиті має відповідну новину в таблиці бази даних
			//і якщо немає, то перенаправлення на сторінку помилки
			if ($id == $newsItem['id']) { require_once (ROOT . '/views/news/delete.php'); }
			else { Request_errorController::actionWrong_request(); }
		}
	}
}