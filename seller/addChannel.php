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
include_once '../resources/shopclues.php'

$database = new Database();
$conn=$database->getConnection();

$seller=new Seller($conn);
$shopclues=new Shopclues($conn);

    $seller->email = '"'. $_POST["email"] .'"';
    $channel_name = '"'. $_POST['channel_name'] .'"';
    $shopclues->client_id= '"'. $_POST['clientid'] .'"';
    $shopclues->client_password= '"'. $_POST['clientpassword'] .'"';
    $shopclues->username= '"'. $_POST['username'] .'"';
    $shopclues->password= '"'. $_POST['password'] .'"';
 
    if($shopclues->checkSeller())
    // create the affiliate
    {
    if($seller->add_channel($channel_name,$client_id,$client_password)){
 
     
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

    

}

else{
    http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "Invalid"));
}
// tell the user data is incomplete
?>