<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

 
// include database and object files
include_once '../config/database.php';
include_once '../resources/product.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare affiliate object
$product = new Product($db);
 
// set email property of record to read
$product->product_SKU= '"'. $_GET['product_sku'] .'"';

// read the details of affiliate to be edited


 
if($product->readInventory()){
    // create array
    $inventory_details = array(
        "quantity" =>  $product->product_quantity,
        "address1" => $product->address1,
        "address2" => $product->address2,
        "city" => $product->city,
        "pincode" => $product->pincode,
        "state" => $product->state,
        "contact"=> $product->contact,
        "type"=> $product->type,
        "last_updated"=> $product->last_updated ,
        "role"=>$product->role,
        "district"=>$product->district
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode(array("message"=>"True","data"=>$inventory_details));
}

else{

    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user affiliate does not exist
    echo json_encode(array("message" => "False"));
}
?>