<?php
session_start();
$id = $_GET["ID"];
if(isset($_COOKIE[$id])){
  while(list($name,$value) = each($_COOKIE[$id])){
    setcookie($id."[".$name."]", "",time()-3600);
  }
}
header("Location: signup.php?signup=".$_SESSION["URL"]);
?>