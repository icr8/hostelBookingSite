<?php
require 'config/database.php';



if(isset($_SESSION['user-id'])){

    $hostelId = $_SESSION['user-id'] ;

    /* COunting male users */
    $query3 = "SELECT count(*) AS male FROM room WHERE hostelId = '$hostelId' AND  roomGender = 'male' AND occupiedBeds < 4";
    $result3 = mysqli_query($connection, $query3);

    if(mysqli_num_rows($result3) >= 0){
        $genderCount = mysqli_fetch_assoc($result3);
        $maleavail = $genderCount['male'];

         //getting the occupied FEMALE rooms in 4 in a room
         $queryocc4 = "SELECT count(*) AS maleocc4 FROM room WHERE hostelId = '$hostelId' AND roomType = '4' AND roomGender = 'male' AND occupiedBeds = 4";
         $resultocc4 = mysqli_query($connection, $queryocc4);
         $genderCountocc4 = mysqli_fetch_assoc($resultocc4);
         $maleCountocc4 = intval($genderCountocc4['maleocc4']);
 
         //getting the occupied FEMALE rooms in 3 in a room
         $queryocc3 = "SELECT count(*) AS maleocc3 FROM room WHERE hostelId = '$hostelId' AND roomType = '3' AND roomGender = 'male' AND occupiedBeds = 3";
         $resultocc3 = mysqli_query($connection, $queryocc3);
         $genderCountocc3 = mysqli_fetch_assoc($resultocc3);
         $maleCountocc3 = intval($genderCountocc3['maleocc3']);
 
         //getting the occupied FEMALE rooms in 2 in a room
         $queryocc2 = "SELECT count(*) AS maleocc2 FROM room WHERE hostelId = '$hostelId' AND roomType = '2' AND roomGender = 'male' AND occupiedBeds = 2";
         $resultocc2 = mysqli_query($connection, $queryocc2);
         $genderCountocc2 = mysqli_fetch_assoc($resultocc2);
         $maleCountocc2 = intval($genderCountocc2['maleocc2']);
 
         //getting the occupied FEMALE rooms in 1 in a room
         $queryocc1 = "SELECT count(*) AS maleocc1 FROM room WHERE hostelId = '$hostelId' AND roomType = '1' AND roomGender = 'male' AND occupiedBeds = 1";
         $resultocc1 = mysqli_query($connection, $queryocc1);
         $genderCountocc1 = mysqli_fetch_assoc($resultocc1);
         $maleCountocc1 = intval($genderCountocc1['maleocc1']);
 
         $maleCount = $maleavail - ($maleCountocc4 + $maleCountocc3 + $maleCountocc2 + $maleCountocc1);
 



    }else{
        echo "Result not found!";
    }

    /* Counting female users */
    $query4 = "SELECT count(*) AS female FROM room WHERE hostelId = '$hostelId' AND roomGender = 'female' AND occupiedBeds < 4";
    $result4 = mysqli_query($connection, $query4);

    
    if(mysqli_num_rows($result4) >= 0){
        $genderCount2 = mysqli_fetch_assoc($result4);
        $femaleavail = intval($genderCount2['female']);

        //getting the occupied FEMALE rooms in 4 in a room
        $queryocc4 = "SELECT count(*) AS femaleocc4 FROM room WHERE hostelId = '$hostelId' AND roomType = '4' AND roomGender = 'female' AND occupiedBeds = 4";
        $resultocc4 = mysqli_query($connection, $queryocc4);
        $genderCountocc4 = mysqli_fetch_assoc($resultocc4);
        $femaleCountocc4 = intval($genderCountocc4['femaleocc4']);

        //getting the occupied FEMALE rooms in 3 in a room
        $queryocc3 = "SELECT count(*) AS femaleocc3 FROM room WHERE hostelId = '$hostelId' AND roomType = '3' AND roomGender = 'female' AND occupiedBeds = 3";
        $resultocc3 = mysqli_query($connection, $queryocc3);
        $genderCountocc3 = mysqli_fetch_assoc($resultocc3);
        $femaleCountocc3 = intval($genderCountocc3['femaleocc3']);

        //getting the occupied FEMALE rooms in 2 in a room
        $queryocc2 = "SELECT count(*) AS femaleocc2 FROM room WHERE hostelId = '$hostelId' AND roomType = '2' AND roomGender = 'female' AND occupiedBeds = 2";
        $resultocc2 = mysqli_query($connection, $queryocc2);
        $genderCountocc2 = mysqli_fetch_assoc($resultocc2);
        $femaleCountocc2 = intval($genderCountocc2['femaleocc2']);

        //getting the occupied FEMALE rooms in 1 in a room
        $queryocc1 = "SELECT count(*) AS femaleocc1 FROM room WHERE hostelId = '$hostelId' AND roomType = '1' AND roomGender = 'female' AND occupiedBeds = 1";
        $resultocc1 = mysqli_query($connection, $queryocc1);
        $genderCountocc1 = mysqli_fetch_assoc($resultocc1);
        $femaleCountocc1 = intval($genderCountocc1['femaleocc1']);

        $femaleCount = $femaleavail - ($femaleCountocc4 + $femaleCountocc3 + $femaleCountocc2 + $femaleCountocc1);



    }else{
        echo "Result not found!";
    }


    /* counting number of users in 1 in a room  that is occupied */
    $query5 = "SELECT COUNT(*) AS occup FROM room WHERE hostelId= '$hostelId' AND roomType = 1 AND occupiedBeds = 1";
    $result5 = mysqli_query($connection, $query5);
    if(mysqli_num_rows($result5) >= 0){
        $Occupied1 = mysqli_fetch_assoc($result5);
        $oneInRoomOccupied = $Occupied1['occup'];

    }else{
        echo "Result not found!";
    }

    /* counting number of users in 1 in a room  that is not occupied */
    $query6 = "SELECT COUNT(*) AS remaining FROM room WHERE hostelId= '$hostelId' AND roomType = 1 AND occupiedBeds < 1";
    $result6 = mysqli_query($connection, $query6);
    if(mysqli_num_rows($result6) >= 0){
        $remain1 = mysqli_fetch_assoc($result6);
        $oneInRoomUnoccupied = $remain1['remaining'];

    }else{
        echo "Result not found!";
    }



    /* counting number of users in 2 in a room  that is occupied */
    $query7 = "SELECT COUNT(*) AS occup FROM room WHERE hostelId= '$hostelId' AND roomType = 2 AND occupiedBeds = 2";
    $result7 = mysqli_query($connection, $query7);
    if(mysqli_num_rows($result7) >= 0){
        $Occupied2 = mysqli_fetch_assoc($result7);
        $twoInRoomOccupied = $Occupied2['occup'];

    }else{
        echo "Result not found!";
    }

    /* counting number of users in 2 in a room  that is not occupied */
    $query8 = "SELECT COUNT(*) AS remaining FROM room WHERE hostelId= '$hostelId' AND roomType = 2 AND occupiedBeds < 2";
    $result8 = mysqli_query($connection, $query8);
    if(mysqli_num_rows($result8) >= 0){
        $remain2 = mysqli_fetch_assoc($result8);
        $twoInRoomUnoccupied = $remain2['remaining'];

    }else{
        echo "Result not found!";
    }



    /* counting number of users in 3 in a room  that is occupied */
    $query9 = "SELECT COUNT(*) AS occup FROM room WHERE hostelId= '$hostelId' AND roomType = 3 AND occupiedBeds = 3";
    $result9 = mysqli_query($connection, $query9);
    if(mysqli_num_rows($result9) >= 0){
        $Occupied3 = mysqli_fetch_assoc($result9);
        $threeInRoomOccupied = $Occupied3['occup'];

    }else{
        echo "Result not found!";
    }

    /* counting number of users in 3 in a room  that is not occupied */
    $query10 = "SELECT COUNT(*) AS remaining FROM room WHERE hostelId= '$hostelId' AND roomType = 3 AND occupiedBeds < 3";
    $result10 = mysqli_query($connection, $query10);
    if(mysqli_num_rows($result10) >= 0){
        $remain3 = mysqli_fetch_assoc($result10);
        $threeInRoomUnoccupied = $remain3['remaining'];

    }else{
        echo "Result not found!";
    }




    /* counting number of users in 4 in a room  that is occupied */
    $query11 = "SELECT COUNT(*) AS occup FROM room WHERE hostelId= '$hostelId' AND roomType = 4 AND occupiedBeds = 4";
    $result11 = mysqli_query($connection, $query11);
    if(mysqli_num_rows($result11) >= 0){
        $Occupied4 = mysqli_fetch_assoc($result11);
        $fourInRoomOccupied = $Occupied4['occup'];

    }else{
        echo "Result not found!";
    }

    /* counting number of users in 3 in a room  that is not occupied */
    $query12 = "SELECT COUNT(*) AS remaining FROM room WHERE hostelId= '$hostelId' AND roomType = 4 AND occupiedBeds < 4";
    $result12 = mysqli_query($connection, $query12);
    if(mysqli_num_rows($result12) >= 0){
        $remain5 = mysqli_fetch_assoc($result12);
        $fourInRoomUnoccupied = $remain5['remaining'];

    }else{
        echo "Result not found!";
    }



    // Pending booking list
    $query13 = "SELECT u.userId, u.firstName, u.lastName FROM booking b INNER JOIN users u ON b.userId = u.userId WHERE hostelId = '$hostelId' AND verified = 0";
    $result13 = mysqli_query($connection, $query13);




}else{
    header('Location:' . '..\adminLogin.php');
    die();
}

