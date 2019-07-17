<?php
	$configs = include('config.php');
	$mysqli = new mysqli($configs["host"], $configs["username"], $configs["password"], "Account");
	if($mysqli->connect_errno){
		die("Error connecting to MySQL database (".$mysqli->connect_errno.") ".$mysqli->connect_error);
	}
	
	$name = $post['Name'];
	$petName = $post['PetName'];
	$petType = $post['PetType'];
	
	$statement = $mysqli->prepare("UPDATE pets SET petname=$petname, pettype=$pettype WHERE name=$name");
	
?>