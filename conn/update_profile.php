<?php 

session_start();
 require_once 'db_connection.php';

$id =$_SESSION['id'];


if(
    isset($_POST["Firstname"])&&
    isset($_POST["Lastname"])&&
    isset($_POST["Phone"])&&
    isset($_POST["createdCart"])){

        function validate($data){

            $data = trim($data);
     
            $data = stripslashes($data);
     
            $data = htmlspecialchars($data);
            $data = $data;
     
            return $data;
        }  

        $fname = validate($_POST["Firstname"]);
        $lname = validate($_POST["Lastname"]);
        $phone = validate($_POST["Phone"]);
        $credit = validate($_POST["createdCart"]);


            ///// Insert into Database;
            require_once 'db_connection.php';
                    
            $sql = " UPDATE users SET firstName='$fname', lastName='$lname',created_cartNo=$credit,phone='$phone' WHERE id = $id";
               
          //  header("Location: home.php");
    
          if ($conn->query($sql) === TRUE) {
          
            
              header("Location: ../profile.php?upload=success");

           
            } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
             
            }


            

            $conn->close();
        }   

?>