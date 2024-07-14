<?php

require '../userDashboard-logic.php';

if($_SERVER["REQUEST_METHOD"] === "POST"){

    if(isset($_POST['makePayment'])){






        //generating reference function

        function generateUniqueRef(){
            //get a high-precision timestamp
            $microtime = microtime(true);

            //formating the microtime as an integer string
            $microtimeString = sprintf('%.of', $microtime * 1000000);

            //generate a random number
            $randomNumber =  mt_rand(1000, 9999);

            //concatenate the microtime and the random number
            return $microtimeString . $randomNumber;
        }

        //End of generating reference function



        //initialize split transaction function

        

        function initializeTransaction($bookerEmail, $amount, $subAccount_code, $customData, $callback_url){
        
            $url = "https://api.paystack.co/transaction/initialize";

            $fields = [
                'email' => $bookerEmail,
                'amount' => $amount * 100,
                'subaccount' => $subAccount_code,
                'transaction_charge' => "500",
                'bearer' => "subaccount",
                'reference' => generateUniqueRef(),
                'metadata' => JSON_encode($customData),
                'callback_url' => $callback_url

            ];

            $fields_string = http_build_query($fields);

            //open connection
            $ch = curl_init();
            
            //set the url, number of POST vars, POST data
            curl_setopt($ch,CURLOPT_URL, $url);
            curl_setopt($ch,CURLOPT_POST, true);
            curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Authorization: Bearer your key",
                "Cache-Control: no-cache",
            ));
            
            //So that curl_exec returns the contents of the cURL; rather than echoing it
            curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
            
            //execute post
            $result = curl_exec($ch);
            //echo $result;
            $initialize_data = json_decode($result);
            
            $initialization_url = $initialize_data->data->authorization_url;
            if($result){
                header('Location: ' . $initialization_url);
            }
       
        }




        //geting variable data

        $bookerRoomType = intval(filter_var($_POST['selectedRoomType'], FILTER_SANITIZE_NUMBER_INT));
        $bookerId = $userId;
        $bookerEmail = $email;
        $hostelId3 = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        $agree = filter_var($_POST['agree'], FILTER_SANITIZE_NUMBER_INT);
        $hostId = intval($hostelId3);

        //getting the amount
        $amountQuery = "SELECT DISTINCT(price) FROM room WHERE hostelId = $hostId AND roomType = $bookerRoomType";
        $amountResult = mysqli_query($connection, $amountQuery);

        $amountArray = mysqli_fetch_assoc($amountResult);
        $amount = intval($amountArray['price']);


        if(!$bookerRoomType){
            $_SESSION['booking-error'] = "Please select room type at step 1";
            header('Location: ' . 'booking.php?id='. $hostelId3);
            die();
           
        }
        elseif(!$agree){
            $_SESSION['booking-error'] = "Please agree to terms at step 2";
            header('Location: ' . 'booking.php?id='. $hostelId3 );
            die();
            
        }
        else{
      

            // payment integration here
            
            
            $subAccount_code = "";

            $callback_url = "http://localhost:3000/booking/callback_handler.php";

            $customData = [
                'hostelId' => $hostId,
                'bookerRoomType' => $bookerRoomType,
                'bookerId' => $bookerId
            ];

            //Calling initializeTransaction function and passing values
            initializeTransaction($bookerEmail, $amount, $subAccount_code, $customData, $callback_url);

        }

        
   

    }else{
        header('Location: ' . 'booking.php');
    die();
    }

}else{
    header('Location: ' . 'booking.php');
    die();
}
