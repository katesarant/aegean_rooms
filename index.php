<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel='stylesheet' href='./styles.css'>
    <link rel="stylesheet" href="./assets/loader.css">
    <title>Document</title>

</head>
<?php include_once './extra/loader.php'?>
<body class='bodySighLogIn'>

<header>
<div class='wrap_cycle'><p id='insiteCycle'>hello</p></div>
 <div class='logo'><p id="hTitle">Hotels Group</p></div>

 </header>
<form  class='sighLogIn_form' action="./conn/login.php" method="post" class='container-sm'>
<p id="hTitle">LOGIN</p>
<?php if(isset($_GET['error'])){?>
    <p class='error'><?php echo $_GET['error']; ?> </p>
<?php }?>


<div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label ">Email</label>
    <div class="col-sm-10">
      <input type="email"  name="email" class="form-control" id="staticEmail" >
    </div>
  </div>
  <div class="mb-3 row">
    <label for="pwTest" class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-10">
      <input type="password" name="password" class="form-control" id="pwTest" >
    </div>

  </div>

  <center>
    <button  type='submit'class='btn btn-primary'>submit</button>
  </center>
  <br>
  <span>Don't have an account? <a href="./sigh_in.php">sigh in</a>
  here</span> 
</form>
<?php
    include_once './extra/footer.php';
    ?>

<script src='./js/mouse.js'></script>
<script src='./js/loader.js'></script>  
</body>

</html>