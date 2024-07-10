<?php



require "config/database.php";

if(isset($_GET['id'])){

$userId = $_GET['id'];
}else{

}



  $topHostelsQuery = "SELECT hostelId, hostelName, hostelLocation, hostelDistance FROM hostels WHERE  isTop = 1";
  $topHostelsResult = mysqli_query($connection, $topHostelsQuery);



  

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home | Book Hostel</title>
  <link rel="stylesheet" href="style2.css">
</head>

<body>
  <header>
    <div id="wrapper-div">
      <nav class="nav-bar">
        <img id="pic" src="pictures/pic.jpg" width="60px" height="60px" alt="logo">  
        
        <div class="menumain">
          <div class="menu" > 
            <button><img id="menuBtn" src="pictures/menu.png" width="50px" height="50px" alt="menu"></button>  
            <button><img id="closeBtn" src="pictures/close.png" width="40px" height="40px" alt="menu"></button>  
          </div>
        
          <?php if(isset($userId)) : ?>
          <div class="menulist">
            <a id="lif" href="index.php">Home</a>
            <a id="lif" href="SignUp.php">Signup</a>
            <a id="lif" href="userDashboard.php">Dashboard</a>
            <a id="lif" href="logout.php">Logout</a>
          </div>

          <?php else : ?>
          <div class="menulist">
            <a id="lif" href="index.php">Home</a>
            <a id="lif" href="SignUp.php">Signup</a>
            <a id="lif" href="gettingStarted.php">Login</a>
          </div>
          <?php endif ?>
        </div>
        
      </nav>
      <br>
      <P id="ITE">
        <strong> BOOK A HOSTEL</strong><br/>
        <p id="is"> select from over 200 hostels around <em style="color:#FFE500;">AAMUSTED <br>Kumasi Campus.</em> </p>
      </P><br>
      <center><a href="gettingStarted.php"><button id="btt"> GET STARTED</button></a></center>
    </div>
  </header>

<div id="area">
  <h3 id="are" >Top Hostels</h3>

  <?php while($topHostels = mysqli_fetch_assoc($topHostelsResult)) : ?>
  <div class="testimonials-container">

    <!-- card1 -->
   
    <div class="testimonial">

    <?php
      $hostelId = $topHostels['hostelId'];
      $imageQuery = "SELECT hostelPic1 FROM hostelpics WHERE hostelId = $hostelId";
      $imageResult = mysqli_query($connection, $imageQuery);
      $image = mysqli_fetch_assoc($imageResult);
    ?>

      <div class="cardImage">
        <img id="caro" src="pictures/<?= $image['hostelPic1'] ?>" width="300px" height="200px"  alt="Top Hostel Image">
      </div>


      <div class="CardDetails">

      <?php if(isset($topHostels)) : ?>
        <h3 class="hostelName"><?= $topHostels['hostelName'] ?></h3>
       
          <div class="inCard">
              <p class="author">LOCATION: </p>
              <p class="author value"><?= $topHostels['hostelLocation'] ?></p>
          </div>
          <div class="inCard">
              <p class="author">DISTANCE:</p>
              <p class="author value"><?= $topHostels['hostelDistance'] ?></p>
          </div>

      <?php else : ?>

        <h3 class="hostelName"></h3>
       
          <div class="inCard">
              <p class="author">LOCATION: </p>
              <p class="author value"></p>
          </div>
          <div class="inCard">
              <p class="author">DISTANCE:</p>
              <p class="author value"></p>
          </div>
      
      <?php endif ?>

        <?php
          
          $lowPriceQuery = "select price from room where hostelId = $hostelId AND roomType = 4";
          $lowPriceResult = mysqli_query($connection, $lowPriceQuery);
          $lowPrice = mysqli_fetch_assoc($lowPriceResult);

          $highPriceQuery = "SELECT price FROM room WHERE hostelId = $hostelId AND roomType = 1";
          $highPriceResult = mysqli_query($connection, $highPriceQuery);
          $highPrice = mysqli_fetch_assoc($highPriceResult);
        ?>


          <div class="inCard">
            
          <?php if(isset($highPrice,$lowPrice)) : ?>

              <p class="author">PRICE RANGE: </p>
              <p class="author value">GH&cent; <?= $lowPrice['price'] ?> - <?= $highPrice['price'] ?></p>
              <?php else : ?>
                <p class="author">PRICE RANGE: </p>
                <p class="author value">GH&cent; Unassigned - Unassigned</p>
              <?php endif ?>
          </div>
        
      </div>

    </div>
  




  </div>
    <!-- Add more testimonials as needed -->
    <?php endwhile ?>
  

</div>


<section class="main">

  <center>
  <h2> <b> Welcome, AAMUSTED Students!<br/>Your Ultimate Hostel Booking <br> Destination is here</h3>

  </p>
 <p id="p2">Our hostel booking website is your <br>gateway to hassle-free and affordable <br>accommodations tailored to the student experience.</p>

  <h2 ><h2>Hostel Availability</h2></p>

   <p id="p3"> we have <b>200+</b> hostels available to <br>choose from.Our hostels  also allows <br>one in a room,two in a room,three in <br> a room and four in a room.The hostels <br>also have all the facilities to make your <br>life better. Our system runs first come first served</p></center>
  <br>
</center>

<center>
  <p> <h2>Testimonials</h2></p>
      <img id="test" src="pictures/pic1 (1).jpg">
      <p id="name">  Mr. Adomako Micheal </p> <br/><br/><br/> &nbsp;&nbsp;&nbsp;&nbsp;
      <q>   Booking my hostel through this site was a game-changer.<br>The process was so easy and i found the perfect accommodation.</q><br>
    


    <img id="test1" src="pictures/pic1 (2).jpg">
    <p id="name">  Josphine Mensah </p><br/><br/><br/> &nbsp;&nbsp;&nbsp;&nbsp;
    <q>   Booking my hostel through this site was a game-changer.<br>The process was so easy and i found the perfect accommodation.</q><br>
   <br>
  <p id="hit"> <b> What are you waiting for, click on the<br> get started button to book now.</b>
    <br><br>
    <a href="gettingStarted.php"><button id="btt1"> GET STARTED</button></a> &nbsp;&nbsp;&nbsp;</p>
  
  </center>
    

</section>

<footer>

  <div id="foot">
    <center>
    <img id="tes" src="pictures/images.png" alt="facebook">&nbsp;&nbsp;&nbsp;&nbsp; 
    <img id="tes" src="pictures/images (1).png" alt="whatsapp">&nbsp;&nbsp;&nbsp;&nbsp; 
    <img id="tes" src="pictures/ins.jpeg" alt="Instagram"><br>
    <P id="con">   CONTACT US: </P>
    <p id="con1">  &nbsp;&nbsp;  0507864170 <br><br>&nbsp;&nbsp;&nbsp;&nbsp; barasolutions24@gmail.com</p>
     <br><br>&nbsp;&nbsp;&nbsp;&nbsp; 
     <p> BARA CREATIONS | <em id="con3"> &copy;COPYRIGHT</em></p>

  </center>

  </div>
</footer>


<script defer src="action.js"></script>

</body>



</html>