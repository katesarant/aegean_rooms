<?php
 require_once './db_connection.php';

$id = $_REQUEST['id'];


$sql = "DELETE FROM bookings WHERE bookingId = '" . $id . "'";

if ($conn->query($sql) === TRUE){
    header("Location: profile.php");
} else {
    echo "Error deleting record: " . $conn->error;
}

header('Location:../profile.php');
    exit();


    
?>