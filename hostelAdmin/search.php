<?php
    include'./partials/header.php';

     /* SEARCHING THROUGH THE list */
     if(isset($_GET['search']) && isset($_GET['submit'])){
        $search = filter_var($_GET['search'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $searchQuery = "SELECT * FROM archive WHERE customerName LIKE '%$search%' OR bookingDate LIKE '%$search%' ORDER BY archiveDate DESC";
        $record = mysqli_query($connection, $searchQuery);

        
    }
    else{
        header('location: ' . 'archive.php');
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

                    <?php while($searchRecords = mysqli_fetch_assoc($record)) : ?>
                     <!--records data-->
                     <div class="columns recordData">
                        <p class="heading2"><?= $searchRecords['bookingDate'] ?></p> 
                        <p class="heading2"><?= $searchRecords['CustomerName'] ?></p>
                        <p class="heading2"><?= $searchRecords['roomType'] ?></p>
                        <p class="heading2"><?= $searchRecords['roomName']?></p>
                        <p class="heading2"><?= $searchRecords['price'] ?></p>
                        <p class="heading2"><?= $searchRecords['email'] ?></p>
                    </div>
                    <?php endwhile ?>
                    
                    
                    
                </div>

            </div>
        

    </main>
<script defer src="\action.js"></script>
</body>
</html>