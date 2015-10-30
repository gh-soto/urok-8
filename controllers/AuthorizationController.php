<?php

//
include_once ROOT . '/models/Authorization.php';
include_once ROOT . '/controllers/Request_errorController.php';
/**
* клас для контролю над авторизацією і правами (видалення, редагування, додавання контенту)
*/
class AuthorizationController
{	


		//в разі введення неправильного запиту, відповідний йому метод не буде знайдений в контроллері
	//тому викличеться магічний метод __call, який перенаправить користувача на сторінку з інформацією про помилку
	public function __call($actionName, $parameters)
	{
		Request_errorController::actionWrong_request();
		
	}


	
	public function actionLog_in()
	{				 
		Authorization::logIn();
		require_once (ROOT . '/views/authorization/login.php');
		//return $editor;
		
	}



	public  function actionLog_out()
	{
		Authorization::logOut();
	}



/*
	public static function actionAuthorization_check()
	{
		return Authorization::logIn();
	}


*/

	
}