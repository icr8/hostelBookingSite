<?php

$test_secret_key = "";

// only a post with paystack signature header gets our attention
  if ((strtoupper($_SERVER['REQUEST_METHOD']) != 'POST' ) || !array_key_exists('HTTP_X_PAYSTACK_SIGNATURE', $_SERVER) )
      exit();

  

  // Retrieve the request's body
  $input = @file_get_contents("php://input");
  define('PAYSTACK_SECRET_KEY',$test_secret_key);

  // validate event do all at once to avoid timing attack
  if($_SERVER['HTTP_X_PAYSTACK_SIGNATURE'] !== hash_hmac('sha512', $input, PAYSTACK_SECRET_KEY))
      exit();

  http_response_code(200);

  // parse event (which is json string) as object
  // Do something - that will not take long - with $event
  $event = json_decode($input);

    $status = $event->data->status;
    $reference = $event->data->reference;
    $amount = $event->data->amount;
    $amountM = floatval($amount);
    $paymentMethod = $event->data->channel;
    $receiptNumber = $event->data->id;
    $fname = $event->data->customer->first_name;
    $lname = $event->data->customer->last_name;
    $fullName = $fname . " " . $lname;
    $email = $event->data->customer->email;
    $hostelIdinMsg = $event->data->message;
    $hostelIdinMsgM = intval($hostelIdinMsg);
    $transactionDate = $event->data->paid_at;
    $check = $event->event;
    
    if($check == "charge.success"){

    // if payment successful, insert transaction and booking here
    
    require '../userDashboard-logic.php';

    $insertTransactionQuery = $connection->prepare("INSERT INTO eventtransactions (status, userId, payeeName, hostelId, amount, receiptNumber, reference, paymentMethod, transactionDate)
     values(?, ?, ?, ?, ?, ?, ?, ?, ?) ");
    $insertTransactionQuery->bind_param("sisidssss", $status, $userId, $fullName, $hostelIdinMsgM, $amountM, $receiptNumber, $reference, $paymentMethod, $transactionDate);

    $insertTransactionQuery->execute();

    }
    

    exit();

