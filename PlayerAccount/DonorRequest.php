<?php
  $post_json = file_get_contents("php://input");
  $post = json_decode($post_json, true);
  $configs = include('config.php');
  $mysqli = new mysqli($configs["host"], $configs["username"], $configs["password"], "Account");
  if($mysqli->connect_errno){
    die("Error connecting to MySQL database (".$mysqli->connect_errno.") ".$mysqli->connect_error);
  }

  $stmt = $mysqli->prepare("SELECT * FROM accounts WHERE uuid = ?");
  $stmt->bind_param("s", $post["uuid"]);
  $stmt->execute();
  $res = $stmt->get_result();
  $row = $res->fetch_assoc();


  $response = array();
  $restoken = array();
  $restoken["Gems"] = $row["gems"];
  $restoken["Donated"] = false;
  $restoken["SalesPackages"] = array();
  $restoken["UnknownSalesPackages"] = array();
  $restoken["Transactions"] = array();
  $restoken["CoinRewards"] = array();
  $restoken["Coins"] = $row["coins"];

  $response["Name"] = $row["name"];
  $response["DonorToken"] = $restoken;
  die(json_encode($response));
?>