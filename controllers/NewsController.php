<?php

//
include_once ROOT . '/models/News.php';
include_once ROOT . '/controllers/Request_errorController.php';

class NewsController
{
	//в разі введення неправильного запиту, відповідний йому метод не буде знайдений в контроллері
	//тому викличеться магічний метод __call, який перенаправить користувача на сторінку з інформацією про помилку
	public function __call($actionName, $parameters)
	{
		Request_errorController::actionWrong_request();
		
	}

/*
	//метод для перегляду всіх статтей
	public function actionIndex()
	{
		$newsList = array();
		$newsList = News::getNewsList();

		require_once (ROOT . '/views/news/index.php');
		
	}
*/



	//вивід статтей по сторінках
	public function actionIndexByPage($page)
	{
		$news_per_page = News::getNumberOfNewsPerPage();
		
		$newsList = array();
		$newsList = News::getNewsListByPage($page);
		if (!empty($newsList)) {
			require_once (ROOT . '/views/news/index.php');		 	
		}
		else{
		 	Request_errorController::actionWrong_request();
		}

	
	
		
	}



	//метод для перегляду статті по відповідному їй id
	public function actionView($id)
	{
		if ($id) {
			$newsItem = News::getNewsItemById($id);

			//перевірка чи id новини в запиті має відповідну новину в таблиці бази даних
			//і якщо немає, то перенаправлення на сторінку помилки
			if ($id == $newsItem['id']) { require_once (ROOT . '/views/news/newsItem.php'); }
			
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
			
		}
	}
}