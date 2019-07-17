<?php
	$configs = include('config.php');
	$mysqli = new mysqli($configs["host"], $configs["username"], $configs["password"], "Account");
	if($mysqli->connect_errno){
		die("Error connecting to MySQL database (".$mysqli->connect_errno.") ".$mysqli->connect_error);
	}
	
	$name = $post['Name'];
	$petName = $post['PetName'];
	$petType = $post['PetType'];
	
	$statement = $mysqli->prepare("DELETE FROM pets WHERE name=$name AND petname=$petName AND pettype=$petType");
	$statement->execute();
	die("Success")
?>