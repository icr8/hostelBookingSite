<?php
    require 'userDashboard-logic.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success Message | Hostel Booking Website</title>
    <link rel="stylesheet" href ="style.css">
</head>
<body>
    <main class="body-container">
        <div class="summary center">
            
            <p>You have successfully Booked a room from blessing hostel</p>
          
            <p class="checkEmail">Check your Email for your room details <br> or click</p>
            
        </div>
        <br>
        <center><a  class="btn makePayment bringTop" href="userDashboard.php" >Check Room Details at Dashboard</a></center>
        <div class="backNextContainer"><center><a href="index.php?id=<?= $_SESSION['user-id']?>" class="btn back">HOME</a></center></div>
    </main>

</body>
</html>