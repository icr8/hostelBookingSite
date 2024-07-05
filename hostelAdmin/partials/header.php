<?php
    include'./hostelManagerDashboardLogic.php';

    //Display the name of the hostel
$query = "SELECT hostelName FROM hostels WHERE hostelId = '$hostelId'";
$result = mysqli_query($connection, $query);
$hostelNam = mysqli_fetch_assoc($result);
$hostelName = $hostelNam['hostelName'];


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="120"> -->
    <title><?= $hostelName ?> Dashboard | Hostel Booking Website</title>
    <link rel="stylesheet" href ="/style.css">
</head>
<body>


    <header>
    <!-- the title of the web page -->
        <nav class="head-container noRadius">
            <h1 id="pageTitle">Dashboard | <?= $hostelName ?> </h1>
            <div class="username-con">
                <a href="/logout.php" class="btn">Logout</a>
            </div>
            
            
        </nav>

        <div class="navButtons">
            
            <center><a id="dashboard" href="hostelManagerDashboard.php" class="btn">Dashboard</a>
                
            <a id="approved" href="approved.php" class="btn">Admitted </a>
                <a id="archive" href="archive.php" class="btn">Archive</a>
                <a id="settings" href="settings.php" class="btn">Settings</a>
                </center>
            
        </div>

    </header>

    <script defer src="../action.js"></script>
