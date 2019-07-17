<?php
	$post = file_get_contents("php://input");
	fclose($file);
	$response = array();
	$configs = include('config.php');
	$mysqli = new mysqli($configs["host"], $configs["username"], $configs["password"], "Account");  if($mysqli->connect_errno){
		die("Error connecting to MySQL database (".$mysqli->connect_errno.") ".$mysqli->connect_error);
	}

	$stmt = $mysqli->prepare("SELECT id FROM accounts WHERE accounts.uuid = ?");
	$stmt->bind_param("s", $post);
	$stmt->execute();
	$res = $stmt->get_result();
	$row = $res->fetch_assoc();
	if(!$row){
		die("fuck something went wrong!!");
	}
	$response["AccountId"] = $row["id"];
	$response["UUID"] = $row["accountid"];
	$response["taskId"] = $row["taskId"];

	die(json_encode($response));
?>