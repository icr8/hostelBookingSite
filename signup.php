<?php

require "config/constants.php";

//get back form data if there was a registration error
$firstName1 = $_SESSION['signup-data']['firstName'] ?? null;
$lastName1 = $_SESSION['signup-data']['lastName'] ?? null;
$username1 = $_SESSION['signup-data']['username']?? null;
$email1 = $_SESSION['signup-data']['email'] ?? null;
$gender1 = $_SESSION['signup-data']['gender']?? null;
$password1 = $_SESSION['signup-data']['password'] ?? null;
$confirmpassword1 = $_SESSION['signup-data']['confirmPassword'] ?? null;
//delete signup data session
unset($_SESSION['signup-data']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    

   <div class="signup-con">
<center>
    <h1> SIGNUP</h1>

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

    <form action= "signup-logic.php" method = "POST">
        <p>
            <input class="fin" type="text" id="firstName" name="firstName" value="<?=$firstName1?>" placeholder="First name"><br>
            <input class="fin" type="text" id="lastName" name="lastName" value="<?=$lastName1?>" placeholder="Last name"><br>
            <input class="fin" type="text" id="username" name="username" value="<?=$username1?>" placeholder="Username"><br>
            <input class="fin" type="email" id="email" name="email" value="<?=$email1?>" placeholder="example@gmail.com"><br>
            <label for="male"><input class="fin5" type="Radio" id="male" name="gender"<?php if($gender1 =="male") : ?> checked <?php else :  endif?> value= "male" >Male</lable> <label for="female"><input type="Radio"class="fin5" id="female" name="gender" <?php if($gender1 =="female") : ?> checked <?php else :  endif?> value="female"> Female</lable> <br>
            <input class="fin" type="password" id="password" name="password" value="<?=$password1?>" placeholder="Password"><br>
            <input class="fin" type="password" id="confirmPassword" name="confirmPassword" value="<?=$confirmpassword1?>" placeholder="Confirm Password"><br>

        </p>
        <p> Read all <a  href="#">terms and condition</a>. Submitting means you agree to the terms and condition for this registration.<br>

        <!-- <input id="agr" type="checkbox" >I Agree <br> -->

        </p>

        <input id="sbutt2" type="submit" name="registerUser" value="Submit">

    </form>

</center>
       

</div>


















</body>



























</html>