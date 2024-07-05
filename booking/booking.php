<?php

	require '../userDashboard-logic.php';

	

	if(isset($_GET['id'])){

		$hostelid3 = intval(filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT));

		//Getting hostel name and pictures
		$hostelquery3 = "SELECT hostelName, hostelPolicy from hostels WHERE hostelId = $hostelid3";
		$queryResult3 = mysqli_query($connection, $hostelquery3);
		$results3 = mysqli_fetch_assoc($queryResult3);
		$hostelName3 = $results3['hostelName'];
		$hostelPolicy3 = $results3['hostelPolicy'];
		
		//Getting hostel pictures
		$picsQuery4 = "SELECT * from hostelpics WHERE hostelId = $hostelid3";
		$queryResult4 = mysqli_query($connection, $picsQuery4);
		if($results4 = mysqli_fetch_assoc($queryResult4)){
		$hostelPic1 = $results4['hostelPic1'];
		$hostelPic2 = $results4['hostelPic2'];
		$hostelPic3 = $results4['hostelPic3'];
		$hostelPic4 = $results4['hostelPic4'];
		$hostelPic5 = $results4['hostelPic5'];
		$hostelPic6 = $results4['hostelPic6'];
		}

		//getting hostel room types
		$roomTypeQuery3 = "SELECT DISTINCT(roomType), price from room WHERE hostelId = $hostelid3";
		$roomTypeResults3 = mysqli_query($connection, $roomTypeQuery3);
		


		




	}else{
		header('Location: ' . '../hostels.php');
		die();
	}



?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Booking</title>
	<link rel="stylesheet" href="/hostelnames.css">
</head>
<body>
	<nav class="navBar">
		<h3><?= $userFullName?></h3>
		<a href="../userLogout.php" class="btn">Logout</a>

	</nav>
	<div class="container">

	<?php if (isset($_SESSION['booking-error'])) : ?>
          <div class="message error ">
          <p>
          <?= $_SESSION['booking-error'];
              unset($_SESSION['booking-error']);
          ?>
          </p>
        </div>
    <?php endif ?>
		
		<form action="makePayment-logic.php?id=<?=$hostelid3?>" method="POST">
		
		<div class="tab-con">



		<!-------------------------STEP 1----------------------->
			<div id="tab1" class="tab tab1">
				<!--header-->
				<center>
					<header>
					
						<h1><?= $hostelName3 ?></h1>
					
					
					</header>

					<h3 class="title">PICTURES OF <?= $hostelName3 ?></h3>

					<center>
						<div class="grid">
							
								<div class="box">
									<img src="../pictures/<?= $hostelPic1 ?>" alt="pictures of <?= $hostelName3 ?>">
						
								</div>
								<div class="box">
									<img src="../pictures/<?= $hostelPic2 ?>" alt="pictures of <?= $hostelName3 ?>">
						
								</div>
								<div class="box">
									<img src="../pictures/<?= $hostelPic3 ?>" alt="pictures of <?= $hostelName3 ?>">
						
								</div>
								
							
						
		
								<div class="box">
									<img src="../pictures/<?= $hostelPic4 ?>" alt="pictures of <?= $hostelName3 ?>">
						
								</div>
								<div class="box">
									<img src="../pictures/<?= $hostelPic5 ?>" alt="pictures of <?= $hostelName3 ?>">
						
								</div>
								<div class="box">
									<img src="../pictures/<?= $hostelPic6 ?>" alt="pictures of <?= $hostelName3 ?>">
						
								</div>
								
							
						
						
							

						</div>
						
						
				<h4 style="color: rgb(180, 172, 161);">CHOOSE</h4>

				<div class="textbox">

				<?php while($roomTypeArray = mysqli_fetch_assoc($roomTypeResults3)) :
					
					
					
				?>

					<div class="content">
					<input type="Radio" name="selectedRoomType" value="<?= $roomTypeArray['roomType'] ?>">
						<h3>
							<?php 
								if($roomTypeArray['roomType'] == 1){
									echo "1 IN A ROOM";
								}elseif($roomTypeArray['roomType'] == 2){
									echo "2 IN A ROOM";
								}elseif($roomTypeArray['roomType'] == 3){
								echo "3 IN A ROOM";
								}elseif($roomTypeArray['roomType'] == 4){
									echo "4 IN A ROOM";
								}else{
									echo "NONE";
								}
								
							?>
						</h3>
						<h3 class="price">GH&#8373;<?= $roomTypeArray['price'] ?></h3>
					</div>

				<?php endwhile ?>
					
				</div>




				


					</center>

			</div>
			<!-----------------------END OF STEP 1----------------------->

			<!-------------------------STEP 2----------------------->
			<div id="tab2" class="tab tab2">
				
				<!--header-->
				<center>
				<header>

					<h1><?= $hostelName3?> Policy</h1>


				</header>
				</center>

				<main>
					<section>
					<p><b>READ THE FOLLOWING CAREFULLY BEFORE PROCEEDING</b></p>
						
							<h4>Hostel Policy:</h4>
						
					
					
					
					<ul>
						<div class="policy-con">
							<li><?= $hostelPolicy3 ?></li>
						</div>
					</ul>
					</section>
				</main>
					

				<!--Footer-->
					<footer class="footer">
					
						<input class="checkbox" type="checkbox" name="agree" value="1"/> &nbspI Agree 
						
					
					</footer>



			</div>
			<!-----------------------END OF STEP 2----------------------->


			<!-------------------------STEP 3----------------------->
			<div id="tab3" class="tab tab3">
				
						<!--header-->
				<center>
				<header>

					<h1><?= $hostelName3 ?> Make Payment</h1>


				</header>
				</center>

					<main >
						<div class="summary">
							<!-- <div class="con">
								<h3 class="summaryHead" >HOSTEL NAME:</h3>
								<p><?= $hostelName3 ?></p>
							</div>
							<div class="con">
								<h3 class="summaryHead">ROOM TYPE:</h3>
								<p><?= $roomTypeArray['roomType'] ?></p>
							</div>
							<div class="con">
								<h3 class="summaryHead">PRICE:</h3>
								<p>GH&#8373;<?= $roomTypeArray['price']?></p>
							</div> -->
						</div>

						<center><input type="submit" name="makePayment" value="MakePayment" class="btn makePayment"/></center>
						
					</main>

			</div>
			<!-----------------------END OF STEP 3----------------------->

			
		
		
		</div>

		</form>

		<div class="tab-btns-con">
			<center>
				<button id="tab1Btn">STEP 1</button>
				<button id="tab2Btn">STEP 2</button>
				<button id="tab3Btn">STEP 3</button>
			</center>
		
			
		</div>

	</div>

	<script src="action.js"></script>
    </body>

</html>