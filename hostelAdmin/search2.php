<?php
    include'./partials/header.php';

     /* SEARCHING THROUGH THE list */
     if(isset($_GET['search2']) && isset($_GET['submit2'])){
        $search = filter_var($_GET['search2'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $searchQuery = "SELECT b.bookingDate, u.firstName, u.lastName, u.email, r.roomType, r.roomName, r.price FROM booking b INNER JOIN users u ON b.userId = u.userId INNER JOIN room r ON b.roomId = r.roomId WHERE b.hostelId = $hostelId AND b.verified = 1 AND customerName LIKE '%$search%' OR bookingDate LIKE '%$search%' ORDER BY bookingDate DESC";
        $records = mysqli_query($connection, $searchQuery);

        
    }
    else{
        header('location: ' . 'approved.php');
        die();
    }

    
    

?>

    <main class="body-container">
        <div class="summary page-con">

            

            <div id="profile" class="layer profileLayer">
                
                <div id="bookingHistory" class="records">

                    <form class="searchBar" action="search.php" method="GET">
                        <input class="searchBox" type="text" name="search" placeholder="Search by Name, YYYY-MM-DD..." id="search">
                        <input class="searchBtn" type="submit" name="submit" value="Search">
                    </form>

                    <!--records heading-->
                    <div class="columns">
                        <p class="heading2">Booking Date</p> 
                        <p class="heading2">Customer Name</p>
                        <p class="heading2">Room Type</p>
                        <p class="heading2">Room Number</p>
                        <p class="heading2">Price(GHC)</p>
                        <p class="heading2">Email</p>
                    </div>

                    <?php while($searchRecord = mysqli_fetch_assoc($records)) : ?>
                     <!--records data-->
                     <div class="columns recordData">
                        <p class="heading2"><?= $searchRecord['bookingDate'] ?></p> 
                        <p class="heading2"><?= $searchRecord['CustomerName'] ?></p>
                        <p class="heading2"><?= $searchRecord['roomType'] ?></p>
                        <p class="heading2"><?= $searchRecord['roomName']?></p>
                        <p class="heading2"><?= $searchRecord['price'] ?></p>
                        <p class="heading2"><?= $searchRecord['email'] ?></p>
                    </div>
                    <?php endwhile ?>
                    
                    
                    
                </div>

            </div>
        

    </main>
<script defer src="\action.js"></script>
</body>
</html>