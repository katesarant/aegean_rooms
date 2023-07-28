<?php
session_start();
if(
    isset($_SESSION['id'])&&
    isset($_SESSION['password'])&&
    isset($_SESSION['email'])){

$id = $_SESSION['id'];
$email = $_SESSION['email'];
      
   

    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agean Apartments</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/c87f43880f.js" crossorigin="anonymous"></script>
    <link rel='stylesheet' href='../styles.css'>
</head>
<body>
    <div id='confirmMsg'>
    <h4>Thank you<p ><?php echo strtolower($email); ?>!</p></br>
      Your booking has accepted!</h4>
      
    </div>    
</body>
</html>