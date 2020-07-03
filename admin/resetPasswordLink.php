<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include_once '../config/database.php';
include_once '../config/OTP.php';
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare affiliate object
 
  $otp = new OTP($db);
  $otp->email = "chaitanyatjogin@gmail.com";
  $otp->otp=$otp->generateNumericOTP(); 

// set email property of record to read

  
  $to=$otp->email;
  $subject="Password Reset Link";
  $headers="From:kubihalchetan@gmail.com@gmail.com" . "\r\n";
  $headers .= "Reply-To: ". "Password Reset" . "\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
  $message  = '<img src="data:image/png;base64,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" alt="coming soon" height="42" width="42">';
  $message .= '<h1>PASSWORD RESET </h1><br><h3>USE THE FOLLOWING CODE</h3>';
  $message .= $otp->otp;
  

  
  if(mail($to,$subject,$message,$headers))
  {

    $otp->saveOTP();
    echo json_encode(array("message" => "True"));

  }
  else
  {
    echo "Mail Sending Failed";
  }

?>