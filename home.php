<?php
session_start();
if(
    isset($_SESSION['id'])&&
    isset($_SESSION['password'])&&
    isset($_SESSION['email'])){

$id = $_SESSION['id'];
      
       
require_once './conn/db_connection.php';
      
$sql1 = "SELECT * FROM users WHERE id= $id  ";

$result1 = $conn->query($sql1);


$s=1;
while ($row = mysqli_fetch_array($result1) ) {

$s++;

    if (empty($row['firstName']) || (empty($row['lastName']))|| (empty($row['phone']))){
      $p_info.= '<script>document.getElementById("bookform").setAttribute("valide","false");</script>';
      $p_info.=  '<center><h4 class="attetion">Please to make a booking , fill up your<a href="profile.php"> profile</a>.</h4></center>';
      $p_info.=  '<script> alert("To make a booking , fill up your profile"); </script>';

 if($s>1){
  break;
}

 }else{
 
  $p_info.=  '<script>document.getElementById("bookform").setAttribute("valide","true");</script>';

  if($s>1){
    break;
}
    }
     }

      //check if the pic in the folder is the same as the dbase photo.

     $arr = scandir(__DIR__."/assets/avatar/");

     $pic =$row['profile_pic'];


     foreach($arr as $a){
     if($a == $pic){
     $match = TRUE; 
     break;
     }else{
     $match = FALSE;
     }

     }

     $picture = ($match)?'./assets/avatar/'.$row['profile_pic']:"https://cdn-icons-png.flaticon.com/512/847/847969.png?w=826&t=st=1686500067~exp=1686500667~hmac=1b236537ec17eef064cd113483f51853824c9f33e1471640349c8d5bb2d8377b";
     $_SESSION['picture'] = $picture;


     

?>
<!DOCTYPE html>
<html lang="en" valide='false'>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    
    <title>Home</title>
    <script src="https://kit.fontawesome.com/c87f43880f.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <!-- css-animations -->
    <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel='stylesheet' href='./styles.css'>
    <link rel="stylesheet" href="./assets/loader.css">
</head>

<?php include_once './extra/loader.php'?>

<body class="w-100">
<div class='wrap_cycle'><p id='insiteCycle'>hello</p></div>

<?php include_once './extra/header.php'?>


  <main>



  
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="assets/photos/alexandre-chambon-aapSemzfsOk-unsplash.jpg" alt='hotel photo' class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="assets/photos/camille-brodard-KSXOHHDBkGY-unsplash.jpg" alt='hotel photo' class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="assets/photos/christopher-jolly-GqbU78bdJFM-unsplash.jpg" alt='hotel photo' class="d-block w-100" alt="...">
          </div>
      </div>
  </div>


<form  id='bookform' action="./conn/booking.php" method="post">
  <section>
        <br/>
     
        <?php
  
          echo  $p_info; //check if the visitor has fill in the personal info field.
     ?>


    <p id="hTitle">Find Your Next Destination </p>
        <hr>
        <select required name='RoomName'id='hotelName' class="formValidation form-select form-select-md mb-3 "  aria-label=".form-select-lg example">
        <option  value ='0'selected>Destination</option>
        <option value="Room_Athens">Room Athens</option>
        <option value="Room_Aegean">Room Aegean</option>
        
        </select>

      <select required name='adults' id='adultNo' class=" formValidation form-select form-select-md mb-3 " aria-label=".form-select-lg example">
        <option value='0'  selected>How many adults?</option>
        <option value="1">One</option>
        <option value="2">Two</option>
        <option value="3">Three</option>
      </select>
      <select required name='childrenNo' id='childNo' class="formValidation form-select form-select-md mb-3 " aria-label=".form-select-lg example">
        <option value='title' selected>How many children?</option>
        <option value="0">None </option>
        <option value="1">One</option>
        <option value="2">Two</option>
        <option value="3">Three</option>
      </select>

          <div class="input-group mb-3">
            <span class="input-group-text" >Check In day</span>
           
            <input  id="checkInday" name="checkin" type="date" value= "<?php echo date('Y-m-d', strtotime("+1 day"));?>" onchange="validateIn(this);return false;" class="formValidation form-control "  aria-label="CheckIn" aria-describedby="basic-addon1">
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text" >Check Out day</span>
            <input id="checkOutday" name="checkout" type="date"  class="formValidation form-control" value= "<?php echo date('Y-m-d', strtotime("+1 day"));?>" aria-label="CheckOut" onchange="validateOut(this);return false;" aria-describedby="basic-addon1">
          </div>
          <div id='total'> <h5>Total:</h5><div id='totalPrice'><input id='totalPriceSpan'readonly class="form-control-plaintext"  name="price" type="text" value='0' />
             <svg id="euroSigh" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-currency-euro" viewBox="0 0 16 16">
  <path d="M4 9.42h1.063C5.4 12.323 7.317 14 10.34 14c.622 0 1.167-.068 1.659-.185v-1.3c-.484.119-1.045.17-1.659.17-2.1 0-3.455-1.198-3.775-3.264h4.017v-.928H6.497v-.936c0-.11 0-.219.008-.329h4.078v-.927H6.618c.388-1.898 1.719-2.985 3.723-2.985.614 0 1.175.05 1.659.177V2.194A6.617 6.617 0 0 0 10.341 2c-2.928 0-4.82 1.569-5.244 4.3H4v.928h1.01v1.265H4v.928z"/>
</svg></div></div>
          <button  id='btnform'disabled type='button' name='bookingBtn'  class='btn btn-primary '  >Book now</button>
          <!--  -->
          <hr/>
  </section>
  


  </form>
<div id='AboutUs' class='section'>

      <p id="hTitle">Visit our Appartments</p>
      <br>
      <div class="properties">

        <ul >
          <li>Our appartments Offering an outdoor pool and water sports facilities,<br>
          the beachfront and family-run Complex Region. Free WiFi is featured <br>throughout the property and
          free private parking is available on site. The accommodation <br>comes with a seating area.
            There is also a kitchenette,fitted with a refrigerator.<br>
            There is a private bathroom with a shower in every unit.<br> Bed linen is provided. You can play billiards at the property.
            Guests can enjoy various activities in the surroundings,<br> including snorkeling, cycling and canoeing.</li>

        </ul>
      </div>

</div>


<div class="container text-center">
   <div class='image_container row'>
        <div class="col-sm-4 ms-md-auto "> 
            <img   src="./assets/photos/puzzle/istockphoto-528678743-612x612.jpg" class="rounded float-start m-image " alt="hotel view">
        </div>
        <div class="col-sm-4"> 
          <img  src="./assets/photos/puzzle/photo-1529290130-4ca3753253ae .jpeg" class="rounded float-end m-image" alt="hotel view">
       </div>
       <div class="col-sm-4"> 
          <img  src="./assets/photos/puzzle/photo-1552566626-52f8b828add9.jpeg" class="rounded float-end m-image" alt="hotel view">
       </div>
   
     
       <div class="col-sm-4"> 
       <img  src="./assets/photos/puzzle/photo-1596701062351-8c2c14d1fdd0.jpeg" class="rounded float-end m-image" alt="hotel view">
       </div>

       <div class="col-sm-4 ms-md-auto"> 
       <img src="./assets/photos/puzzle/photo-1498503182468-3b51cbb6cb24.jpeg" class="rounded float-end m-image" alt="hotel view">
        </div>

        <div class="col-sm-4 ms-md-auto"> 
        <img  src="./assets/photos/puzzle/photo-1630933868840-1e9299a5b8dd.jpeg" class="rounded float-end m-image" alt="hotel view">
        </div>
  </div>

    <section class="hotel_container">

                    <div class="rooms_info">
                      <div class="properties"><h4>Amenities </h4>

                        <ul >
                          <li>Accommodates: 2</li>
                          <li>Beds: 2 Double(s)</li>
                          <li>Size: 260 sq ft</li>
                          
                          <br>
                          <li><i class="fab fa-accessible-icon"></i><span>Accessible</span></li>
                              <li><i class="far fa-clock fa-lg"></i><span>Check in time 12:00 / Check out time 14:00</span></li>
                              <li><i class="fa fa-wifi" aria-hidden="true"></i><span>Free Wifi</span></li>
                              <li><i class="fa fa-coffee" aria-hidden="true"></i><span> Breackfast</span></li>
                              <li><i class="fas fa-paw"></i>
                              <span>pet friendly</span>
                              <li><i class="fab fa-fort-awesome"></i><span>5 min walk from the Town center</span></li>
                              <li><i class="fa fa-spa" aria-hidden="true"></i><span>Spa</span></li>
                            
                              </li>
                          </ul>
          
                          </div>
                                          

                    </div>

    </section>
    <p class='animate__animated animate__flash animate__infinite animate__delay-5'>Check availability <a href='./rooms.php' type='_blank'>here</a> </p>
</div>
<hr>
<div id='contactUs'class='contactUs section'>
  <p id="hTitle">contact us</p>
  <p id='contactus_comments' class='w-75 '> 
  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus dolor voluptates praesentium error nemo, iusto beatae id doloremque quidem culpa quisquam! Alias ab dolore laborum! Tenetur earum blanditiis illum ducimus?
  </p>
  <div  id='form_wrap'>
      <button type="button" id="btnEmail" onclick="displayform()" class="btn btn-primary" ><i class="bi bi-envelope-at"></i>
    sent an e-mail</button>
          <div class="" id='emailform'  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                
                          <div id="outerWrapperMessageF">
                                <center>  
                                    <h1 class="fs-5" id="exampleModalLabel"><i class="bi bi-envelope-at"></i> &nbsp;leave your message</h1>
                                  </center>
                                  
                                        <form class='contact-us_form needs-validation' method='POST' id="usrform" action='./conn/email.php' novalidate>
                                            <div class="mb-3">
                                              <label for="User-name" class="col-form-label">User</label>
                                                <input type="text" class="form-control" name="email" value=<?php echo $_SESSION['email'] ?> id="User-name" placeholder='email'>
                                            </div>
                                        
                                            <div class="valid-feedback">
      Looks good!
    </div> <div class="invalid-feedback">
    Please, try not to use characters .
      </div>
                                     
                                    
                                
                                  <div class="m-3">
                                    <button type="button" class="btn btn-secondary" onclick="hideform()" data-bs-dismiss="modal"><i class="bi bi-x"></i></button>
                                    <button type="button" id="sentBtn"  class="btn btn-primary"><i class="bi bi-send-fill"></i></button>
                                  </div>
                                  </form>
                                  <div class="mb-3 ">
                                              <label for="message-text" class="col-form-label">Message</label>
                                              <textarea id="commentL" name="msg" class="form-control" maxlength="250" form="usrform" id="message-text"></textarea>
                                            </div>
                        </div>
               
          </div>

</div>
<br>
<br>
    <div class='contact'><h5><i class="bi bi-telephone-fill"></i> &nbsp; </h5> <p>4142874982</p></div><br>
    <div class='contact'><h5><i class="bi bi-geo-alt-fill"></i>  &nbsp;</h5> <p>Lorem Ipsom 235, akda</p></div><br>

</div>
<?php echo  $_SERVER['SCRIPT_URI'];;?>

<div id="map">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3143.177275489571!2d23.812956811669984!3d38.01964647180757!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14a1990431a511f7%3A0x43e1200cfdf17c5f!2sLorem%20Ipsum%20Press!5e0!3m2!1sen!2sgr!4v1689773856736!5m2!1sen!2sgr" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>

  </main>

  <?php include_once "./extra/footer.php";?>
  
  <script src='./js/app.js' ></script>
<script src='./js/loader.js'></script>
<script src='./js/mouse.js' ></script>

</body>
</html>

<?php

}else{
    header('Location:index.php');
    exit();
}
?>
