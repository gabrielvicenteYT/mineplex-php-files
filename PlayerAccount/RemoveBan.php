<?php
	$post_json = file_get_contents("php://input");
	$post = json_decode($post_json, true);
	$configs = include('config.php');
	$mysqli = new mysqli($configs["host"], $configs["username"], $configs["password"], "Account");  if($mysqli->connect_errno){
		die("Error connecting to MySQL database (".$mysqli->connect_errno.") ".$mysqli->connect_error);
	}
	$target = $Post["Target"]
	$reason = $Post["Reason"]
	$removed = true
	$active = false
  
	$stmt = $mysqli->prepare("DELETE FROM accountPunishments WHERE target=? removed=? active=?");
	$stmt->bind_param("ss", $target, $reason);
	$stmt->execute();
	die("BanRemoved");
?>