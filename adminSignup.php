<?php

require "config/constants.php";

//get back form data if there was a registration error
$fullName1 = $_SESSION['signup-data']['fullName'] ?? null;
$username1 = $_SESSION['signup-data']['username']?? null;
$email1 = $_SESSION['signup-data']['email'] ?? null;
$gender1 = $_SESSION['signup-data']['gender']?? null;
$password1 = $_SESSION['signup-data']['password'] ?? null;
$confirmpassword1 = $_SESSION['signup-data']['confirmPassword'] ?? null;
$hostelName1 = $_SESSION['signup-data']['hostelName'] ?? null;
$hostelDistance1 = $_SESSION['signup-data']['hostelDistance'] ?? null;
$hostelLocation1 = $_SESSION['signup-data']['hostelLocation'] ?? null;
$hostelBeds1 = $_SESSION['signup-data']['hostelBeds'] ?? null;
$number11 = $_SESSION['signup-data']['number1'] ?? null;
$names11 = $_SESSION['signup-data']['names1'] ?? null;
$price11 = $_SESSION['signup-data']['price1'] ?? null;
$number21 = $_SESSION['signup-data']['number2'] ?? null;
$names21 = $_SESSION['signup-data']['names2'] ?? null;
$price21 = $_SESSION['signup-data']['price2'] ?? null;
$number31 = $_SESSION['signup-data']['number3'] ?? null;
$names31 = $_SESSION['signup-data']['names3'] ?? null;
$price31 = $_SESSION['signup-data']['price3'] ?? null;
$number41 = $_SESSION['signup-data']['number4'] ?? null;
$names41 = $_SESSION['signup-data']['names4'] ?? null;
$price41 = $_SESSION['signup-data']['price4'] ?? null;
$maleRooms1 = $_SESSION['signup-data']['maleRooms'] ?? null;
$femaleRooms1 = $_SESSION['signup-data']['femaleRooms'] ?? null;

$picture11 = $_SESSION['signup-data']['picture1'] ?? null;
$picture21 = $_SESSION['signup-data']['picture2'] ?? null;
$picture31 = $_SESSION['signup-data']['picture3'] ?? null;
$picture41 = $_SESSION['signup-data']['picture4'] ?? null;
$picture51 = $_SESSION['signup-data']['picture5'] ?? null;
$picture61 = $_SESSION['signup-data']['picture6'] ?? null;

$hostelPhone1 = $_SESSION['signup-data']['hostelPhone'] ?? null;
$passKey1 = $_SESSION['signup-data']['passKey'] ?? null;
//delete signup data session
unset($_SESSION['signup-data']);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Signup</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    

<div class="signup-con">

<form action="adminSignup-logic.php" enctype="multipart/form-data" method="POST">

    <center>
    <h1>HOSTEL SIGNUP</h1>
   

    <?php if(isset($_SESSION['signup-success'])) : ?>
        <div class="message success ">
          <p>
          <?= $_SESSION['signup-success'];
              unset($_SESSION['signup-success'])
          ?>
          </p>
        </div>
      
        <?php elseif (isset($_SESSION['signup'])) : ?>
          <div class="message error ">
          <p>
          <?= $_SESSION['signup'];
              unset($_SESSION['signup']);
          ?>
          </p>
        </div>
        <?php endif ?>

    <fieldset>
        <legend>Account Info</legend>
        <input class="fin" type="text" id="fullName" name="fullName" value="<?=$fullName1?>" placeholder="Full name"><br>
        <input class="fin" type="text" id="username" name="username" value="<?=$username1?>" placeholder="Username"><br>
        <input class="fin" type="email" id="email" name="email" value="<?=$email1?>" placeholder="example@gmail.com"><br>
        <label for="male"><input class="fin5" type="Radio" id="male" name="gender"<?php if($gender1 =="male") : ?> checked <?php else :  endif?> value= "male" >Male</lable> <label for="female"><input type="Radio"class="fin5" id="female" name="gender" <?php if($gender1 =="female") : ?> checked <?php else :  endif?> value="female"> Female</lable> <br>
        <input class="fin" type="password" id="password" name="password" value="<?=$password1?>" placeholder="Password"><br>
        <input class="fin" type="password" id="confirmPassword" name="confirmPassword" value="<?=$confirmpassword1?>" placeholder="Confirm Password"><br>
    </fieldset>

    <fieldset class="formCon column">
        <legend>Hostel Info</legend>
        <label for="hostelName">Hostel Name:</label><br>
        <input class="fin" class="inputFields" id="hostelName" name="hostelName" value="<?=$hostelName1?>" type="text" placeholder="Enter hostel name..."/><br>

        <label for="hostelDistance">Hostel Distance:</label><br>
        <input class="fin" class="inputFields" id="hostelDistance" name="hostelDistance" value="<?=$hostelDistance1?>" type="text" placeholder="Enter hostel Distance..."/><br>

        <label for="hostelLocation">Hostel Location:</label><br>
        <input class="fin" class="inputFields" id="hostelLocation" name="hostelLocation" value="<?=$hostelLocation1?>" type="text" placeholder="Enter Location..."/><br>

        <label for="hostelBeds">Total Number of Beds:</label><br>
        <input class="fin" class="inputFields" id="hostelBeds" name="hostelBeds" value="<?=$hostelBeds1?>" type="text" placeholder="Enter Total No of Beds..."/><br>

    </fieldset>

    <fieldset class="formCon column">
        <legend>Room Info</legend>
        <label for="number1">How many Rooms are 1 IN A ROOM:</label><br>
        <input class="fin" class="inputFields" id="number1" name="number1" value="<?=$number11?>" type="text" placeholder="Enter Number of rooms..."/><br>
        <label for="names1">Enter Room Names for all 1 IN A ROOM:</label><br>
        <input class="fin" class="inputFields" id="names1" name="names1" value="<?=$names11?>" type="text" placeholder="01,02,03,04......"/><br>
        <label for="price1">Enter Price 1 IN A ROOM:</label><br>
        <input class="fin" class="inputFields" id="price1" name="price1" value="<?=$price11?>" type="text" placeholder="0000.00"/><br>


        <hr>
        <label for="number2">How many Rooms are 2 IN A ROOM:</label><br>
        <input class="fin" class="inputFields" id="number2" name="number2" value="<?=$number21?>" type="text" placeholder="Enter Number of rooms..."/><br>
        <label for="names2">Enter Room Names for all 2 IN A ROOM:</label><br>
        <input class="fin" class="inputFields" id="names2" name="names2" value="<?=$names21?>" type="text" placeholder="01,02,03,04..."/><br>
        <label for="price2">Enter Price for 2 IN A ROOM:</label><br>
        <input class="fin" class="inputFields" id="price2" name="price2" value="<?=$price21?>" type="text" placeholder="0000.00"/><br>



        <hr>
        <label for="number3">How many Rooms are 3 IN A ROOM:</label><br>
        <input class="fin" class="inputFields" id="number3" name="number3" value="<?=$number31?>" type="text" placeholder="Enter Number of rooms..."/><br>
        <label for="names3">Enter Room Names for all 3 IN A ROOM:</label><br>
        <input class="fin" class="inputFields" id="names3" name="names3" value="<?=$names31?>" type="text" placeholder="01,02,03,04......"/><br>
        <label for="price3">Enter Price for 3 IN A ROOM:</label><br>
        <input class="fin" class="inputFields" id="price3" name="price3" value="<?=$price31?>" type="text" placeholder="0000.00"/><br>


        <hr>
        <label for="number4">How many Rooms are 4 IN A ROOM:</label><br>
        <input class="fin" class="inputFields" id="number4" name="number4" value="<?=$number41?>" type="text" placeholder="Enter Number of rooms..."/><br>
        <label for="names4t">Enter Room Names for all 4 IN A ROOM:</label><br>
        <input class="fin" class="inputFields" id="names4" name="names4" value="<?=$names41?>" type="text" placeholder="01,02,03,04......"/><br>
        <label for="price4">Enter Price for 4 IN A ROOM:</label><br>
        <input class="fin" class="inputFields" id="price4" name="price4" value="<?=$price41?>" type="text" placeholder="0000.00"/><br>

        
        <hr>
        <label for="maleRooms">List the names of Rooms that are for Males:</label><br>
        <input class="fin" class="inputFields" id="maleRooms" name="maleRooms" value="<?=$maleRooms1?>" type="text" placeholder="01,02,03,04..."/><br>

        <label for="femaleRooms">List the names of Rooms that are for Females:</label><br>
        <input class="fin" class="inputFields" id="femaleRooms" name="femaleRooms" value="<?=$femaleRooms1?>" type="text" placeholder="01,02,03,04..."/><br>
        

    </fieldset>

    <fieldset class="formCon column">
        
        <legend>PHOTOS</legend>

        <label for="picture1">Picture 1:</label><br>
        <div class="picFrame"  >
        <input class="picture" id="picture1" name="picture1" value="<?=$picture11?>" type="file" alt="Hostel Picture 1">
        </div>

        <label for="picture2">Picture 2:</label><br>
        <div class="picFrame"  >
        <input class="picture" id="picture2" name="picture2" value="<?=$picture21?>" type="file" alt="Hostel Picture 2">
        </div>

        <label for="picture3">Picture 3:</label><br>
        <div class="picFrame"  >
        <input class="picture" id="picture3" name="picture3" value="<?=$picture31?>" type="file" alt="Hostel Picture 3">
        </div>

        <label for="picture4">Picture 4:</label><br>
        <div class="picFrame"  >
        <input class="picture" id="picture4" name="picture4" value="<?=$picture41?>" type="file" alt="Hostel Picture 4">
        </div>

        <label for="picture5">Picture 5:</label><br>
        <div class="picFrame" >
        <input class="picture" id="picture5" name="picture5" value="<?=$picture51?>" type="file" alt="Hostel Picture 5">
        </div>

        <label for="picture6">Picture 6:</label><br>
        <div class="picFrame"  >
        <input class="picture" id="picture6" name="picture6" value="<?=$picture61?>" type="file" alt="Hostel Picture 6">
        </div>

    </fieldset>
                                           
                            
     <fieldset class="formCon column">

        <legend>Contact Info</legend>
        <label for="hostelPhone">Phone:</label><br>
        <input class="fin" class="inputFields" id="hostelPhone" name="hostelPhone" value="<?=$hostelPhone1?>" type="text" placeholder="+233 000 000 0000"/>


    </fieldset>

    <fieldset class="formCon column">

        <br>
        <label for="passKey">Enter Secret Passkey:</label><br>
        <input class="fin" class="inputFields" id="passKey" name="passKey" value="<?=$passKey1?>" type="password" placeholder="0000000000"/>


    </fieldset>

    <input id="sbutt2" type="submit" name="registerAdmin" value="Submit">

    </center>

</form>

</div>




</body>



























</html>