<?php
    include'./partials/header.php';

    //getting all assigned users from database and placing them in the archive page
    $archiveQuery = "SELECT * FROM archive WHERE hostelId = $hostelId ORDER BY archiveDate DESC";
    $archiveResult = mysqli_query($connection, $archiveQuery);
  

?>

    <main class="body-container">
        <div class="summary page-con">

            

            <div id="profile" class="layer profileLayer">
            <form class="searchBar" action="search.php" method="GET">
                        <input class="searchBox" type="text" name="search" placeholder="Search by Name, YYYY-MM-DD..." id="search">
                        <input class="searchBtn" type="submit" name="submit" value="Search">
                    </form>
                <div id="bookingHistory" class="records">

                    

                    <!--records heading-->
                    <div class="columns">
                        <p class="heading2">Booking Date</p> 
                        <p class="heading2">Customer Name</p>
                        <p class="heading2">Room Type</p>
                        <p class="heading2">Room Number</p>
                        <p class="heading2">Price(GHC)</p>
                        <p class="heading2">Email</p>
                    </div>

                    <?php while($archiveResult2 = mysqli_fetch_assoc($archiveResult)) : ?>
                     <!--records data-->
                     <div class="columns recordData">
                        <p class="heading2"><?= $archiveResult2['bookingDate'] ?></p> 
                        <p class="heading2"><?= $archiveResult2['CustomerName'] ?></p>
                        <p class="heading2"><?= $archiveResult2['roomType'] ?></p>
                        <p class="heading2"><?= $archiveResult2['roomName']?></p>
                        <p class="heading2"><?= $archiveResult2['price'] ?></p>
                        <p class="heading2"><?= $archiveResult2['email'] ?></p>
                    </div>
                    <?php endwhile ?>
                    
                    
                    
                </div>
                <button onclick="printarchive()" class="btn printBtn">
                    Print
                </button>

            </div>
        

    </main>
<script defer src="\action.js"></script>
</body>
</html>