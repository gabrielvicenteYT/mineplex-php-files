<?php
  $configs = include('config.php');
  $mysqli = new mysqli($configs["host"], $configs["username"], $configs["password"], "Account");
  if($mysqli->connect_errno){
    die("Error connecting to MySQL database (".$mysqli->connect_errno.") ".$mysqli->connect_error);
  }

  $post_json = file_get_contents("php://input");
  $post = json_decode($post_json, true);

  $source = $post["Source"];
  $name = $post["Name"];
  $amount = $post["Amount"];


  /*$stmt = $mysqli->prepare("UPDATE accounts SET `coins`=coins+? WHERE `name`=?");
  $stmt->bind_param("is", $amount, $name);
  $stmt->execute();*/
  die("true");
?>