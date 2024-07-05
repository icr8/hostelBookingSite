<?php
include'./partials/header.php';



?>
<body>
    

<div class="signup-con">



    <center>
        <h1>Change Password</h1>

        <?php if(isset($_SESSION['password-success'])) : ?>
        <div class="message success ">
          <p>
          <?= $_SESSION['password-success'];
              unset($_SESSION['password-success'])
          ?>
          </p>
        </div>
      
        <?php elseif (isset($_SESSION['password-error'])) : ?>
          <div class="message error ">
          <p>
          <?= $_SESSION['password-error'];
              unset($_SESSION['password-error'])
          ?>
          </p>
        </div>
        <?php endif ?>

        <form action="changePassword-logic.php" method="POST">
        
            <input class="txt"  type="password" name="oldPassword" placeholder="Old Password"><br>
            <input class="txt" type="password" name="newPassword" placeholder="New Password"><br>
            <input class="txt" type="password" name="confirmPassword" placeholder="Confirm Password"><br>
            <input class="btn" id="changeBtn" type="submit" name="changePassword" value="Submit">
        </form>

    </center>

    

    


</div>


</body>


</html>