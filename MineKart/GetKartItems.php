<?php
  $configs = include('config.php');
  $mysqli = new mysqli($configs["host"], $configs["username"], $configs["password"], "Account");  if($mysqli->connect_errno){
    die("Error connecting to MySQL database (".$mysqli->connect_errno.") ".$mysqli->connect_error);
  }


  $response = array();
  $tokens = array();
  $stmt = $mysqli->prepare("SELECT * FROM minekartitems WHERE name = ?");
  $stmt->bind_param("s", $post);
  $stmt->execute();
  $res = $stmt->get_result();
  $stmt->store_result();
  if($stmt->num_rows >= "1"){
    while($data = $res->fetch_assoc()){
      $tmp = array();
      $tmp["Material"] = $data["material"];
      $tmp["Data"] = $data["data"];
      array_push($tokens, $tmp);
    }
  }
  die(json_encode($response));
?>