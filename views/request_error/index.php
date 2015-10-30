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
				  <meta charset="UTF-8">
				</head>
				<body>
					<div class="article-item">
						<h1  style="color:#b43789;">WRONG   REQUEST</h1>
				   		<h3>check your link</h3>
					</div>
					<div>
						<a href="/"><h1>main page</h1></a>
					</div>
				</body>
				</html>

			   ';
	}
}


 ?>