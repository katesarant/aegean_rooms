<?php
require_once 'db_connection.php';

session_start();
$id = $_SESSION['id'];




      /*------------DELETE PROFILE----------------*/


// delete from folder
$target_dir = '../assets/avatar/';
   // specified folder
   $files = glob("$target_dir/*"); 
                            
   // Deleting all the files in the list
   foreach($files as $file) {
   
       if(is_file($file)) 
       
           // Delete the given file
           unlink($file); 
   }
   

//    delete from database


        $sql = " UPDATE users SET profile_pic = '' WHERE id = $id";
        echo $sql;
   

        if ($conn->query($sql) === TRUE) {
            header("Location: ../profile.php?delete=success");
  
          } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }

  


$conn->close();




?>