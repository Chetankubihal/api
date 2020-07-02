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




$admin->password= md5($_POST['password']);
echo $_POST;
//mac address
$MAC = exec('getmac'); 
$MAC = strtok($MAC, ' '); 

//ip address
$IP = $_SERVER['REMOTE_ADDR']; 



$stmt=$admin->login();

if($stmt->rowCount()>0){

    // set response code - 200 OK
    $admin->updateLoginTime($MAC,$IP);

    http_response_code(200);
 
    // make it json format
    // echo json_encode(array("message" => "True"));
    echo json_encode(array("message" => "True"));
    
}
 
else{
    // set response code - 404 Not found 
    // tell the user affiliate does not exist
    echo json_encode(array("message" => "False"));
}



?>