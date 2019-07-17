<?php
	$post_json = file_get_contents("php://input");
	$post = json_decode($post_json, true);	
	$response = array();
	$configs = include('config.php');
	$mysqli = new mysqli($configs["host"], $configs["username"], $configs["password"], "Account");  if($mysqli->connect_errno){
		die("Error connecting to MySQL database (".$mysqli->connect_errno.") ".$mysqli->connect_error);
	}
	$name = $post["Name"];
	$rank = $post["Rank"];
	$perm = (int) $post["Perm"];	

	$stmt = $mysqli->prepare("UPDATE accounts SET `rank`=?,`rankPerm`=? WHERE `name`=?");
	$stmt->bind_param("sis", $rank, (int) $perm, $name);
	$stmt->execute();
?>