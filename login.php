<?php

require 'config/constants.php';

    $username_email = $_SESSION['signin-data']['username_email'] ?? null;
    $password = $_SESSION['signin-data']['password']?? null;

    //delete signin data session
    unset($_SESSION['signin-data']);


?>



<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>
   <link rel="stylesheet" href="style2.css">
</head>
<body>

   <div class="login-con">
   <center> 
    
    <h1>LOGIN</h1>
      <br> 
      <br>


      <?php if(isset($_SESSION['signup-success'])) : ?>
        <div class="message success ">
          <p>
          <?= $_SESSION['signup-success'];
              unset($_SESSION['signup-success'])
          ?>
          </p>
        </div>
      
        <?php elseif (isset($_SESSION['signin'])) : ?>
          <div class="message error ">
          <p>
          <?= $_SESSION['signin'];
              unset($_SESSION['signin'])
          ?>
          </p>
        </div>
        <?php endif ?>




      <form action="login-logic.php" method="POST">
        
        <input name="username_email" class="fin" type="text|email" placeholder="Username or Email" value="<?=$username_email?>"> <br>
        <input name="password" class="fin" type="password" placeholder="Password" value="<?=$password?>"><br>
        <input type="submit" id="sbutt" name="submit" value="Login"/><br><br>

      </form>

 <p> Don't have an account? <a href="signup.php">Register</a></p>

 <p id="lip"> BARA CREATIONS</p>

   </center>

</div>



    
</body>












</html>