<?php 

class Request_errorView
{
	public static function request_error()
	{
		print '

			<!DOCTYPE html>
				<html>
				<head>
					<title><?php print $page_title; ?></title>
					
					<link rel="stylesheet" type="text/css" href="/template/style/bootstrap.min.css">
					<link rel="stylesheet" type="text/css" href="/template/style/style.css">

					<script src="js/jquery-1.11.3.min.js"></script>
					<script src="js/bootstrap.min.js"></script>

					<link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet" type="text/css">
					<link href="https://fonts.googleapis.com/css?family=Bad+Script&subset=latin,cyrillic" rel="stylesheet" type="text/css">

					<meta charset="UTF-8">
				</head>
				<body>
					<div>
						<a href="/"><h1 style="font-size: 4em;">main page</h1></a>
					</div>
					<div class="article-item" style="margin-top: 15%;">
						<h1>WRONG   REQUEST</h1>
				   		<h3>check your link</h3>
					</div>

				</body>
				</html>

			   ';
	}
}


 ?>