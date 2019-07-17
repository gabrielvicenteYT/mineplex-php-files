<?php
  function getAccountRow($uuid){
  $configs = include('config.php');
  $mysqli = new mysqli($configs["host"], $configs["username"], $configs["password"], "Account");    if($mysqli->connect_errno){
      die("Error connecting to MySQL database (".$mysqli->connect_errno.") ".$mysqli->connect_error);
    }
    $stmt = $mysqli->prepare("SELECT * FROM accounts WHERE uuid = ?");
    $stmt->bind_param("s", $uuid);
    $stmt->execute();
    $res = $stmt->get_result();
    $row = $res->fetch_assoc();
    return $row;
  }
	$file = fopen("test.txt","a");
	$post_json = file_get_contents("php://input");
	$post = json_decode($post_json, true);
	foreach($post as $key=>$value) {
    	$message = $key . ":" . $value . "\n";
    	file_put_contents("login_test", $message);
    	fwrite($file,$message);
	}
	fclose($file);
	$response = array();
  $row = getAccountRow($post["Uuid"]);
  if($row["id"] == NULL){
$configs = include('config.php');
  $mysqli = new mysqli($configs["host"], $configs["username"], $configs["password"], "Account");    if($mysqli->connect_errno){
      die("Error connecting to MySQL database (".$mysqli->connect_errno.") ".$mysqli->connect_error);
    }
    //$_stmt = $mysqli->prepare("INSERT INTO accounts (uuid, name) values(?, ?)");
    //$_stmt->bind_param("ss", $post["Uuid"], $post["Name"]);
    //$_stmt->execute();
  }
  $row = getAccountRow($post["Uuid"]);
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