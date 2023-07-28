<?php

$nserver='localhost';
$db_username ='root';
$db_password = "12345";
$db_name='testLogin';





$conn = new mysqli($nserver,$db_username,$db_password,$db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

?>