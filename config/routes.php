<?php

//
return array (

	'login' => 'authorization/log_in',
	'logout' => 'authorization/log_out',

	'news/delete/([0-9]+)' => 'news/delete_news/$1', 
	'news/edit/([0-9]+)' => 'news/edit/$1',
	'news/add_news' => 'news/add_news',
	'news/([0-9]+)' => 'news/view/$1',
	'news' => 'news/index',
	'' => 'news/index', // actionIndex in NewsController
	);