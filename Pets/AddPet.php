<?php
	$config = require('config.php');
	$mysqli = new mysqli($config["host"], $config["username"], $config["password"], "Account");
	if($mysqli->connect_errno){
		die("Error connecting to MySQL database (".$mysqli->connect_errno.") ".$mysqli->connect_error);
	}
	
	$name = $post['Name'];
	$petName = $post['PetName'];
	$petType = $post['PetType'];
	
	$statement = $mysqli->prepare("INSERT INTO pets (name, petname, pettype) VALUES($name, $petName, $petType)");
	$statement->execute();
	die("Success");
?>