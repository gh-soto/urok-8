<?php
//


include_once ROOT . '/views/request_error/index.php';

class Request_errorController
{
	public static function actionWrong_request()
	{
		Request_errorView::request_error();
	}
}

