<?php

require 'db_connection.php';


if(
    isset($_POST['email'])&&
    isset($_POST['pword']))
    {


        function validate($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

$email = validate($_POST['email']);
$password = validate($_POST['pword']);
$sql = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($conn, $sql);
$rows = mysqli_num_rows($result);


if ($rows >0){
  echo '<script>alert("This email address already exist,please try to login ")</script>';
  echo '<script>window.location.replace("../index.php")</script>';

}else{

  if ($rows === 0){
  $sql2 = "INSERT INTO users (id,  email ,  password ,  firstName ,  lastName ,  profile_pic ,  created_cartNo ,  phone ) VALUES ( NULL ,'$email','$password','','','','','')";

  if ($conn->query($sql2) === TRUE) {
    echo '<script>window.location.replace("../index.php")</script>';
    echo '<script>alert("You sigh in successfully,please try to login ")</script>';
 
  } else {
    echo "Error: " . $sql2 . "<br>" . $conn->error;
  }
}



}}



?>