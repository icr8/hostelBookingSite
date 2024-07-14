<?php
    include'./partials/header.php';

    

?>

    <main class="body-container">
        <div class="summary page-con">

        <?php if(isset($_SESSION['verify-success'])) : ?>
        <div class="message success ">
          <p>
          <?= $_SESSION['verify-success'];
              unset($_SESSION['verify-success'])
          ?>
          </p>
        </div>
      
        <?php elseif (isset($_SESSION['verify-error'])) : ?>
          <div class="message error ">
          <p>
          <?= $_SESSION['verify-error'];
              unset($_SESSION['verify-error'])
          ?>
        </p>
        </div>
        <?php endif ?>

            

            <div id="profile" class="layer dashboard-con">

            <div class="card-con"> 

            <?php 
            //getting the number of occupied and available beds.
                $queryTwo = "SELECT  hostelCapacity FROM hostels WHERE hostelId = '$hostelId'";
                $resultTwo = mysqli_query($connection, $queryTwo);

                $occupiedQuery = "SELECT SUM(occupiedBeds) occupiedBedsSum FROM room WHERE hostelId = $hostelId";
                $occupiedResult = mysqli_query($connection, $occupiedQuery);


                if(mysqli_num_rows($resultTwo) > 0 AND mysqli_num_rows($occupiedResult) > 0){

                    

                //fetch data
                    $beds = mysqli_fetch_assoc($resultTwo);
                    $occupied = mysqli_fetch_assoc($occupiedResult);
                //assigning the values to the variables
                    $hostelBedCapacity = (int)$beds['hostelCapacity'];
                    $occupiedBeds= (int)$occupied['occupiedBedsSum'];
                    $availableBed = $hostelBedCapacity - $occupiedBeds;

                    }
                    else{
                        echo "no row found";
                        
                    }
                    
                    
                    
                    

                
                
            ?>

            

                <!-----------Available beds card------------->
                <div class="card ">
                        <div class="cardInfo increase-width">
                            <p> <?= $availableBed ?> </p>
                        </div>
                        <div class="cardhead">
                            <h5>Available Beds</h5>
                        </div>
                </div>

            
                <!----------Occupied beds card---------->
                <div class="card ">
                        <div class="cardInfo increase-width">
                            <p> <?= $occupiedBeds ?> </p>
                        </div>
                        <div class="cardhead">
                            <h5>Occupied Beds</h5>
                        </div>
                    </div>

                    <!------------Gender Allocation card--------------->
                    <div class="card">
                        <div class="cardInfo">

                            <!------------male card---------------->
                            <div class="gender male">
                                <p><?= $maleCount ?></p>
                                <center><h6>Male Rooms Left</h6></center>
                            </div>

                            <!-------------Female card----------------->
                            <div class="gender female">
                                <p><?= $femaleCount ?></p>
                                <center><h6>Female Rooms Left</h6></center>
                            </div>
                            
                            
                        </div>
                        <div class="cardhead">
                            <h5>Gender Allocation</h5>
                        </div>
                    </div>
                </div>
                
                <!-- 
                I will include this function later
                
                **Hostel admin use this go online or offline**
                <form class="onOffToggle-con">
                    <input class="onOffToggle" type="Radio" name="onOff" value="1"><span>Go Online</span><br>
                    <input class="onOffToggle" type="Radio" name="onOff" value="0"><span>Go Offline</span><br>
                    <input class="btn sub" type="submit" name="sub" value="Update" >
                </form> -->

                <hr>

            <div class="roomAssigningAndUnkown-con">
            
                <!------------verifying payment section--------------->
                
                <div class="roomAssigning-con">
                    
                    <h5>Pending Verifications</h5>

                    <!--looping through Pending verification list to display all of it-->

                    <?php while($userName = mysqli_fetch_assoc($result13)) : ?>
                    <div class="columns">
                        <a href="verification.php?id=<?= $userName['userId'] ?>" class="heading1 btn verify">Verify</a> 
                        <p class="heading2"><?= $userName['firstName'] ?> <?= $userName['lastName'] ?></p>
                    </div>
                    

                    <?php endwhile ?>

                    


                </div>

                <!------------ Room type Breakdown --------------->

                

                <div class="roomAssigning-con">
                    <h5>Room Type Breakdown</h5>
                    <div class="roomTypeCon">
                    <!-- 1 IN A ROOM INFO -->
                    <div class="roomType">
                        <h5>1 IN A ROOM</h5>
                        <div class="roomTypeDetails">
                            <h6>ROOM REMAINING:</h6>
                            <p><?=  $oneInRoomUnoccupied ?></p>
                            <h6>ROOM OCCUPIED:</h6>
                            <p><?= $oneInRoomOccupied ?></p>
                        </div>
                    </div>

                    <!-- 2 IN A ROOM INFO -->
                    <div class="roomType">
                        <h5>2 IN A ROOM</h5>
                        <div class="roomTypeDetails">
                            <h6>ROOM REMAINING:</h6>
                            <p><?= $twoInRoomUnoccupied ?></p>
                            <h6>ROOM OCCUPIED:</h6>
                            <p><?= $twoInRoomOccupied ?></p>
                        </div>
                    </div>

                    <!-- 3 IN A ROOM INFO -->
                    <div class="roomType">
                        <h5>3 IN A ROOM</h5>
                        <div class="roomTypeDetails">
                            <h6>ROOM REMAINING:</h6>
                            <p><?= $threeInRoomUnoccupied ?></p>
                            <h6>ROOM OCCUPIED:</h6>
                            <p><?= $threeInRoomOccupied ?></p>
                        </div>
                    </div>

                    <!-- 4 IN A ROOM INFO -->
                    <div class="roomType">
                        <h5>4 IN A ROOM</h5>
                        <div class="roomTypeDetails">
                            <h6>ROOM REMAINING:</h6>
                            <p><?= $fourInRoomUnoccupied ?></p>
                            <h6>ROOM OCCUPIED:</h6>
                            <p><?= $fourInRoomOccupied ?></p>
                        </div>
                    </div>

                </div>

                </div>
                

            </div>
        </div>
        

    </main>
<script defer src="\action.js"></script>
</body>
</html>