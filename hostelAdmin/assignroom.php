<?php
    include'./partials/header.php';

    if($_SERVER["REQUEST_METHOD"] = "POST"){


        
           
        



        if(isset($_POST['assignRoom'])){

             //storing the user id in a variable
             $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
             $cd = intval($id);
          
          
             //getting user booking data from database
             $bookingQuery = "SELECT u.firstName, u.lastName, u.gender, b.roomType
             FROM booking b INNER JOIN users u ON b.userId = u.userId 
             WHERE b.userId = $cd AND b.hostelId = '$hostelId'";
      
              $bookingResult = mysqli_query($connection, $bookingQuery);
                  $bookingDetails = mysqli_fetch_assoc($bookingResult);
                  $customerName = $bookingDetails['firstName'] . " " . $bookingDetails['lastName'];
                  $userGender = $bookingDetails['gender'];
                  $roomtypeNumber = intval($bookingDetails['roomType']);
            
                  
             

            //searching for an available room
                       
            $availRoomQuery = $connection->prepare("SELECT roomId, roomName, occupiedBeds FROM room WHERE 
            hostelId = ? AND roomType = ? AND roomGender =? AND occupiedBeds < ? LIMIT 1");
    
            $availRoomQuery->bind_param("iisi", $hostelId, $roomtypeNumber, $userGender, $roomtypeNumber);
            $availRoomResult = $availRoomQuery->execute();
            $availRoomResults = $availRoomQuery->get_result();
           
    
            if($availRoomResults->num_rows > 0){
    
                $roomDetail= mysqli_fetch_assoc($availRoomResults);
                $roomId = $roomDetail['roomId'];
                $roomName = $roomDetail['roomName'];
                $occupiedBeds = intval($roomDetail['occupiedBeds']);
                $occupiedBedsUpdate = $occupiedBeds + 1;
    
            //Update occupiedBeds for the room selected
            $occpiedUpdateQuery = $connection->prepare("UPDATE room SET occupiedBeds = ? WHERE hostelId = ? AND roomId = ?");
            $occpiedUpdateQuery-> bind_param("iii", $occupiedBedsUpdate, $hostelId, $roomId);
            $occpiedUpdateQuery->execute();
    
            //updating booking info for user
            $verifyKey = 1;
    
            $roomQuery = $connection->prepare("UPDATE booking SET roomId = ?, verified = ? WHERE hostelId = ? AND userId = ?");
            $roomQuery->bind_param("iiii", $roomId, $verifyKey, $hostelId, $cd);
    
            if($roomQuery->execute()){
                $_SESSION['verify-success'] = "You Have successfully Assigned Room " . $roomName . " to " . $customerName;
                header('location: '  . 'hostelManagerDashboard.php');
                die();
                
            }
            else{
                $_SESSION['verify-error'] = "There was an error assigning room, try again";
                header('location: '  . 'hostelManagerDashboard.php');
                die();
    
            }
    
    
            }else{
                $_SESSION['verify-error'] = "The Room type is fully occupied!";
                header('location: '  . 'hostelManagerDashboard.php');
                die();
    
            }
                        
                    
            }
            else{
                header('location: '  . 'hostelManagerDashboard.php');
                die();
            }


    }else{
        header('location: '  . 'hostelManagerDashboard.php');
        die();
    }