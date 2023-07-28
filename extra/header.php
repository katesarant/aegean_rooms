<header id='goStart'>
  <div class='logo'><p id="hTitle">Aegean Apartments</p></div>
  <div id='user'> 
  <p>Hello,
        <img id="imgheader" alt='profile icon' src='<?php echo $_SESSION['picture'];?> '/>
        <span class="email"> <?php echo $_SESSION['email'] ?> </span></p>
    <ul id='userUl' class="dropdown-menu">
        <li><a href="./profile.php">Profile</a></li>
        <li><a href="./conn/logout.php">Logout</a></li>
        </ul>
        
  </div>
  <nav>
    <ul class='navList'>
    <li><a href="./home.php"> Home</a></li>
      <li><a href="./rooms.php"> Rooms</a></li>
      <li><a href="./home.php#AboutUs">About us</a></li>
      <li><a href="./home.php#contactUs">contact us</a> </li>

     
    </ul>
  </nav>

  <button class='btn btn-outline-info' id='goUp' ><a href="#goStart">Up</a></button>
</header> 