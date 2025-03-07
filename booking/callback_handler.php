<?php



//verify payment function

 function verifyPayment($ref, $test_secret_key){

  

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

          //Including database
          require 'config/database.php';

          
    
          // if payment successful, insert transaction and booking here
     
          //inserting into transactions
          $insertTransactionQuery = $connection->prepare("INSERT INTO transactions ( transactionStatus, userId, hostelId, amount, receiptNumber, reference, paymentMethod, transactionDate) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?) " );
          $insertTransactionQuery ->bind_param("siidisss", $status, $bookerIdM, $hostelIdinMsgM, $amountM, $receiptNumberM, $reference, $paymentMethod, $transactionDate);
          $insertTransactionQuery->execute();
         
          //retrieving transaction id
          $getTransactionIdQuery = $connection->prepare("SELECT * FROM transactions WHERE hostelId = ? AND userId = ?");  
          $getTransactionIdQuery->bind_param("ii", $hostelIdinMsgM, $bookerIdM);  
          $transactionIdResult = $getTransactionIdQuery->execute();  

          if ($transactionIdResult) {  
              $result = $getTransactionIdQuery->get_result();  
              $transId = $result->fetch_assoc();  
              if ($transId) {  
                  $transactionId = $transId['transactionId'];  
                  $transactionId = intval($transactionId);  
              } else {  
        echo "No transaction found for the given criteria.";  
    }  
} else {  
    echo "Failed to execute selection of transaction Id";  
}  

            //inserting into booking
            $insertbookingQuery = $connection->prepare("INSERT INTO booking ( userId, hostelId, transactionId, roomType) VALUES(?, ?, ?, ?) " );
            $insertbookingQuery->bind_param("iiii", $bookerIdM, $hostelIdinMsgM, $transactionId, $roomTypeM);
            $insertbookingQuery->execute();
            
    
            if(!mysqli_errno($connection)){

              //Take user to success page
              header('Location: ' . '../bookingSuccess.php');
                die();
              }else{

                //get developer contact
                $contactQuery = "SELECT contact FROM developers where developersId = 1";
                $contactResult = mysqli_query($connection, $contactQuery);

                $contactRecord = mysqli_fetch_assoc($contactResult);
                $contact = $contactRecord['contact'];

                $_SESSION['booking-error']= "There was a problem in saving your Transaction data. Please contact Developer (".$contact.")!";
             header('Location: ' . 'booking.php?id='. $hostelIdinMsgM);
               die();
              }
    
             
    
          

          
    
        }
        else{
    
    
            $_SESSION['booking-error']= "The transaction failed. Try again!";
             header('Location: ' . 'booking.php?id='. $hostelIdinMsgM);
               die();
    
          }
    
        }
        else{
          // log the response for debugging
          error_log("unexpected API response: " . $response);
          echo "unexpected API response";
          
        }

      
    }

  }

      //Paystack keys
    $test_secret_key = "";

    //getting the reference from the url
    $ref = $_GET['reference'];
      

    //calling the verify transaction function
    verifyPayment($ref, $test_secret_key);


    

