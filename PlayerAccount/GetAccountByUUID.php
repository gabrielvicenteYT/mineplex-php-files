<?php
	$post = file_get_contents("php://input");
	fclose($file);
	$response = array();
	$configs = include('config.php');
	$mysqli = new mysqli($configs["host"], $configs["username"], $configs["password"], "Account");  if($mysqli->connect_errno){
		die("Error connecting to MySQL database (".$mysqli->connect_errno.") ".$mysqli->connect_error);
	}

	$stmt = $mysqli->prepare("SELECT * FROM accounts WHERE uuid = ?");
	$stmt->bind_param("s", $post);
	$stmt->execute();
	$res = $stmt->get_result();
	$row = $res->fetch_assoc();
	if(!$row){
		die("fuck something went wrong!!");
	}

	$_rankperm = $row["rankPerm"];
	$rperm = false;
	if($_rankperm == 1){
		$rperm = true;
	}
	$response["AccountId"] = $row["id"];
	$response["Name"] = $row["name"];
	$response["Rank"] = $row["rank"];

	$response["RankPerm"] = $rperm;
	$response["RankExpire"] = (int) $row["rankExpire"];
	$response["EconomyBalance"] = 100;
	$response["LastLogin"] = (int) $row["lastLogin"];

	die(json_encode($response));
?>