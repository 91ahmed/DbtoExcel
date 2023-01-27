<?php
	
	require ('vendor/autoload.php');

	use ExtractDatabaseToExcel\TableToExcel;

	$extract = new TableToExcel([
		'driver' => 'mysql',
		'host' => '127.0.0.1',
		'username' => 'root',
		'password' => '',
		'database' => 'test',
		'port' => '3306',
		'charset' => 'utf8',
		'sslmode' => 'disable'
	]);
	$extract->table('users'); // Specify the database table.
	$extract->columns('*'); // Specify the columns you need to extract.
	$extract->execute(); // Execute the script.
?>