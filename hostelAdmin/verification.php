<?php
    include'./partials/header.php';

   
   
    if(isset($_GET['id'])){
       //storing the user id in a variable
       $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
       $cd = intval($id);
    
    
       //getting user booking data from database
       $bookingQuery = "SELECT u.firstName, u.lastName, u.gender, r.roomType, t.amount, t.reference, t.receiptNumber
       FROM booking b INNER JOIN users u ON b.userId = u.userId INNER JOIN room r ON b.roomId = r.roomId 
       INNER JOIN transactions t ON b.transactionId = t.transactionId INNER JOIN hostels h ON 
       b.hostelId = h.hostelId WHERE b.userId = $cd AND b.hostelId = '$hostelId'";

        $bookingResult = mysqli_query($connection, $bookingQuery);

        if(mysqli_num_rows($bookingResult)>0){
            $bookingDetails = mysqli_fetch_assoc($bookingResult);
            $customerName = $bookingDetails['firstName'] . " " . $bookingDetails['lastName'];
            $userGender = $bookingDetails['gender'];
            $roomtypeNumber = intval($bookingDetails['roomType']);
            

            // ckecking the roomTypeNumber to display the name in words
            switch($roomtypeNumber){
                case 1:
                    $roomType = "1 IN A ROOM";
                    break;

                case 2:
                    $roomType = "2 IN A ROOM";
                    break;

                case 3:
                    $roomType = "3 IN A ROOM";
                    break;

                case 4:
                    $roomType = "4 IN A ROOM";
                    break;
                
                default:
                    $roomType = "Room type is not found";
                    break;

            }

            

            $amount = $bookingDetails['amount'];
            $reference = $bookingDetails['reference'];
            $receipt = $bookingDetails['receiptNumber'];

        }
        else{
            echo "no result found";
        }
   

    }
    else{
    header('location: '  . 'hostelManagerDashboard.php');
    die();
    }
      

       
    
    

       
    

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
            

            <div id="profile" class="layer profileLayer">

                <div class="verificationCon">
                    <?php if(!empty($customerName)){ ?>
                    <div class="verificationDetails">
                        <h2>BOOKING DETAILS</h2>
                        <div class="row">
                            <h3>Customer Name:</h3>
                            <p><?= $customerName ?></p>
                        </div>

                    <?php }
                    else{
                        echo "user not found";
                    }
                    ?>


                    <form action="assignroom.php?id=<?= $id ?>" method="POST">
                    
                        <div class="row">
                            <h3>Room Type:</h3>
                            <p><?= $roomType ?></p>
                        </div>

                        <div class="row">
                            <h3>Amount Paid:</h3>
                            <p>GH&cent;<?= ' ' . $amount ?></p>
                        </div>

                        <div class="row">
                            <h3>Reference:</h3>
                            <p><?= $reference ?></p>
                        </div>

                        <div class="row">
                            <h3>Receipt Number:</h3>
                            <p><?= $receipt ?></p>
                        </div>
                        
                        <div class="buttonsCon">
                            <input type="submit" name="assignRoom" class="btn" value="Verify and Assign Room"/>
                        </div>
                    </form>


                    </div>
                </div>
                
            </div>
        

    </main>
</div>

<script defer src="\action.js"></script>
</body>
</html>