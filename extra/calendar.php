<?php



function Calendar($m,$y){
    session_start();

if(
    isset($_SESSION['id'])&&
    isset($_SESSION['password'])&&
    isset($_SESSION['email'])){

$id = $_SESSION['id'];
$email = $_SESSION['email'];
$url .=  $_SERVER['REQUEST_URI'];


    if(preg_match("/(Room_Athens|Room_Aegean)/",$url,$match)){
        $room = $match[0];
       $_SESSION['roomName']= $room;
      
    }

  
    if(preg_match("/[\d]{4}$/",$url,$match)){
  
            $y = $match[0];
            $_SESSION['year']= $y;
            $y=$_SESSION['year'];
       
            $_SESSION['year']= $y;
            }
        


        
        if(preg_match("/(?<=m=)\d{1,2}/",$url,$ma)){
           
             $m = $ma[0];
            $m = str_pad($m, 2, '0', STR_PAD_LEFT); 
        
            $_SESSION['month']= $m;
            $m = $_SESSION['month'];
               
        }
        
        if($m == 13){
            $_SESSION['month']=01;
            $m= 01;
            $_SESSION['year']=$y+1;
            $y = $y+1;
           }
        
    

 
    $room = $_SESSION['roomName'];

    $thisMonth = date('m');
    $thisYear = date('Y');


    //----------------------------------------------------- mysql
       //-----------------------------------------------------mysql

    require_once '../conn/db_connection.php';
    $sql = "SELECT * FROM bookings  WHERE RoomName='$room'";

    $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

    $rows = mysqli_num_rows($result);
        
    $daysRow=[]; /*<-- day in and total days of staying ex [[[1/1/2021],[4]]] */
    $daysBooked =[];/*<--all dates of staying*/

    if($rows > 0){
        $rowcount = mysqli_num_rows($result);
   
            while($row = mysqli_fetch_array($result)){
            if($row['RoomName'] == $room){
                        
           $bookingId = $row['bookingId'];
 if($row['dayOut'] > date('Y-m-d')){
   
            
                    $new = array($row['dayIn'],$row['totalDays']);
                
               
                    array_push($daysRow,$new);

                }
            
            }
            
    }
}


/*creating an array with all the booked dates ex.[1/1/2021,1/2/2021,1/3/2021,1/4/2021].*/

    for($i=0;$i<count($daysRow);$i++){
       
        $add=0; /*<--- counting days*/
        for($j=0;$j<=$daysRow[$i][1];$j++){

            $k = $daysRow[$i][0];
        
   
           
        array_push($daysBooked, date('Y-m-d',strtotime($k.'+'.$add.'days')));
            $add++;
        }
       
        
    }

 



$wdays=array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
$date = $y."-".$m."-".'01';

// first weekday of this month
$fday =  date('l', strtotime($date));
$fday = array_search($fday,$wdays);

// ----- how many days in month?
$numOfdays = cal_days_in_month(CAL_GREGORIAN, $m, $y); 

// last wday of month
$last_wdate = date('l', strtotime($y."-".$m."-".$numOfdays));
$last_wdate = array_search($last_wdate,$wdays);
$last_wdate= $last_wdate;



//weekdays 

foreach($wdays as $i){
    $days .="<td class='wd'><center>".$i.'</center></td>'; 
   
}


// .....................................................................................................


// Making the calendars body:

// .....................................................................................................




$daysCount =1;

for($i=1;$i<=$numOfdays;$i++){

 
  
    if($i == 1){
        $weeks .="<tr>";
    }
    if($fday+1> $i ){
        
        $weeks .="<td class='day blank'>".'<center>'."".'</center>'.'</td>';
        $numOfdays++;
    }
    
    if($fday+1 == $i ){
      
        if(in_array(date('Y-m-d',strtotime($y.'-'.$m.'-'.$daysCount)),$daysBooked)){
            $weeks .="<td class='day booked'>".'<center>'.date('d',strtotime($daysCount.'-'.$m.'-'.$y)).'</center>'.'</td>';
        }else{
            $weeks .="<td class='day'>".'<center>'.date('d',strtotime($daysCount.'-'.$m.'-'.$y)).'</center>'.'</td>';
        }
     
    }

    if($fday+1 < $i){
        ++$daysCount;

        if(in_array($y.'-'.$m.'-'.$daysCount,$daysBooked)){
      
            $weeks .="<td class='day booked'>".'<center>'.date('d',strtotime($daysCount.'-'.$m.'-'.$y)).'</center>'.'</td>';
        }else{
            $weeks .="<td class='day'>".'<center>'.date('d',strtotime($daysCount.'-'.$m.'-'.$y)).'</center>'.'</td>';
        }


    }
    
    if($i > $numOfdays){
        break;
    }

    if($i%7 ==0){
        $weeks .="</tr>";
    }



}   


        switch ($m) {

        case 1:
        $months = "January";
        break;
        case 2:
        $months = "February";
        break;
        case 3:
        $months = "March";
        break;
        case 4:
        $months = "April";
        break;
        case 5:
        $months = "May";
        break;
        case 6:
        $months = "June";
        break;
        case 7:
        $months = "July";
        break;
        case 8:
        $months = "August";
        break;
        case 9:
        $months = "September";
        break;
        case 10:
        $months = "October";
        break;
        case 11:
        $months = "November";
        break;
        case 12:
        $months = "December";
        break;
        }
  

$titleMoth = "<center><p class='hTitle' id='monthTitle'><div id='month'>".$months."</div><span id='year'>".$y."</span> </p></center>";


$backMonth = date('m',mktime(0,0,0,$m-1,1,$y));
$backYear = date('Y',mktime(0,0,0,$m-1,1,$y));

$container .= $titleMoth."<div id='calendar' ><nav class='navCalendar'><button id='btn_x_calendar' class='btn btn-sm btn-primary m-3' onclick='window.close()' name='closeBtn' href='rooms.php'><p title='close'>";
$container .= '<svg xmlns=" http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">';
$container .=  '<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>';
$container .=  '<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>';
$container .="</svg> </p></button>";
$container .=  "<a class='btn btn-primary' id='nowBtbCal' href='./calendar.php?".$_SESSION['roomName'].'?m='.$thisMonth.'?y='.$thisYear."'>"."Now"."</a>";
$container .=  "<div id='navBtn'><center><a class='btn btn-light'  href='./calendar.php?".$_SESSION['roomName'].'?m='.$backMonth.'?y='.$backYear."'>"."back"."</a>";
$container .="<a class='btn btn-light' onclick='plus()' href='./calendar.php?".$_SESSION['roomName'].'?m='.(++$m).'?y='.($y)."'>"."next"."</a></div></center>";
$container .="</nav><table class='tableCalendar'><tr>". $days."</tr>".$weeks."</table></div>";

}else{
    header('Location:../index.php');
    exit();
}



return $container;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel='stylesheet' href='../styles.css'>
    <link rel='stylesheet' href='../assets/loader.css'>


    <title>Document</title>
</head>
<body>
   
<?php 
 session_start();



if($_SESSION['month']!=''&& $_SESSION['year']!=''){
    $m= $_SESSION['month'];
    $y= $_SESSION['year'];
}else{
    $m=date('m',strtotime('now'));
    $y=date('y',strtotime('now'));
}



echo Calendar($m,$y);


?>

</div>

<p class="p-3" id="msgCalendar">To make a reservation click <a href="../home.php#bookform" target='_blank'>here</a></p>

</body>
</html>

