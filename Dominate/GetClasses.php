<?php
	$post_json = file_get_contents("php://input");
	$post = json_decode($post_json, true);
	$configs = include('config.php');
	$mysqli = new mysqli($configs["host"], $configs["username"], $configs["password"], "Account");  if($mysqli->connect_errno){
		die("Error connecting to MySQL database (".$mysqli->connect_errno.") ".$mysqli->connect_error);
	}
	
	
?>