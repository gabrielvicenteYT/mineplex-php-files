<?php
  function getAccountId($name){
$configs = include('config.php');
  $mysqli = new mysqli($configs["host"], $configs["username"], $configs["password"], "Account");    if($mysqli->connect_errno){
      die("Error connecting to MySQL database (".$mysqli->connect_errno.") ".$mysqli->connect_error);
    }
    $stmt = $mysqli->prepare("SELECT * FROM accounts WHERE name = ?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $res = $stmt->get_result();
    $row = $res->fetch_assoc();
    return $row["id"];
  }
  function getCoins($name){
$configs = include('config.php');
  $mysqli = new mysqli($configs["host"], $configs["username"], $configs["password"], "Account");    if($mysqli->connect_errno){
      die("Error connecting to MySQL database (".$mysqli->connect_errno.") ".$mysqli->connect_error);
    }
    $stmt = $mysqli->prepare("SELECT * FROM accounts WHERE name = ?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $res = $stmt->get_result();
    $row = $res->fetch_assoc();
    return $row["coins"];
  }
  $post_json = file_get_contents("php://input");
  $post = json_decode($post_json, true);
$configs = include('config.php');
  $mysqli = new mysqli($configs["host"], $configs["username"], $configs["password"], "Account");  if($mysqli->connect_errno){
    die("Error connecting to MySQL database (".$mysqli->connect_errno.") ".$mysqli->connect_error);
  }

  $qry = "";
  $name = $post["AccountName"];
  $sPkgName = $post["SalesPackageName"];
  $coinPurchase = $post["CoinPurchase"];
  $cost = $post["Cost"];
  $premium = $post["Premium"];
  $accId = getAccountId($name);
  $reason = "Purchased ".$sPkgName;
  if($cost > getCoins($name)){
    die("InsufficientFunds");
  }else{
    $stmt = $mysqli->prepare("INSERT INTO accountCoinTransactions(accountId, reason, coins) VALUES(?, ?, ?)");
    $stmt->bind_param("isi", $accId, $reason, $cost);
    $stmt->execute();
    die("Success");
  }
?>