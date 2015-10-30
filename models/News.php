<?php

/**
* *
*/
class News
{	

	//якщо в запиті є id статті, то робить виборку з бд по цьому id в всі дані записуються в масив $newsItem
	public static function getNewsItemById($id)
	{
		$id = intval($id);

		if ($id) {
			$db = Db::getConnection();
			$result = $db->query("SELECT * FROM `publication` WHERE id=" . $id);
			$newsItem = $result->fetch(PDO::FETCH_ASSOC);

			return $newsItem;
		}
	}


	public static function addNewsItem() 
	{
		$db = Db::getConnection();

		if (isset($_POST['submit'])) {
		
			$stmt = $db->prepare('INSERT INTO `publication` 
									VALUES(
											NULL, 
											:title, 
											NULL, 
											:short_content, 
											:content, 
											:author, 
											:preview, 
											:type
											)
								');

			// Обрізаємо усі теги у загловку.
			$stmt->bindParam(':title', strip_tags($_POST['title']));

			// Екрануємо теги у полях короткого та повного опису.
			$stmt->bindParam(':short_content', htmlspecialchars($_POST['short_content']));
			$stmt->bindParam(':content', htmlspecialchars($_POST['content']));

			//додав щонебудь (аби к-сть даних відповідала к-сті стовпців в таблиці)
			//а по-нормальному треба додати поля у форму чи селекти якісь (ДОРОБИ!!!!!!)
			$stmt->bindParam(':author', htmlspecialchars('editor'));
			$stmt->bindParam(':preview', htmlspecialchars('image'));
			$stmt->bindParam(':type', htmlspecialchars('unknown_type'));

			$status = $stmt->execute();

			// При успішному запиту перенаправляємо користувача на сторінку перегляду статті.
			if ($status) {
				// За допомогою методу lastInsertId() ми маємо змогу отрмати ІД статті, що була вставлена.
				header("Location: /news/{$db->lastInsertId()}");
				exit;
			}
		}
	}


	public static function editNewsItemById($id)
	{
		
		$db = Db::getConnection();
		$id = intval($id);


		if ($id) {
			$db = Db::getConnection();
			$result = $db->query("SELECT * FROM `publication` WHERE id=" . $id);
			$newsItem = $result->fetch(PDO::FETCH_ASSOC);

			if (isset($_POST['edit_post'])) {

				$q = $db->prepare("UPDATE `publication`  SET title = :title, short_content = :short_content, content = :content WHERE id = :id");

				$q->bindParam(':id', $newsItem['id'], PDO::PARAM_INT);	

				// Обрізаємо усі теги у загловку.
				$q->bindParam(':title', strip_tags($_POST['title']));

				// Екрануємо теги у полях короткого та повного опису.
				$q->bindParam(':short_content', htmlspecialchars($_POST['short_content']));
				$q->bindParam(':content', htmlspecialchars($_POST['content']));

				// Виконуємо запит, результат запиту знаходиться у змінні $status.
				// Якщо $status рівне TRUE, тоді запит відбувся успішно.
				$status = $q->execute();
				if ($status) {
					//перенаправлення на сторінку щойновідредагованої статті
					header("Location: /news/{$newsItem['id']}");
					exit;
				}
			}
			
			return $newsItem;
		}		
	}


	public static function deleteNewsItemById($id)
	{

		//тут можна було б використати метод з цього ж класу getNewsItemById($id) , але в мене не вийшло так зробити
		$id = intval($id);

		if ($id) {
			$db = Db::getConnection();
			$result = $db->query("SELECT * FROM `publication` WHERE id=" . $id);
			$newsItem = $result->fetch(PDO::FETCH_ASSOC);

			if (isset($_POST['abort_delete'])) { header("Location: /news/{$newsItem['id']}"); }
			elseif (isset($_POST['delete_post'])) {
				
				$stmt = $db -> prepare("DELETE FROM `publication` WHERE id = :id");
				$stmt->bindParam(':id', $newsItem['id'], PDO::PARAM_INT);   
				$stmt->execute();
				header("Location: /");
					
			}

			return $newsItem;
		}
	}



	public static function getNewsList()
	{
		
		$db = Db::getConnection();
		$newsList = array();
		$result = $db->query("SELECT id, title, date, short_content FROM `publication` ORDER BY date DESC LIMIT 10");
		$i = 0;
		while ($row = $result->fetch()) {
			$newsList[$i]['id'] = $row['id'];
			$newsList[$i]['title'] = $row['title'];
			$newsList[$i]['date'] = $row['date'];
			$newsList[$i]['short_content'] = $row['short_content'];
			$i++;
		}

		/*
		$result = $db->prepare("SELECT id, title, date, short_content FROM `publication` ORDER BY date DESC LIMIT 10");
		$result->execute();
		$articles = $result->fetchAll(PDO::FETCH_ASSOC);

		foreach ($articles as $article) {
			$newsList['id'] = $article['id'];
			$newsList['title'] = $article['title'];
			$newsList['date'] = $article['date'];
			$newsList['short_content'] = $article['short_content'];
		}
		*/
		return $newsList;
	}
}