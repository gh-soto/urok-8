<?php

//
include_once ROOT . '/models/Authorization.php';
include_once ROOT . '/controllers/Request_errorController.php';
/**
* клас для контролю над авторизацією і правами (видалення, редагування, додавання контенту)
*/
class AuthorizationController
{	
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