<?php

require "config/database.php";

if($_SERVER['REQUEST_METHOD']== "POST"){

    //Check if submit button was clicked
    if(isset($_POST['registerAdmin'])){

        //getting data from form

        //getting hostel admin account info
        $fullName = filter_var(trim($_POST['fullName'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $userName = filter_var(trim($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $email = filter_var(trim($_POST['email'], FILTER_SANITIZE_EMAIL));
        $gender = filter_var(trim($_POST['gender'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $password = filter_var(trim($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $confirmPassword = filter_var(trim($_POST['confirmPassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        
        //getting hostel info
        $hostelName = filter_var(trim($_POST['hostelName'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $hostelDistance = filter_var(trim($_POST['hostelDistance'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $hostelLocation = filter_var(trim($_POST['hostelLocation'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $hostelBeds = filter_var($_POST['hostelBeds'], FILTER_SANITIZE_NUMBER_INT);
        
        //getting the number of rooms, names, and price of 1 in a room
        $number1 = $_POST['number1'];
        $names1 = $_POST['names1'];
        $price1 = $_POST['price1'];
        
        //getting the number of rooms, names, and price of 2 in a room
        $number2 = $_POST['number2'];
        $names2 = $_POST['names2'];
        $price2 = $_POST['price2'];
        
        //getting the number of rooms, names, and price of 3 in a room
        $number3 = $_POST['number3'];
        $names3 = $_POST['names3'];
        $price3 = $_POST['price3'];
        
        //getting the number of rooms, names, and price of 4 in a room
        $number4 = $_POST['number4'];
        $names4 = $_POST['names4'];
        $price4 = $_POST['price4'];
        
        //getting the names of rooms that are for males and females
        $maleRooms = $_POST['maleRooms'];
        $femaleRooms = $_POST['femaleRooms'];
        
        //getting hostel pictures from user
        $picture1 = $_FILES['picture1'];
        $picture2 = $_FILES['picture2'];
        $picture3 = $_FILES['picture3'];
        $picture4 = $_FILES['picture4'];
        $picture5 = $_FILES['picture5'];
        $picture6 = $_FILES['picture6'];

        //getting hostel contact and passkey
        $hostelPhone = filter_var(trim($_POST['hostelPhone'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $passKey = filter_var(trim($_POST['passKey'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));


        //Checking if textfields is not empty
        if(!$fullName){

            $_SESSION['signup'] = "Enter your full name!";
           
        }
        elseif(!$userName){

        $_SESSION['signup'] = "Enter username!";
         

        }

        elseif(!$email){

        $_SESSION['signup'] = "Enter email!";
            

        }

        elseif(!$gender){

        $_SESSION['signup'] = "Choose Gender!";
            

        }
        
        elseif(!$password){

            $_SESSION['signup'] = "Enter password!";
                
    
        }

        elseif(strlen($confirmPassword) < 8 || strlen($password) < 8){

            $_SESSION['signup'] = "Password should be 8+ characters!";
                
    
        }

        elseif(!$hostelName){

            $_SESSION['signup'] = "Enter hostel name!";
                
    
        }

        elseif(!$hostelDistance){

            $_SESSION['signup'] = "Enter hostel Distance!";
                
    
        }

        elseif(!$hostelLocation){

            $_SESSION['signup'] = "Enter hostel Location!";
                
    
        }

        elseif(!$hostelBeds){

            $_SESSION['signup'] = "Enter total number of Beds!";
               
    
        }

        elseif(!$number1){

            $_SESSION['signup'] = "Enter the number of rooms that are 1 in a room!";
                
    
        }

        elseif(!$names1){

            $_SESSION['signup'] = "Enter the names of rooms that are 1 in a room!";
                
    
        }

        elseif(!$price1){

            $_SESSION['signup'] = "Enter the Price for 1 in a room!";
                
    
        }




        elseif(!$number2){

            $_SESSION['signup'] = "Enter the number of rooms that are 2 in a room!";
               
    
        }

        elseif(!$names2){

            $_SESSION['signup'] = "Enter the names of rooms that are 2 in a room!";
                
    
        }

        elseif(!$price2){

            $_SESSION['signup'] = "Enter the Price for 2 in a room!";
                
    
        }




        elseif(!$number3){

            $_SESSION['signup'] = "Enter the number of rooms that are 3 in a room!";
                
    
        }

        elseif(!$names3){

            $_SESSION['signup'] = "Enter the names of rooms that are 3 in a room!";
                
    
        }

        elseif(!$price3){

            $_SESSION['signup'] = "Enter the Price for 3 in a room!";
                
    
        }



        elseif(!$number4){

            $_SESSION['signup'] = "Enter the number of rooms that are 4 in a room!";
                
    
        }

        elseif(!$names4){

            $_SESSION['signup'] = "Enter the names of rooms that are 4 in a room!";
                
    
        }

        elseif(!$price4){

            $_SESSION['signup'] = "Enter the Price for 4 in a room!";
                
    
        }



        elseif(!$maleRooms){

            $_SESSION['signup'] = "Enter the names of male rooms!";
                
    
        }

        elseif(!$femaleRooms){

            $_SESSION['signup'] = "Enter the names of female rooms!";
                
    
        }

        elseif(!$picture1['name']){

            $_SESSION['signup'] = "Please upload Picture 1!";
                
    
        }

        elseif(!$picture2['name']){

            $_SESSION['signup'] = "Please upload Picture 2!";
                
    
        }

        elseif(!$picture3['name']){

            $_SESSION['signup'] = "Please upload Picture 3!";
                
    
        }

        elseif(!$picture4['name']){

            $_SESSION['signup'] = "Please upload Picture 4!";
                
    
        }

        elseif(!$picture5['name']){

            $_SESSION['signup'] = "Please upload Picture 5!";
                
    
        }

        elseif(!$picture6['name']){

            $_SESSION['signup'] = "Please upload Picture 6!";
                
    
        }

        elseif(!$hostelPhone){

            $_SESSION['signup'] = "Enter Hostel Contact!";
                
    
        }

        elseif(!$passKey){

            $_SESSION['signup'] = "Enter Passkey!";
                
    
        }
        
        else{

            //Get passkey from database
            $passKeyQuery = "SELECT developerPassKey FROM developers WHERE developerPassKey = '$passKey' LIMIT 1";
            $passKeyResult = mysqli_query($connection, $passKeyQuery);

            $PassKeys = mysqli_fetch_assoc($passKeyResult);
            $dbPassKey = $PassKeys['developerPassKey'];


            //check if password do not match
            if($confirmPassword !== $password){
                $_SESSION['signup'] = "Paasword do not Match!";

            }

            elseif(!$dbPassKey){
                $_SESSION['signup'] = "The Passkey is Incorrect!";
            }
            
            else{
                //hash password
                $hashPassword = password_hash($password, PASSWORD_DEFAULT);

                
                //check if username or email already exist in database
                $user_check_query = "SELECT * FROM adminaccount WHERE username='$userName' OR email='$email'";
                $user_check_result = mysqli_query($connection, $user_check_query);
                
                if(mysqli_num_rows($user_check_result)>0){
                    $_SESSION['signup'] = "Username or Email already exits";
                }
                else{


                    //work on pictures


                    //rename picture1
                    $time = time();//make each image name unique using current timestamp
                    $picture1_name = $time . $picture1['name'];
                    $picture1_tmp_name = $picture1['tmp_name'];
                    $picture1_destination_path = 'pictures/' . $picture1_name;

                    //make sure file is an image
                    $allowed_files= ['png', 'jpg','jpeg', 'JPG', 'JPEG', 'PNG'];
                    $extention = explode('.', $picture1_name);
                    $extention = end($extention);


                    if(in_array($extention, $allowed_files)){
                        //make sure image is not too large(1mb)
                        if($picture1['size']< 1000000){
                            //upload picture1
                            move_uploaded_file($picture1_tmp_name, $picture1_destination_path);
                        }
                        else{
                            $_SESSION['signup'] = "File size too big. It should be less than 1mb";
                        }


                    }
                    else{
                        $_SESSION['signup'] = "File should be png, jpg or jpeg";
                    }





                    //rename picture2
                    $time = time();//make each image name unique using current timestamp
                    $picture2_name = $time . $picture2['name'];
                    $picture2_tmp_name = $picture2['tmp_name'];
                    $picture2_destination_path = 'pictures/' . $picture2_name;

                    //make sure file is an image
                    $allowed_files= ['png', 'jpg','jpeg', 'JPG', 'JPEG', 'PNG'];
                    $extention = explode('.', $picture2_name);
                    $extention = end($extention);


                    if(in_array($extention, $allowed_files)){
                        //make sure image is not too large(1mb)
                        if($picture2['size']< 1000000){
                            //upload picture2
                            move_uploaded_file($picture2_tmp_name, $picture2_destination_path);
                        }
                        else{
                            $_SESSION['signup'] = "File size too big. It should be less than 1mb";
                        }


                    }
                    else{
                        $_SESSION['signup'] = "File should be png, jpg or jpeg";
                    }



                    //rename picture3
                    $time = time();//make each image name unique using current timestamp
                    $picture3_name = $time . $picture3['name'];
                    $picture3_tmp_name = $picture3['tmp_name'];
                    $picture3_destination_path = 'pictures/' . $picture3_name;

                    //make sure file is an image
                    $allowed_files= ['png', 'jpg','jpeg', 'JPG', 'JPEG', 'PNG'];
                    $extention = explode('.', $picture3_name);
                    $extention = end($extention);


                    if(in_array($extention, $allowed_files)){
                        //make sure image is not too large(1mb)
                        if($picture3['size']< 1000000){
                            //upload picture3
                            move_uploaded_file($picture3_tmp_name, $picture3_destination_path);
                        }
                        else{
                            $_SESSION['signup'] = "File size too big. It should be less than 1mb";
                        }


                    }
                    else{
                        $_SESSION['signup'] = "File should be png, jpg or jpeg";
                    }



                    //rename picture4
                    $time = time();//make each image name unique using current timestamp
                    $picture4_name = $time . $picture4['name'];
                    $picture4_tmp_name = $picture4['tmp_name'];
                    $picture4_destination_path = 'pictures/' . $picture4_name;

                    //make sure file is an image
                    $allowed_files= ['png', 'jpg','jpeg', 'JPG', 'JPEG', 'PNG'];
                    $extention = explode('.', $picture4_name);
                    $extention = end($extention);


                    if(in_array($extention, $allowed_files)){
                        //make sure image is not too large(1mb)
                        if($picture4['size']< 1000000){
                            //upload picture4
                            move_uploaded_file($picture4_tmp_name, $picture4_destination_path);
                        }
                        else{
                            $_SESSION['signup'] = "File size too big. It should be less than 1mb";
                        }


                    }
                    else{
                        $_SESSION['signup'] = "File should be png, jpg or jpeg";
                    }



                    //rename picture5
                    $time = time();//make each image name unique using current timestamp
                    $picture5_name = $time . $picture5['name'];
                    $picture5_tmp_name = $picture5['tmp_name'];
                    $picture5_destination_path = 'pictures/' . $picture5_name;

                    //make sure file is an image
                    $allowed_files= ['png', 'jpg','jpeg', 'JPG', 'JPEG', 'PNG'];
                    $extention = explode('.', $picture5_name);
                    $extention = end($extention);


                    if(in_array($extention, $allowed_files)){
                        //make sure image is not too large(1mb)
                        if($picture5['size']< 1000000){
                            //upload picture5
                            move_uploaded_file($picture5_tmp_name, $picture5_destination_path);
                        }
                        else{
                            $_SESSION['signup'] = "File size too big. It should be less than 1mb";
                        }


                    }
                    else{
                        $_SESSION['signup'] = "File should be png, jpg or jpeg";
                    }



                    //rename picture6
                    $time = time();//make each image name unique using current timestamp
                    $picture6_name = $time . $picture6['name'];
                    $picture6_tmp_name = $picture6['tmp_name'];
                    $picture6_destination_path = 'pictures/' . $picture6_name;

                    //make sure file is an image
                    $allowed_files= ['png', 'jpg','jpeg', 'JPG', 'JPEG', 'PNG'];
                    $extention = explode('.', $picture6_name);
                    $extention = end($extention);


                    if(in_array($extention, $allowed_files)){
                        //make sure image is not too large(1mb)
                        if($picture6['size']< 1000000){
                            //upload picture6
                            move_uploaded_file($picture6_tmp_name, $picture6_destination_path);
                        }
                        else{
                            $_SESSION['signup'] = "File size too big. It should be less than 1mb";
                        }


                    }
                    else{
                        $_SESSION['signup'] = "File should be png, jpg or jpeg";
                    }



                }
                

            }


        }


    //redirect to signup page if there was any problem
    if(isset($_SESSION['signup'])){
        //pass from data back to signup page
        $_SESSION['signup-data'] =$_POST;

        header('location: ' . 'adminSignup.php');
        die();
    }
    else{

        //Generating Index for hostels
        Do{
            $hostelId = rand(10000000,99999999);

            $idQuery = "SELECT * FROM hostels WHERE hostelId = $hostelId";
            $idResult = mysqli_query($connection,$idQuery);

        }while($idResult->num_rows > 0);



        //insert hostel info into hostels table
        $insert_hostel_query =$connection->prepare( "INSERT INTO  hostels(hostelId, hostelName, hostelDistance, HostelLocation, hostelCapacity, hostelContact) VALUES(?,?,?,?,?,?)");
        $insert_hostel_query ->bind_param("isssis", $hostelId, $hostelName, $hostelDistance, $hostelLocation, $hostelBeds, $hostelPhone);
        $insert_hostel_query->execute();


        //insert adminaccount info into adminaccount table
        $insert_adminaccount_query =$connection->prepare( "INSERT INTO  adminaccount(hostelId, fullName, username, gender, email, password) VALUES(?,?,?,?,?,?)");
        $insert_adminaccount_query ->bind_param("isssss", $hostelId, $fullName, $userName, $gender, $email, $hashPassword);
        $insert_adminaccount_query->execute();


        //insert picture names into hostelpics table
        $insert_picture_query =$connection->prepare( "INSERT INTO  hostelpics(hostelId, hostelPic1, hostelPic2, hostelPic3, hostelPic4, hostelPic5, hostelPic6) VALUES(?,?,?,?,?,?,?)");
        $insert_picture_query ->bind_param("issssss", $hostelId, $picture1_name, $picture2_name, $picture3_name, $picture4_name, $picture5_name, $picture6_name);
        $insert_picture_query->execute();


        error_reporting(E_ALL);

        //insert room details into room table
        
        //process user inputs
        $number_of_beds = intval($hostelBeds);
        $one_in_a_room = intval($number1);
        $two_in_a_room = intval($number2);
        $three_in_a_room = intval($number3);
        $four_in_a_room = intval($number4);

        //Price for each room type
        $price_one_in_a_room = floatval($price1);
        $price_two_in_a_room = floatval($price2);
        $price_three_in_a_room = floatval($price3);
        $price_four_in_a_room = floatval($price4);

        //explode and trim room names and gender-specific room names
        $rooms_for_males=array_map('trim', explode(',', $maleRooms));
        $rooms_for_females = array_map('trim',explode(',', $femaleRooms));
        $one_in_a_room_names = array_map('trim',explode(',', $names1));
        $two_in_a_room_names = array_map('trim',explode(',', $names2));
        $three_in_a_room_names = array_map('trim',explode(',', $names3));
        $four_in_a_room_names = array_map('trim',explode(',', $names4));


        //room types, names and pricing mapping
        $room_types = [
            'one_in_a_room'=> $one_in_a_room,
            'two_in_a_room'=> $two_in_a_room,
            'three_in_a_room'=> $three_in_a_room,
            'four_in_a_room'=> $four_in_a_room,
        ];



        $room_names_mapping = [

            'one_in_a_room'=> $one_in_a_room_names,
            'two_in_a_room'=> $two_in_a_room_names,
            'three_in_a_room'=> $three_in_a_room_names,
            'four_in_a_room'=> $four_in_a_room_names,

        ];


        $room_prices = [

            'one_in_a_room'=> $price_one_in_a_room,
            'two_in_a_room'=> $price_two_in_a_room,
            'three_in_a_room'=> $price_three_in_a_room,
            'four_in_a_room'=> $price_four_in_a_room,

        ];


        //occupancy mapping for room types
        $occupancy_mapping = [
            'one_in_a_room' => 1,
            'two_in_a_room' => 2,
            'three_in_a_room' => 3,
            'four_in_a_room' => 4,
        ];
        

        //room type mapping for room types
        $room_type_mapping = [
            'one_in_a_room' => 1,
            'two_in_a_room' => 2,
            'three_in_a_room' => 3,
            'four_in_a_room' => 4,
        ];
        

        //calculate total numberof rooms
        $total_rooms = array_sum($room_types);


        //function to insert room
        function insert_room($conn, $hostId, $name, $roomtype, $gen, $price, $occupancy){
            $statement = $conn->prepare("INSERT INTO room (hostelId, roomName, roomType, roomGender,
             price, numberOfBeds)values (?,?,?,?,?,?)");
            $statement->bind_param("isisdi", $hostId, $name, $roomtype, $gen, $price, $occupancy);
            $statement->execute();
             
            $statement->close();
        
        }


        

        //loop through each room and insert room
        foreach ($room_types as $type => $count){
            $occupancy = $occupancy_mapping[$type];

            $room_type =$room_type_mapping[$type];

            $room_names =$room_names_mapping[$type];
            
            $price = $room_prices[$type];

            for($i = 0; $i < $count; $i++){

                $room_name = isset($room_names[$i]) ? $room_names[$i] :
                 "Room" . strtoupper(substr($type, 0, 1)) . ($i + 1);
                
                $gen = 'unassigned';
                
                if(in_array($room_name, $rooms_for_males, true)){
                    $gen = 'male';
                } 
                elseif(in_array($room_name, $rooms_for_females, true)){
                    $gen = 'female';
                }


                //insert the room with its attributes including price

                insert_room($connection, $hostelId, $room_name, $room_type, $gen, $price, $occupancy);
                                                        
            }
        }
        
        
        
        if(!mysqli_errno($connection)){
            //redirect to login page with success page
            $_SESSION['signup-success'] = "Registration successful!";
            header('location: ' .'adminSignup.php');
            die();
        }
    
    }



    }else{
        header('Location: ' . 'adminSignup.php');
        die();
    }


}else{
    header('location: ' . 'adminSignup.php');
    die();
}