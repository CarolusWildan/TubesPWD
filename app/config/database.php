<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_perpustakaan";

//connect to database
try{
  $conn = new mysqli( $host, $user, $pass, $db);
  
}catch(PDOException $e){
  echo "Connection failed: " . $e->getMessage();
}
