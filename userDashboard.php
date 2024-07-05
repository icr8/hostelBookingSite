<?php
    include "partials/header.php";
?>

<div class="navButtons">
            
            <center><a href="#profile" class="btn">Profile</a>
            <a href="#accommodation"  class="btn">Accommodation Status</a>
            <a href="#booking" class="btn">Booking History</a>
            <a href="index.php" class="btn">Home</a></center>
        
    </div>

    <main class="body-container">
        <div class="summary page-con">

            <!--Creating multiple layer for allthe dashboard pages instead of multiple
            webpage
            -->

            <div id="profile" class="layer profileLayer">
                <h2>Profile</h2>
                <center><div class="avatar">
                    <img src="pictures\student.png" alt="Profile Picture">
                </div>
                <h2><?= $userFullName ?></h2>
                <h3><?= $email?></h3>
                <h3>GENDER: <?= $gender ?></h3>

                </center>
            </div>
           
           
            <div id="accommodation" class="layer accomodationStatusLayer">
                <h2> Accommodation Status</h2>

                

                <div id="hostelDetails" class="hostelDetailsCon">

                <?php if(!isset($message)) : ?>

                   <div class="data">
                        <h5>Hostel Name:</h4>
                        <p><?= $hostelName ?></p>
                    </div> 
                    <div class="data">
                        <h5>Room Number:</h4>
                        <p><?= $roomName ?></p>
                    </div> 
                    <div class="data">
                        <h5>Room Type:</h4>
                        <p><?= $roomType ?></p>
                    </div> 
                    <div class="data">
                        <h5>Hostel Location:</h4>
                        <p><?= $hostelLocation ?></p>
                    </div> 
                    <div class="data">
                        <h5>Hostel Contact:</h4>
                        <p><?= $hostelContact ?></p>
                    </div> 
                    <div class="data">
                        <h5>Recipt Number:</h4>
                        <p><?= $receiptNumber ?></p>
                    </div>
                    <div class="data">
                        <h5>Reference:</h4>
                        <p><?= $reference ?></p>
                    </div>
                    <div class="data">
                        <h5>Booked Date:</h4>
                        <p><?= $bookingDate ?></p>
                    </div>

                    

                    <div class="status  expired active">
                        <p>
                            Active
                        </p>
                        
                    </div>
                    
                </div>

                <button onclick="printAccommodationDetails()" class="btn printBtn">
                    Print
                </button>

                <?php else : ?>

                    

                    <div class="data">
                        <h5>Hostel Name:</h4>
                        <p>--</p>
                    </div> 
                    <div class="data">
                        <h5>Room Number:</h4>
                        <p>--</p>
                    </div> 
                    <div class="data">
                        <h5>Room Type:</h4>
                        <p>--</p>
                    </div> 
                    <div class="data">
                        <h5>Hostel Location:</h4>
                        <p>--</p>
                    </div> 
                    <div class="data">
                        <h5>Hostel Contact:</h4>
                        <p>--</p>
                    </div> 
                    <div class="data">
                        <h5>Recipt Number:</h4>
                        <p>--</p>
                    </div>
                    <div class="data">
                        <h5>Reference:</h4>
                        <p>--</p>
                    </div>
                    <div class="data">
                        <h5>Booked Date:</h4>
                        <p>--</p>
                    </div>

                <?php endif ?>

            </div>


            <div id="booking" class="layer bookingHistoryLayer">
                <h2>Booking History</h2>

                <?php if(!isset($message2)) : ?>


                <div id="bookingHistory" class="records">
                    <!--records heading-->
                    <div class="columns">
                        <p class="heading1">Date</p> 
                        <p class="heading2">Hostel Name</p>
                        <p class="heading2">Room Name</p>
                        <p class="heading2">Room Type</p>
                        <p class="heading2">Hostel Number</p>
                        <p class="heading2">Price(GHC)</p>
                    </div>

                    
                     <!--records data-->
                     <div class="columns recordData">
                        <p class="heading1"><?= $bookingDate2 ?></p> 
                        <p class="heading2"><?= $hostelName2 ?></p>
                        <p class="heading2">Room <?= $roomName2 ?></p>
                        <p class="heading2"><?= $roomType2 ?></p>
                        <p class="heading2"><?= $hostelContact2 ?></p>
                        <p class="heading2"><?= $price2 ?></p>
                    </div>

                    <?php else : ?>

                        <center><h3><?= $message2 ?></i></h3></center>

                

                <div id="bookingHistory" class="records">
                    <!--records heading-->
                    <div class="columns">
                        <p class="heading1">Date</p> 
                        <p class="heading2">Hostel Name</p>
                        <p class="heading2">Room Name</p>
                        <p class="heading2">Room Type</p>
                        <p class="heading2">Hostel Number</p>
                        <p class="heading2">Price(GHC)</p>
                    </div>

                        <div class="columns recordData">
                        <p class="heading1">--</p> 
                        <p class="heading2">--</p>
                        <p class="heading2">--</p>
                        <p class="heading2">--</p>
                        <p class="heading2">--</p>
                        <p class="heading2">--</p>
                    </div>
                    
                    <?php endif ?>
                    
                </div>

                <button onclick="printBookingHistory()" class="btn printBtn">
                    Print
                </button>

            </div>

        </div>

    </main>
<script defer src="action.js"></script>
</body>
</html>