<?php

include "partials/header.php";

//display 10 hostel cards
$hostelsQuery = "SELECT hostelId, hostelName, hostelLocation, hostelDistance, hostelCapacity FROM hostels LIMIT 12";
$hostelsResult = mysqli_query($connection, $hostelsQuery);




?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- Font awesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- css -->
    <link rel="stylesheet" href="style3.css">
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<br/>
<body class="container">


<center>
	<!-- Search bar codes-->
<form action="hostelSearch.php"  method="GET">
	<div class="search">
		<input type="text" name="keyword" placeholder="Search for hostel"/>
		<a href="#">
		<i class="fas fa-search"></i>
		</a>
	</div>
</form>

<!-- End of Search Bar-->



<!-- Filter bar at the home page (i will do it later)
<div class="filter">

	<div class="filter-option">
		<select class="Price">
		<option value="">Price Range</option>
		<option value="low">Low to High</option>
		<option value="High">High to Low</option>
		
		</select>
	</div>

</div> -->
<!-- End of Filter Bar -->

<!-- List of Hostel -->
       
    <section class="hostel-listings">
        <div class="box-container">

			<?php while($hostels = mysqli_fetch_assoc($hostelsResult)) : ?>

			<?php if(mysqli_num_rows($hostelsResult) > 0) : ?>

				<?php $hostelId = $hostels['hostelId'];
				
					$pictureQuery = "SELECT hostelPic1 FROM hostelpics WHERE hostelId = $hostelId";
					$pictureResult = mysqli_query($connection, $pictureQuery);
					$pic = mysqli_fetch_assoc($pictureResult);
				
				?>
				<a href="booking/booking.php?id=<?= $hostelId ?>">
				<div class="box shadow">

					<div class="image">
						<img src="pictures/<?= $pic['hostelPic1'] ?>" alt="">
					</div>
					<div class="content">
						<h3 class="hostelnames"><?= $hostels['hostelName'] ?></h3>
								<div class="text-box">
								<p style="color:white">LOCATION:</p>
								<span><?= $hostels['hostelLocation'] ?></span>
							</div>
							<div class="text-box">
								<p style="color:white">DISTANCE:</p>
								<span><?= $hostels['hostelDistance'] ?></span>
							</div>
							<div class="text-box">
								<p style="color:white">ROOMS AVAIL:</p>


							<!-- Getting and subtracting hostel Capacity and occupied room to find available room  -->
							<?php  
								
								$hostelCapacity = intval($hostels['hostelCapacity']);

								$occupiedRoomsQuery = "SELECT SUM(occupiedBeds) AS occupied FROM room WHERE hostelId = $hostelId";
								$occupiedRoomsResult = mysqli_query($connection, $occupiedRoomsQuery);

								$totalOccupied = mysqli_fetch_assoc($occupiedRoomsResult);
								$occupied = intval($totalOccupied['occupied']);
								$available = $hostelCapacity - $occupied;
							?>


								<span><?= $available ?></span>
							</div>
							
							
					</div>


		</div></a>
	
				<?php else : ?>

					<div class="message">
						<h3>Nor Results Found</h3>
					</div>

				<?php endif ?>
				<?php endwhile ?>


           
        </div>



    </section>
<!--End of List Of Hostels -->
<br/><br/>

<!--Footer codes -->


<footer class="footer">
	<div class="maincircle">
		<div class="circle"></div>
		<div class="circle"></div>
		<div class="circle"></div>

	</div>
			
		<div class="fcontent">
		
		
		<p style="color:white">CONTACT US</p>
		<p>0507864170</p>
		barasolutions24@gmail.com
		
		
		</div>
		<p>BARA CREATIONS | Copyright</p>
		




</footer>
</center>
<!-- End Of Footer -->

   
</body>
</html>
