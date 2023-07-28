<?php
require_once 'db_connection.php';

session_start();
$id = $_SESSION['id'];


if(
    isset($_POST["delete"])){

      /*------------DELETE PROFILE----------------*/

        $sql = "DELETE FROM users WHERE id = '" . $id . "'";

        if ($conn->query($sql) === TRUE) {
            header("Location: ../login.php?delete=success");
      
          } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }

        /*------------DELETE BOOKINGS----------------*/
        $sql1 = "DELETE FROM bookings WHERE userID = '" . $id . "'";
        if(mysqli_query($conn, $sql1)){
        print ("success");
        } else {
        print("Failed");
        }


$conn->close();
}



?>