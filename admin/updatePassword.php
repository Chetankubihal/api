<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include_once '../config/database.php';
include_once '../resources/admin.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare affiliate object
$admin = new Admin($db);
 
// set email property of record to read



$admin->email= "chaitanyatjogin@gmail.com" ;
$admin->password= md5( $_POST['password']) ;


if($admin->updatePassword()){

    // set response code - 200 OK
    http_response_code(200);
    
    // make it json format
    echo json_encode(array("message" => "Successful"));
}
 
else{
    // set response code - 404 Not found 
    // tell the user affiliate does not exist
    echo json_encode(array("message" => "Failed"));
}
?>