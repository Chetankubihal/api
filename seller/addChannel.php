<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate affiliate object
include_once '../resources/seller.php';

 
$database = new Database();
$db = $database->getConnection();
 


    $seller->email = $_POST["email"];
    $channel_name = $_POST['channel_name'];
    $client_id=$_POST['client_id'];
    $client_password=$_POST['client_password'];
    
 
    // create the affiliate
    if($seller->add_channel()){
 
     
        http_response_code(200);
 
        // tell the user
        echo json_encode(array("message" => "True"));
    }
 
    // if unable to create the affiliate, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "False"));
    }

 
// tell the user data is incomplete
?>