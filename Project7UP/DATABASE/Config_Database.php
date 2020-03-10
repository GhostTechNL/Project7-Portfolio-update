<?php
//Server connect info

$db['server'] = 'localhost';
$db['user'] = 'root';
$db['password'] = '';
$db['database'] = 'Portfolio';

$conn = mysqli_connect($db['server'], $db['user'], $db['password'], $db['database']);

	if(!$conn){
	    die("Connection failed: ".mysqli_connect_error());
    }



?>