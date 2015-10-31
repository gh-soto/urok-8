<?php

//
return array (

	'login' => 'authorization/log_in',
	'logout' => 'authorization/log_out',


	'page/([0-9]+)' => 'news/indexbypage/$1',
	'page/([a-z]+)' => 'news/__wrong__',
	'page' => 'news/indexbypage/$1',
	

	'news/delete/([0-9]+)' => 'news/delete_news/$1', 
	'news/edit/([0-9]+)' => 'news/edit/$1',
	'news/add_news' => 'news/add_news',
	'news/([0-9]+)' => 'news/view/$1',
	'news' => 'news/indexbypage/$1',
	'' => 'news/indexbypage/$1', // actionIndex in NewsController
	);