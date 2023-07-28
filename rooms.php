<?php
session_start();
if(
    isset($_SESSION['id'])&&
    isset($_SESSION['password'])&&
    isset($_SESSION['email'])){

$id = $_SESSION['id'];
$email = $_SESSION['email'];

?>
<!DOCTYPE html>
<html lang="en" valide='false'>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    
    <title>Home</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/c87f43880f.js" crossorigin="anonymous"></script>
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
    <link rel='stylesheet' href='./styles.css'>
    <link rel="stylesheet" href="./assets/loader.css">
</head>
<?php include_once './extra/loader.php'?>
<body>
<div class='wrap_cycle'><p id='insiteCycle'>hello</p></div>


<?php include_once './extra/header.php'?>
</header>  

<main>


<div class="w-100 section"> <p class="w-70 p-4"> Check availability at your preferred destination<br> by clicking on a rooms name.</p></div>

<section>

<!-- imagies -->

<div class='mt-5 mb-5'>
<h4 class='mb-3 roomtitle '><a href='./extra/calendar.php?Room_Athens?m=<?php echo date('m')."y=".date('Y')?>' target='_blank' 
onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=650px,height=670px'); return false;">Room Athens</a></h4>
<div class='puzzle_wrapper'>
<div class='image_container row'>
        <div class="col-sm-4 ms-md-auto text-center "> 
            <img  class='m-image ' src="./assets/photos/puzzle/istockphoto-528678743-612x612.jpg" class="rounded float-start" alt="hotel view">
        </div>
        <div class="col-sm-4 text-center"> 
          <img class='m-image ' src="./assets/photos/puzzle/photo-1529290130-4ca3753253ae .jpeg" class="rounded float-end" alt="hotel view">
       </div>
       <div class="col-sm-4 text-center"> 
          <img class='m-image ' src="./assets/photos/puzzle/photo-1552566626-52f8b828add9.jpeg" class="rounded float-end" alt="hotel view">
       </div>
 </div> 
 <div class='image_container row'>     
       <div class="col-sm-4 text-center"> 
       <img class='m-image ' src="./assets/photos/puzzle/photo-1596701062351-8c2c14d1fdd0.jpeg" class="rounded float-end" alt="hotel view">
       </div>

       <div class="col-sm-4 ms-md-auto text-center"> 
       <img class='m-image ' src="./assets/photos/puzzle/photo-1498503182468-3b51cbb6cb24.jpeg" class="rounded float-end" alt="hotel view">
        </div>

        <div class="col-sm-4 ms-md-auto text-center"> 
        <img class='m-image ' src="./assets/photos/puzzle/photo-1630933868840-1e9299a5b8dd.jpeg" class="rounded float-end" alt="hotel view">
        </div>
  </div>
  </div>
</div>
  <!-- imagies -->
<div class='commentWrap p-3'>
<?php
    
require_once './conn/db_connection.php';
        $sql = "SELECT * FROM comments WHERE RoomName = 'Room_Athens'";
        $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

        $rows = mysqli_num_rows($result);

        if($rows>0){

                while($row = mysqli_fetch_array($result)){

          $msage_athens .= "<div class='comments  animate__animated animate__zoomIn'><p>". $row['msg']."</p>"."<p>". $row['email']."</p></div>";
          
    
    }
  }
  
 
?>
<?php 
echo $msage_athens;

?>
</div>
<div>


<form action="./conn/userMsg.php"  method='post' id="coR1">
<center> <p>leave your comment</p></center>
<textarea class="form-control p-2 mb-2 text-bg-light commentText" name='Room_Athens' maxlength='200' form="coR1" rows="4"></textarea>
 <label for="exampleFormControlTextarea1" class="form-label float-start"><?php 
 echo  $email;
 

?></label>
<div class='outercounter float-end'>
<span class='counter '></span>
</div>
  <button class='btn btn-primary btn-md btnText float-center' type='submit' ><i class="bi bi-chat-dots-fill"></i></button>
  
</form>
</div>
<hr>
<div class='mt-5 mb-5' >

<h4 class='mb-3 roomtitle'><a href="./extra/calendar.php?Room_Aegean?m=<?php date('m')?>" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=650px,height=620px'); return false;" target='_blank'>Room Aegean</a></h4><br>

<div class='puzzle_wrapper'><div id='picShow'>
  
</div>
<div class='image_container row'> 
        <div class="col-sm-4 ms-md-auto text-center "> 
            <img  class='m-image ' src="./assets/photos/puzzle/istockphoto-528678743-612x612.jpg" class="rounded float-start" alt="hotel view">
        </div>
        <div class="col-sm-4 text-center"> 
          <img class='m-image ' src="./assets/photos/puzzle/photo-1529290130-4ca3753253ae .jpeg" class="rounded float-end" alt="hotel view">
       </div>
       <div class="col-sm-4 text-center"> 
          <img class='m-image ' src="./assets/photos/puzzle/photo-1552566626-52f8b828add9.jpeg" class="rounded float-end" alt="hotel view">
       </div>
 </div> 
 <div class='image_container row'>     
       <div class="col-sm-4 text-center"> 
       <img class='m-image ' src="./assets/photos/puzzle/photo-1596701062351-8c2c14d1fdd0.jpeg" class="rounded float-end" alt="hotel view">
       </div>

       <div class="col-sm-4 ms-md-auto text-center"> 
       <img class='m-image ' src="./assets/photos/puzzle/photo-1498503182468-3b51cbb6cb24.jpeg" class="rounded float-end" alt="hotel view">
        </div>

        <div class="col-sm-4 ms-md-auto text-center"> 
        <img class='m-image ' src="./assets/photos/puzzle/photo-1630933868840-1e9299a5b8dd.jpeg" class="rounded float-end" alt="hotel view">
        </div>
  </div>
  </div>
</div>

  <div class='commentWrap p-3'>
 <?php
require_once './conn/db_connection.php';
        $sql = "SELECT * FROM comments  WHERE RoomName='Room_Aegean'";
  
        $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

        $rows = mysqli_num_rows($result);

        if($rows>0){

                while($row = mysqli_fetch_array($result)){
          if($row['RoomName']=='Room_Aegean'){
    $msage_aegean .= "<div class='comments animate__animated animate__zoomIn'><p>". $row['msg']."</p>"."<p>". $row['email']."</p></div>";
        
          }
       
  }
   

    }else {
      $msage_aegean .='Leave a commnet';
    }

?>

 <div class='comment_container text-center'>
  <?php 
echo $msage_aegean;

?>
</div>
 </div>
<div>
 
 <form action="./conn/userMsg.php" method='post' id="coR2">
 <center> <p>leave your comment </p></center>
 <textarea class="form-control p-2 mb-2 text-bg-light commentText" name='Room_Aegean' maxlength='200'  form="coR2" rows="4"></textarea>
 <label for="exampleFormControlTextarea1" class="form-label float-start"><?php 
 echo  $email;
 

?></label>
<div class='float-end outercounter'>
<span class='counter '></span> </div>
  <button class='btn btn-primary btn-md btnText float-center' type='submit' ><i class="bi bi-chat-dots-fill"></i></button>
 
</form> 
</div>
</section>


</main>




<?php include_once "./extra/footer.php";?>
  
  <script src='./js/roomsjs.js'></script>
  <script src='./js/mouse.js'></script>
   <script src='./js/loader.js'></script>  
  </body>
  </html>
  
  <?php
  
  }else{
      header('Location:index.php');
      exit();
  }
  ?>

