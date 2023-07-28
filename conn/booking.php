<?php
session_start();
require_once './db_connection.php';

  

if(
   isset($_POST['RoomName']) &&
   isset($_POST['adults'])&&
   isset($_POST['childrenNo'])&&
   isset($_POST['checkin'])&&
   isset($_POST['checkout'])&&
   isset($_POST['price'])){

   

 

    function validate($data){

       $data = trim($data);

       $data = stripslashes($data);

       $data = htmlspecialchars($data);
       $data = $data;

       return $data;

    }




/*continue making. =====> check if the date is already booked*/    

$id =$_SESSION['id'];
$email = $_SESSION['email'];
$Room = validate($_POST['RoomName']);
$adults = validate($_POST['adults']);
$children =validate($_POST['childrenNo']);
$checkIn = validate($_POST['checkin']);
$checkout = validate($_POST['checkout']);
$date_booked = date('Y-m-d');
$totalPrice = validate($_POST['price']);



// calculating days of staying
$datetime1 = strtotime($checkIn);
$datetime2 = strtotime($checkout);
$secs = $datetime2 - $datetime1;// == return sec in difference
// if days == 1 then days == 2 else $secs / 86400;
$days =( $secs / 86400 <=1)?1: $secs / 86400;




// -----------------------check if the date already booked-start
date('Y-m-d',strtotime($checkIn.'+'.$i.'days'));
// 
$sql = "SELECT * FROM bookings";
$check = TRUE;
$result = mysqli_query($conn, $sql);
$rows = mysqli_num_rows($result);


  if($rows > 0){
   
    while($row = mysqli_fetch_array($result)){
      if($Room == $row['RoomName']){

    
        if($row['dayIn']>= $checkIn){
            for($i=0;$i<= $days;$i++){
                echo date('Y-m-d',strtotime($checkIn.'+'.$i.'days'))."<br>";
              for($j=0;$j<= $row['totalDays'];$j++){
                if( date('Y-m-d',strtotime($checkIn.'+'.$i.'days')) == date('Y-m-d',strtotime($row['dayIn'].'+'.$j.'days'))){
                 
                  break;   
                }
                break;   
                
              }
              break;
            }
            $check=FALSE;
                 

          }
      };


}
}

if(!$check){
  // /success booking Msg/
  echo ' <script>window.open("../extra/fail.php", "_blank", "toolbar=no,menubar=no,scrollbars=no,resizable=no,top=500,left=500,width=500,height=500");</script>';
  echo ' <script>window.location.replace("../home.php");</script>';

}else{
  // /success booking/
  $sql2= "INSERT INTO bookings (userID, email,date_booked, RoomName, adults, children, dayIn, dayOut, totalDays, totalPrice)
 VALUES ( '$id', '$email','$date_booked', '$Room', '$adults', '$children', '$checkIn', '$checkout', '$days', '$totalPrice')";


if ($conn->query($sql2) === TRUE) {

 /* the cookie is for user message ("Location:../extra/sub.php")  */
   $cookie_name='booking';
   $value = 'true';
   setcookie($cookie_name,$value,time() + 10,"/");
  
   header("Location: ../profile.php#bookings?booking=success");

 } else {
   echo "Error: " . $sql . "<br>" . $conn->error;
 }
}

 $conn->close();


 };
 

?>