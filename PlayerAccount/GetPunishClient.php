<?php
  $target = file_get_contents("php://input");
  $configs = include('config.php');
  $mysqli = new mysqli($configs["host"], $configs["username"], $configs["password"], "Account");  if($mysqli->connect_errno){
    die("Error connecting to MySQL database (".$mysqli->connect_errno.") ".$mysqli->connect_error);
  }

  $response = array();
  $tokens = array();
  $response["Name"] = str_replace('"', "", $target);
  $response["Time"] = time();
  $stmt = $mysqli->prepare("SELECT * FROM accountPunishments WHERE target = ?");
  $stmt->bind_param("s", $post);
  $stmt->execute();
  $res = $stmt->get_result();
  $stmt->store_result();
  if($stmt->num_rows >= "1"){
    while($data = $res->fetch_assoc()){
      $tmp = array();
      $tmp["PunishmentId"] = $data["id"];
      $tmp["Admin"] = $data["admin"];
      $tmp["Time"] = $data["time"];
      $tmp["Sentence"] = $data["sentence"];
      $tmp["Category"] = $data["category"];
	  $tmp["Reason"] = $data["reason"];
      $tmp["Duration"] = $data["duration"];
	  $tmp["Removed"] = false;
      $tmp["Active"] = true;
	  $tmp["RemoveAdmin"] = $data["removeadmin"];
	  $tmp["RemoveReason"] = $data["removereason"];
      array_push($tokens, $tmp);
    }
  }
  $response["Punishments"] = $tokens;
  die(json_encode($response));
?>