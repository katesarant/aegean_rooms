<?php
session_start();



$id = $_SESSION['id'];
$email = $_SESSION['email'];


if(isset($_POST["Room_Athens"])){
    $room = 'Room_Athens';

}else if(isset($_POST["Room_Aegean"])){
    $room = 'Room_Aegean';
}



    function validate($data){

        $data = trim($data);
 
        $data = stripslashes($data);
 
        $data = htmlspecialchars($data);
        $data = $data;
 
        return $data;
    }  

   $msg =  validate($_POST[$room]);
  


    


  ///// Insert into Database;
  require_once './db_connection.php';
                    
  $sql = "INSERT INTO comments (userID , RoomName , msg , email) VALUES ($id,'$room','$msg','$email')"; 

 

if ($conn->query($sql) === TRUE ) {

 

  
    header("Location: ../rooms.php?upload=success");

 
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
   
  }


  

  $conn->close();





?>