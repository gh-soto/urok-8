<?php 

class Authorization
{
	
	//в цьому методі все неправильно, але працює
	//треба переробити
	public static function logIn()
	{

		//використовується для запису помилки "невідповідність логіна і пароля"
		$wrong_pass_or_login = '';


		//це масив з даними: 
		// -  логін, з яким можна зайти на сайт
		// - пароль "123", але ми його не зберігаємо у відкритому вигляді, ми вписуємо тільки хеш md5.
		$user = array(
			'name' => 'admin',
			'pass' => '202cb962ac59075b964b07152d234b70',
		);

		// Якщо користувач відправляє форму, тоді аналізуємо дані з POST.
		if (!empty($_POST['name']) && !empty($_POST['pass'])) {

			// Якщо доступи вірні, тоді робимо відповідний запис у сесії.
			if ($_POST['name'] == $user['name'] && md5($_POST['pass']) == $user['pass']) {

		    	$_SESSION['login'] = $user['name'];

	    		if (isset($_SESSION['login'])) {
					$admin_power = $_SESSION['login'];
				}
				else { 
					$admin_power = 0;	
				}
				header('Location: /');
			}
			else { 
				$wrong_pass_or_login = 'wrong username or password'; 
				$admin_power = 0;
			}
		}

		//якщо інформація в поля форми авторизації не вводилась, то 
		//перевіряється чи існує взагалі сесія з змінною ['login'] і відповідно до цього даються права
		else {

			if (isset($_SESSION['login'])) { 
				$admin_power = $_SESSION['login'];

			}
			else { $admin_power = 0; }
		}

		//масив зі значеннями вдалої авторизації та помилки "невідповідність логіна і пароля"
		$check_auth = array(
							'check_login' => $admin_power, 
							'error_login' => $wrong_pass_or_login);

		return $check_auth;
	}


	public static function logOut()
	{
		// Видаляємо інформацію про сесію.
		session_destroy();

		// Направляємо користувача на головну сторінку.
		header('Location: /');
	}



}


 ?>