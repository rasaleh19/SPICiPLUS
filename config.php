<?php
	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', '***');		//replace *** with your database username
	define('DB_PASSWORD', '***');		//replace *** with your database password
	define('DB_DATABASE', '***');		//replace *** with your database name
	$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
?>
