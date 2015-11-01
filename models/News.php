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
			$result = $db->query("SELECT * 
								  FROM `publication` 
								  WHERE id=" . $id
								);
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
									  )'
								);

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
			$result = $db->query("SELECT * 
								  FROM `publication` 
								  WHERE id=" . $id
								);
			$newsItem = $result->fetch(PDO::FETCH_ASSOC);

			if (isset($_POST['edit_post'])) {

				$q = $db->prepare("UPDATE `publication`  
								   SET title = :title, short_content = :short_content, content = :content 
								   WHERE id = :id"
								  );

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
			$result = $db->query("SELECT * 
								  FROM `publication` 
								  WHERE id=" . $id
								);
			$newsItem = $result->fetch(PDO::FETCH_ASSOC);


			if (isset($_POST['abort_delete'])) { 

				header("Location: /news/{$newsItem['id']}"); 

			}
			elseif (isset($_POST['delete_post'])) {	

				$stmt = $db -> prepare("DELETE FROM `publication` 
										WHERE id = :id"
									  );
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
		$result = $db->query("SELECT id, title, date, short_content 
							  FROM `publication` 
							  ORDER BY date DESC 
							  LIMIT 10"
							);
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



	//виводить форму з вибором к-сті новин на сторінку
	public static function getNumberOfNewsPerPage()
	{

		//функція з формою вибору статтей на сторінку
		function selected_news_per_page($value, $new_atribute){
			$form_select = '<form class="form-inline " role="form"  action="' . $_SERVER["REQUEST_URI"] . '" method="POST">	
								<div class="form-group">	
									<select class="form-control" name="news-per-page" onchange="if (this.form) this.form.submit();">
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
									</select>
								</div>
							</form>';

			$path = 'value="' . $value . '"';
			$replace = 'value="' . $value . '" ' . $new_atribute;
			$form_select = str_replace($path, $replace, $form_select);
			return $form_select;
		}

		//в селекті вибрано 3 по замовчуванню
		$form_select = selected_news_per_page ('3', 'selected');

		//встановлення атрибуту "selected" залежно від вибраного option в select
		if (isset($_POST['news-per-page']) && isset($_COOKIE['news-per-page'])) {
			$form_select = selected_news_per_page ($_POST['news-per-page'], 'selected'); 
		}
		elseif (isset($_COOKIE['news-per-page'])) {
			$form_select = selected_news_per_page ($_COOKIE['news-per-page'], 'selected'); 
		}
		
		return $form_select;
	}





	public static function getNewsListByPage($page)
	{
		$db = Db::getConnection();
		
		//тут взнаю кільскість записів в таблиці
		$row_count = array();
		$stmt = $db->query("SELECT COUNT(1) 
						    FROM `publication`"
						   );
		$row_count = $stmt->fetch(PDO::FETCH_NUM);
		$page = intval($page);


		//це скільки новин треба показувати на сторінці. 
		//число береться з селекта (з селекта воно передається в POST і зберігається в кукі)
		if (isset($_POST['news-per-page'])) {
			$news_quantity = $_POST['news-per-page'];
			setcookie("news-per-page", $news_quantity, time()+360000, "/");
		}
		elseif (isset($_COOKIE['news-per-page'])) {
			$news_quantity = $_COOKIE['news-per-page'];
		}

		//задається к-сть новин на сторінку по замовчуванню
		elseif (!isset($_POST['news-per-page']) && !isset($_COOKIE['news-per-page'])) {
			$news_quantity = 3;
			setcookie("news-per-page", $news_quantity, time()+360000, "/");
		}


		//взнаю кількість можливих сторінок на даний момент (округлення в більшу сторону)
		$page_count = ceil($row_count[0]/$news_quantity);


		//правило перенаправлення на сторінку з останніми доданими статтями
		if ($page == 0 || !isset($page) || $page > $page_count) {
			$page = $page_count;
		}


		//робить виборку даних з таблиці відповідно до номеру сторінки ($page) в запиті та числа к-сті новин на сторінку
		if ($page) {
			
			$result = $db->query("SELECT id, title, date, short_content 
								  FROM `publication` 
								  ORDER BY date DESC 
								  LIMIT " . (($page_count - $page) * $news_quantity)  . ", " . $news_quantity
								);
											//(($page-1) * $news_quantity)  --  для послідовності сторінок: сторінка №1 з новими статтями
											//(($page_count - $page) * $news_quantity)  -- для послідовності сторінок: сторінка №1 з старими статтями, а остання сторінка з найновішими статтями
			$i = 0;
			while ($row = $result->fetch()) {
				$newsList[$i]['id'] = $row['id'];
				$newsList[$i]['title'] = $row['title'];
				$newsList[$i]['date'] = $row['date'];
				$newsList[$i]['short_content'] = $row['short_content'];
				$newsList[$i]['page'] = $page;


				//умова якщо це перша чи остання сторінка з статтями, то кнопці задаються атрибути
				if ($page == $page_count) {
					$newsList[$i]['display_none_back'] = ' style="visibility: hidden;"';
					$newsList[$i]['display_none_next'] = ' ';
				}
				elseif ($page == 1) {
					$newsList[$i]['display_none_back'] = ' ';
					$newsList[$i]['display_none_next'] = ' style="visibility: hidden;"';
				}
				else {
					$newsList[$i]['display_none_back'] = ' ';
					$newsList[$i]['display_none_next'] = ' ';
				}

				$i++;
			}
		}

		return $newsList;
	}



}