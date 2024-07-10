<?php

include "userDashboard-logic.php";
$title = "Dashboard";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="120">
    <title><?= $title ?> | Hostel Booking Website</title>
    <link rel="stylesheet" href ="style.css">
</head>
<body>
    <header>
   <!-- the title of the web page -->
        <nav class="head-container noRadius">
            <h1>Dashboard | Welcome <?= $userName?>!</h1>
            <div class="username-con">
                <a href="hostels.php" class="btn">Hostels</a>
                <a href="userDashboard.php" class="btn">Go to Dashboard</a>
                <a href="index.php?id=<?= $_SESSION['user-id']?>" class="btn">Logout</a>
            </div>
            
            
        </nav>

        

    </header>
