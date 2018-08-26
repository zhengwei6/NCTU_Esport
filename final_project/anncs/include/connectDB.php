<?php
  $databaseConnection = new mysqli("localhost","root","","final_project");
  
  if ( mysqli_connect_errno() ) {
   echo "連接錯誤代碼: ".mysqli_connect_errno()."<br/>";
   echo "連接錯誤訊息: ".mysqli_connect_error()."<br/>";
   exit();
  }
  
  $databaseConnection->query('SET NAMES utf8');
?>