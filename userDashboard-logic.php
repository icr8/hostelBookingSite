<?php 

require "config/database.php";



if(isset($_SESSION['user-id'])){

    $userId = $_SESSION['user-id'];

//getting user details
$userDetailsQuery = "SELECT firstName, lastName, userName, gender, email FROM users WHERE userId = $userId";
$userDetailsResult = mysqli_query($connection, $userDetailsQuery);
$details = mysqli_fetch_assoc($userDetailsResult);

$userFullName = $details['firstName'] . " " . $details['lastName'];
$userName = $details['userName'];
$gender = $details['gender'];
$email = $details['email'];



//getting accommodation details
$accomQuery = "SELECT hostelId, roomId, transactionId, bookingDate FROM booking where userId = $userId AND verified = 1";
$accomResult = mysqli_query($connection, $accomQuery);

if(mysqli_num_rows($accomResult) > 0){

    $accomDetails = mysqli_fetch_assoc($accomResult);
    $hostelId = $accomDetails['hostelId'];
    $roomId = $accomDetails['roomId'];
    $transactionId = $accomDetails['transactionId'];
    $bookingDate = $accomDetails['bookingDate'];

    //getting hostel details
    $hostelDetQuery = "SELECT hostelName, hostelLocation, hostelContact FROM hostels WHERE hostelId = $hostelId ";
    $hostelDetResult = mysqli_query($connection, $hostelDetQuery);
    $data = mysqli_fetch_assoc($hostelDetResult);
    $hostelName = $data['hostelName'];
    $hostelLocation = $data['hostelLocation'];
    $hostelContact = $data['hostelContact'];


    //getting transaction id to fill the unique code
    $transactionDetQuery = "SELECT receiptNumber, reference FROM transactions WHERE transactionId = $transactionId ";
    $transactionDetResult = mysqli_query($connection, $transactionDetQuery);
    $data3 = mysqli_fetch_assoc($transactionDetResult);
    $receiptNumber = $data3['receiptNumber'];
    $reference = $data3['reference'];
    

    //getting room details
    $roomDetQuery = "SELECT roomName, roomType FROM room WHERE roomId = $roomId ";
    $roomDetResult = mysqli_query($connection, $roomDetQuery);
    $data2 = mysqli_fetch_assoc($roomDetResult);
    $roomName = $data2['roomName'];
    $roomTypeNumber = $data2['roomType'];

    switch($roomTypeNumber){
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
    


    //getting Archive details
    $archQuery = "SELECT hostelId, roomId, transactionId, bookingDate FROM booking where userId = $userId AND verified = 2";
    $archResult = mysqli_query($connection, $archQuery);

    if(mysqli_num_rows($archResult) > 0){

        $archDetails = mysqli_fetch_assoc($archResult);
        $hostelId2 = $archDetails['hostelId'];
        $roomId2 = $archDetails['roomId'];
        $transactionId2 = $archDetails['transactionId'];
        $bookingDate2 = $archDetails['bookingDate'];

        //getting hostel details
    $archDetQuery = "SELECT hostelName, hostelLocation, hostelContact FROM hostels WHERE hostelId = $hostelId ";
    $archDetResult = mysqli_query($connection, $archDetQuery);
    $arch = mysqli_fetch_assoc($archDetResult);
    $hostelName2 = $arch['hostelName'];
    $hostelContact2 = $arch['hostelContact'];


    //getting room details
    $roomQuery = "SELECT roomName, price, roomType FROM room WHERE roomId = $roomId ";
    $roomResult = mysqli_query($connection, $roomQuery);
    $room = mysqli_fetch_assoc($roomResult);
    $roomName2 = $room['roomName'];
    $price2 = $room['price'];
    $roomTypeNumber2 = $room['roomType'];

    switch($roomTypeNumber2){
        case 1:
            $roomType2 = "1 IN A ROOM";
            break;

        case 2:
            $roomType2 = "2 IN A ROOM";
            break;

        case 3:
            $roomType2 = "3 IN A ROOM";
            break;

        case 4:
            $roomType2 = "4 IN A ROOM";
            break;
        
        default:
            $roomType2 = "Room type is not found";
            break;

    }


    }
    else{
        $message2 =  "NO Archive Record was Found!";
    }

}else{
    $message =  "NO Booking Record was Found!";
}

}else{
    header('Location: ' . '../login.php');
    die();
}