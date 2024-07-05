<?php
include'./partials/header.php';

//checking if update button was clicked
if(isset($_POST['update'])){

    //Getting inputs from the textfields and putting it in a variable
    $hostelName3 = filter_var($_POST['hostelName'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $hostelUsername = filter_var($_POST['hostelUsername'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $hostelDescription = filter_var($_POST['hostelDescription'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $hostelLocation = filter_var($_POST['hostelLocation'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $hostelBeds = intval(filter_var($_POST['hostelBeds'], FILTER_SANITIZE_NUMBER_INT));
    $hostelPolicy = trim($_POST['hostelPolicy']);
    $hostelPhone = filter_var($_POST['hostelPhone'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $hostelEmail = filter_var($_POST['hostelEmail'], FILTER_SANITIZE_EMAIL);
    
    //Putting settings textfield data into database

    //hostel details first
    $updateHostelQuery = $connection->prepare( "UPDATE hostels SET hostelName = ?, hosteldescription =?, hostelLocation = ?,
    hostelCapacity = ? ,hostelPolicy = ?, hostelContact = ? WHERE hostelId = ? ");

    $updateHostelQuery->bind_param("sssissi", $hostelName3, $hostelDescription, $hostelLocation, $hostelBeds, $hostelPolicy, $hostelPhone, $hostelId);

    if($updateHostelQuery->execute()){

        //Then admin Account details first
    $updateAccountQuery = $connection->prepare( "UPDATE adminaccount SET username = ?, email = ? WHERE hostelId = ? ");

    $updateAccountQuery->bind_param("ssi", $hostelUsername, $hostelEmail,$hostelId);

    if($updateAccountQuery->execute()){
        $_SESSION['updated-success'] = "You have Successfully Updated your Hostel Details!";

        header('location: ' . 'settings.php');
        die();


    }
    else{
        $_SESSION['updated-error'] = "An Error occurred in Updating your Hostel Details. please try Again.";
    }
    }
    else{
        $_SESSION['updated-error'] = "An Error occurred in Updating your Hostel Details. please try Again.";
    }

    

    

    
   

}
else{
    header('location: ' . 'settings.php');
    die();

}