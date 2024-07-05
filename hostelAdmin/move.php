<?php 

include'./partials/header.php';


        
if(isset($_POST['reset'])){

      //getting all assigned users from database and placing them in the archive page
  $approvedQuery = "SELECT b.bookingDate, u.firstName, u.lastName, u.email, r.roomType, r.roomName, r.price FROM booking b INNER JOIN users u ON b.userId = u.userId INNER JOIN room r ON b.roomId = r.roomId WHERE b.hostelId = $hostelId AND b.verified = 1 ORDER BY bookingDate DESC";
  $approvedResult = mysqli_query($connection, $approvedQuery);
  

    if(mysqli_num_rows($approvedResult) > 0){

        while($approvedResult2 = mysqli_fetch_assoc($approvedResult)){


        $bookingDate = $approvedResult2['bookingDate'];
        $customerName = $approvedResult2['firstName'] . " " . $approvedResult2['lastName'];
        $roomType = $approvedResult2['roomType'];
        $roomName = $approvedResult2['roomName'];
        $price = $approvedResult2['price'];
        $email = $approvedResult2['email'];
    
        $moveToArchiveQuery = $connection->prepare("INSERT INTO archive (bookingDate, hostelId, CustomerName, roomType, roomName, price, email) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $moveToArchiveQuery->bind_param("sisisds", $bookingDate, $hostelId, $customerName, $roomType, $roomName, $price, $email);
        $moveToArchiveQuery->execute();

        $archiveKey = 2;
        $clearActiveCusQuery = $connection->prepare("UPDATE booking Set verified = ? WHERE hostelId = $hostelId");  
        $clearActiveCusQuery->bind_param("i", $archiveKey);
        $clearActiveCusQuery->execute();


        //reset occupied beds to 0
        $resetNum = 0;
        $resetOccupiedQuery = $connection->prepare("UPDATE room SET occupiedBeds = ? WHERE hostelId = ?");
        $resetOccupiedQuery->bind_param("ii", $resetNum, $hostelId);
        $resetOccupiedQuery->execute();
        

    }

    $_SESSION['reset-success'] ="You have successfully Reset your Admitteds!";

         header('location: ' . 'approved.php');
         die();

    }else{
        $_SESSION['reset-error'] ="There are no records to reset!";
        header('location: ' . 'approved.php');
         die();

    }

}else{
    header('location: ' . 'approved.php');
    die();
}
        
        