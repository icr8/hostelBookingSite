<?php
    include'./partials/header.php';

    //getting all assigned users from database and placing them in the archive page
    $approvedQuery = "SELECT b.bookingDate, u.firstName, u.lastName, u.email, r.roomType, r.roomName, r.price FROM booking b INNER JOIN users u ON b.userId = u.userId INNER JOIN room r ON b.roomId = r.roomId WHERE b.hostelId = $hostelId AND b.verified = 1 ORDER BY bookingDate DESC";
    $approvedResult = mysqli_query($connection, $approvedQuery);

    

?>

    <main class="body-container">
        <div class="summary page-con">

        
            

            <div id="profile" class="layer profileLayer">
                
                <div id="bookingHistory" class="records">
                <?php if(isset($_SESSION['reset-success'])) : ?>
        <div class="message success ">
          <p>
          <?= $_SESSION['reset-success'];
              unset($_SESSION['reset-success'])
          ?>
          </p>
        </div>
      
        <?php elseif (isset($_SESSION['reset-error'])) : ?>
          <div class="message error ">
          <p>
          <?= $_SESSION['reset-error'];
              unset($_SESSION['reset-error'])
          ?>
          </p>
        </div>
        <?php endif ?>
                    <form action="move.php" method="POST">
                        <button name="reset" class="resetBtn" >Reset
                        <span class="tooltipText">Click this to start admitting students again. (This moves all current students to Archive) </span>
                        </button>
                    </form>



                    <!-- Will work on it later -->
                    
                <!--    <form class="searchBar" action="search2.php" method="GET">
                        <input class="searchBox" type="text" name="search2" placeholder="Search by Name, YYYY-MM-DD..." id="search2">
                        <input class="searchBtn" type="submit" name="submit2" value="Search">
                    </form> -->
                    



                    <!--records heading-->
                    <div class="columns">
                        <p class="heading2">Booking Date</p> 
                        <p class="heading2">Customer Name</p>
                        <p class="heading2">Room Type</p>
                        <p class="heading2">Room Number</p>
                        <p class="heading2">Price(GHC)</p>
                        <p class="heading2">Email</p>
                    </div>

                    <?php while($approvedResult2 = mysqli_fetch_assoc($approvedResult)) : ?>
                     <!--records data-->
                     <div class="columns recordData">
                        <p class="heading2"><?= $approvedResult2['bookingDate'] ?></p> 
                        <p class="heading2"><?= $approvedResult2['firstName'] . " " . $approvedResult2['lastName'] ?></p>
                        <p class="heading2"><?= $approvedResult2['roomType'] ?></p>
                        <p class="heading2"><?= $approvedResult2['roomName']?></p>
                        <p class="heading2"><?= $approvedResult2['price'] ?></p>
                        <p class="heading2"><?= $approvedResult2['email'] ?></p>
                    </div>
                    <?php endwhile; ?>
                    
                    
                    
                </div>
                <button onclick="printapproved()" class="btn printBtn">
                    Print
                </button>

            </div>
        
        

    </main>
<script defer src="\action.js"></script>
</body>
</html>