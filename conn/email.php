<?php
session_start();



$id = $_SESSION['id'];
$email = $_SESSION['email'];
$msg = $_POST['msg'];

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    function validate($data){

        $data = trim($data);
 
        $data = stripslashes($data);
 
        $data = htmlspecialchars($data);
        $data = $data;
 
        return $data;
    }  

   $msg =  validate($msg);
   $id =  validate($id);
   $email =  validate($email);
  
  


  ///// Insert into Database;
  require_once './db_connection.php';
                    
  $sql = "INSERT INTO messages (id , user_msg , email,user_id) VALUES (NULL,'$msg','$email',$id)"; 



if ($conn->query($sql) === TRUE ) {

    header("Location: ../home.php?message=success");
    
 
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
   
  }




  $conn->close();

}



?>