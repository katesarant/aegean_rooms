
<?php
session_start();
if(
    isset($_SESSION['id'])&&
    isset($_SESSION['password'])&&
    isset($_SESSION['email'])

    ){
        $id = $_SESSION['id'];
     


    if(isset($_COOKIE["booking"])){
      echo ' <script>window.open("./extra/sub.php", "_blank", "toolbar=no,menubar=no,scrollbars=no,resizable=no,top=500,left=500,width=500,height=500");</script>';
    }
 
   
?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
            
            <title>Profile</title>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
            <link rel='stylesheet' href='./styles.css'>
            <link rel="stylesheet" href="./assets/loader.css">
       
        </head>
        <?php include_once './extra/loader.php'?>
        <body>
        <?php include_once './extra/header.php'?>
          
  
<main>

        <!-- Personal Info start -->

        <form class="form_profile" action='conn/uploadAvatar.php' method="POST" enctype="multipart/form-data">
                        <h4>Add your personal info</h4></br>
                        <div id='profile_pic mb-3 row'>

        <?php

        require_once './conn/db_connection.php';
        $sql = "SELECT firstName,lastName,phone,created_cartNo,profile_pic FROM users WHERE id= $id ";
        $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
        $row = mysqli_fetch_array($result);


        $first = (!empty($row['firstName']))?$row['firstName']:'First Name';
        $last = (!empty($row['lastName']))?$row['lastName']:'Last Name';
        $phone = (!empty($row['phone']))?$row['phone']:'10xxxx';
        $createdCart = (!empty($row['created_cartNo']))?$row['created_cartNo']:'16xxxx';
        $picture =(empty($row["picture"])?"https://cdn-icons-png.flaticon.com/512/847/847969.png?w=826&t=st=1686500067~exp=1686500667~hmac=1b236537ec17eef064cd113483f51853824c9f33e1471640349c8d5bb2d8377b":'./assets/avatar/'.$row['profile_pic']);
// --------------------------------------------------------avatar
$arr = scandir(__DIR__."/assets/avatar/");


//check if the pic in the folder is the same as the dbase photo.
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
$_SESSION['picture']=$picture;
$picture=$_SESSION['picture'];
        ?>

        <img id="profileAvatar"  src=<?php echo $_SESSION['picture']?> alt="avatar_picture">
    <!-- avatar-------------------------------------------------------- -->
                            <div id='imgBtn_wrapper'class="imgBtn_wrapper col-sm-10" >
                                <input type="file" id='imgInput' class="form-control form-control-sm" value=''  name="avatar_pic" >
                                <button id='uploadbtn' type='button' name="uploadfile" class="btn btn-primary btn-sm">
                                Upload
                                </button>
                                <div id='x_icon'>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                        </svg>
                                </div>
                                <a class="link-danger deleteAvatar" href='./conn/delete_avatar.php'> delete</a>
                            </div>
                  
                        </div>
                        
        </form>   
  

        <form  class='personalInfo' action="./conn/update_profile.php"  method="POST">
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value=<?php echo $_SESSION['email']?>>
                                </div>
                        </div>
                    
                        <div class="mb-3 row">
                            <label for="Firstname " class="col-sm-2 col-form-label">Firstname</label>
                                <div class="col-sm-10">
                                    <input id='Firstname' name="Firstname" class="form-control personalInfoItem" pattern="[A-Za-z]{2,}" type="text" value="" placeholder=<?php echo $first?> aria-label="first_name" >
                                    
                                </div>
                                
                            <label for="Lastname" class="col-sm-2 col-form-label" >Lastname</label>
                                <div class="col-sm-10">
                                    <input id='Lastname' name="Lastname" class="form-control personalInfoItem"  pattern="[A-Za-z]{2,}" type="text" value="" placeholder=<?php echo $last?> aria-label="last_name" >
                                    
                                </div>
                    
                            <label for="Phone" class="col-sm-2 col-form-label">Phone.No</label>
                                <div class="col-sm-10">
                                    <input id="Phone" name="Phone" class="form-control personalInfoItem" pattern="[0-9]{10}" type="text" value='' placeholder=<?php echo $phone?> aria-label="fill your phone number" >
                                
                                </div>
                            <label for="createdCart" class="col-sm-2 col-form-label">createdCart</label>
                                <div class="col-sm-10">
                                <input id='createdCart' name="createdCart" class="form-control personalInfoItem" pattern="[0-9]{16}" type="text" value='' placeholder=<?php echo $createdCart?>  aria-label="createdCart" >
                                
                                </div>
                            
                        </div>
                        <div> <button  type="submit" disabled id='personalInfoBtn' class='btn btn-lg btn-primary'>ok</button></div>
        </form>  

        <form  id='deleteForm' method="post" action="./conn/delete_profile.php">
            <p> delete profile</p>
            <button  name="delete" class="btn btn-danger btn-sm">
                submit
            </button>
        </form>
                                <hr>    
            <!-- Personal Info ends --> 


  <!-- Bookings Table start--> 


        <?php

        require_once './conn/db_connection.php';
        $sql = "SELECT * FROM bookings WHERE userID=$id";
        $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
        $rows = mysqli_num_rows($result);
      
        if($rows > 0){

                while($row = mysqli_fetch_array($result)){

         $datein=date("d-m-y",strtotime($row['dayIn']));    
         $dateOut =date("d-m-y",strtotime($row['dayOut']));   
         $date_booked =date("d-m-y",strtotime($row['date_booked']))     ;   
         $delete=$row['bookingId'];          

    $body .=   '<tbody class="btable"><tr ><th class="bookingItem" scope="row">'.$row['bookingId'].'</th><td class="bookingItem bDate">'.$date_booked .'</td>';
    $body .=   '<td class="bookingItem">'.$row['email'].'</td><td class="bookingItem">'.preg_replace('/[^A-Za-z0-9\-]/', ' ', $row['RoomName'])."</td>";
    $body .=   '<td class="bookingItem">'.$row['adults'].'</td><td class="bookingItem">'.$row['children']."</td><td class='bookingItem bDate'>".  $datein.'</td><td class=" bookingItem bDate">'.$dateOut.'</td>';
    $body .=   '<td class="bookingItem">'.$row['totalDays'].'</td><td  class="costWrap bookingItem class="bookingItem">'.$row['totalPrice'].'<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-currency-euro bookingItem" viewBox="0 0 16 16">
    <path d="M4 9.42h1.063C5.4 12.323 7.317 14 10.34 14c.622 0 1.167-.068 1.659-.185v-1.3c-.484.119-1.045.17-1.659.17-2.1 0-3.455-1.198-3.775-3.264h4.017v-.928H6.497v-.936c0-.11 0-.219.008-.329h4.078v-.927H6.618c.388-1.898 1.719-2.985 3.723-2.985.614 0 1.175.05 1.659.177V2.194A6.617 6.617 0 0 0 10.341 2c-2.928 0-4.82 1.569-5.244 4.3H4v.928h1.01v1.265H4v.928z"/>
</svg></td><td><a href="./conn/deleteBooking.php?id='.$row['bookingId'].'"><button class="btn btnComplete">Delete</button></a><strong></td></tr></tbody>';

}
                    echo "<div id='bookings' class='bookingWrap'><h4>Booking table</h4><section id='booking_table'>";
                    echo "<div style='display:flex;'> <p>You have </p>&nbsp ".$rows." &nbsp<p> bookings so far. </p></div>";
                    echo '<div class="container commnets text-center">'."<div class='row row-cols-1 bookingTablewrap'>";
                    echo '<table class="table">';
                    echo '<thead><tr><th scope="col">bookingID</th><th scope="col">day booked</th> <th scope="col">Email</th>';
                    echo '<th scope="col">Destination</th><th scope="col">adults</th><th scope="col">children</th>';
                    echo '<th scope="col">Day In</th><th scope="col">Day Out</th><th scope="col">total days</th>';
                    echo '<th scope="col">total cost</th><th scope="col">delete booking </th></tr></thead>';
                    echo $body.'</table></div></section></div>';

                   


}else{
    print("<p class='hTitle'>You don't have any booking yet.</p>");
}

echo "</main>";
 include_once "./extra/footer.php";

// bookings end here

}else{
    header('Location:index.php');
    exit();
}

?>



<script src='./js/profilejs.js'></script>
    <script src='./js/app.js'></script>
    <script src='./js/mouse.js'></script>
    <script src='./js/loader.js'></script>  
</body>
</html>


