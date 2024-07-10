<?php

//Paystack keys
$test_secret_key = "";


//getting the reference from the url
$ref = $_GET['reference'];

//verify payment function

 //function verifyPayment($ref, $test_secret_key){

  

    $curl = curl_init();
    
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.paystack.co/transaction/verify/". $ref,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer $test_secret_key",
        "Cache-Control: no-cache",
      ),
    ));
    
    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);
    
    if ($err) {
      echo "cURL Error #:" . $err;
    } else {

      //echo $response;
      $tResults = json_decode($response);

      

      //getting transaction details and storing it in database
      if($tResults && isset($tResults->status)){
        
        $check = $tResults->data->status;
        
        
        
        if($tResults->status && $check == "success"){

          $status = $tResults->data->status;
          $transactionId = $tResults->data->customer->id;
          $transactionIdM =intval($transactionId);
          $reference = $tResults->data->reference;
          $amount = $tResults->data->amount;
          $amountM = doubleval($amount/100);
          $paymentMethod = $tResults->data->channel;
          $receiptNumber = $tResults->data->id;
          $receiptNumberM = intval($receiptNumber);
          $hostelIdinMsg = $tResults->data->metadata->hostelId;
          $bookerId = $tResults->data->metadata->bookerId;
          $bookerIdM = intval($bookerId);
          $roomType = $tResults->data->metadata->bookerRoomType;
          $roomTypeM = intval($roomType);
          $hostelIdinMsgM = intval($hostelIdinMsg);
          $transactionDate = $tResults->data->paid_at;
    
          // if payment successful, insert transaction and booking here
          
          require 'config/database.php';
    
          $insertTransactionQuery = $connection->prepare("INSERT INTO transactions (transactionId, transactionStatus, userId, hostelId, amount, receiptNumber, reference, paymentMethod, transactionDate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?) " );
          $insertTransactionQuery ->bind_param("isiidisss", $transactionIdM, $status, $bookerIdM, $hostelIdinMsgM, $amountM, $receiptNumberM, $reference, $paymentMethod, $transactionDate);
          
          $insertTransactionQuery->execute();
          $transactionRecord = $insertTransactionQuery->execute();
         

          if($transactionRecord == true){


            //inserting into booking
            $insertbookingQuery = $connection->prepare("INSERT INTO booking ( userId, hostelId, transactionId, roomType) VALUES(?, ?, ?, ?) " );
            $insertbookingQuery->bind_param("iiii", $bookerIdM, $hostelIdinMsgM, $transactionIdM, $roomTypeM);

            $insertbookingQuery->execute();
            $bookingRecord = $insertbookingQuery->execute();
    
            if($bookingRecord == true){

              //Take user to success page
              header('Location: ' . '../bookingSuccess.php');
                die();
    
            }else{

            $_SESSION['booking-error']= "There was problem saving your booking data. contact developer";
            header('Location: ' . 'booking.php?id='. $hostelIdinMsgM);
                die();

            }
    
            
    
          }
          else{
    
    
            $_SESSION['booking-error']= "There was problem saving your transaction data. contact developer";
             header('Location: ' . 'booking.php?id='. $hostelIdinMsgM);
               die();
    
          }
          
    
        }
    
        }

        else{
          // log the response for debugging
          error_log("unexpected API response: " . $response);
          echo "unexpected API response";
          
        }

      
    }

//  }


   

    //calling the verify transaction function
    //verifyPayment($ref, $test_secret_key);


    

