<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
 
// instantiate ag$products object
include_once '../resources/product.php';
 
$database = new Database();
$db = $database->getConnection();
 
$product = new Product($db);

$seller_email='"'.$_POST['seller_email'].'"';
$product_SKU='"'.$_POST['product_SKU'].'"';

// get posted data

// make sure data is not empty

 
   




    if($product->add_data_channels($seller_email,$product_SKU))
    {
        http_response_code(200);
        echo json_encode(array("message"=>"True"));
    }

    else
    {
        http_response_code(404);
        echo json_encode(array("message"=>"False"));
    }

?>
