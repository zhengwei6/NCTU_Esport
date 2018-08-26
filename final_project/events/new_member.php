<?php
  session_start();
  $url  = $_SESSION["URL"];
  if(isset($_SESSION["ID"])){
    $id   = $_SESSION["ID"];
	$name = $_SESSION["NAME"];
	$ok_events = $_SESSION["ok_events"];
	setcookie($id."[URL]",$url,time+3600);
	setcookie($id."[ID]",$id,time()+3600); 
	setcookie($id."[NAME]",$name,time()+3600);
	setcookie($id."[ok_events]",$ok_events,time()+3600);
  }
  $a = "Location: signup.php?signup=".$url;
  header($a);
?>
