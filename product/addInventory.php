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

// get posted data

// make sure data is not empty

 
    $product->product_SKU = '"'. $_POST["product_sku"].'"';
    $product->product_quantity= '"'. $_POST["quantity"].'"';
    $address1= '"'. $_POST["address1"].'"';
    $address2= '"'. $_POST["address2"].'"';
    $city= '"'. $_POST["city"].'"';
    $pincode= '"'. $_POST["pincode"].'"';
    $state= '"'. $_POST["state"].'"';
    $contact= '"'. $_POST["contact"].'"';



    // $product->product_MRP='"'.  $_POST["product_MRP"].'"';
    // $product->product_selling_price='"'.  $_POST["product_selling_price"].'"';

    

    if($product->addInventory($address1,$address2,$city,$pincode,$state,$contact))
    {
        http_response_code(200);
        echo json_encode(array("message"=>"True","product_SKU"=>$_POST['product_sku']));
    }

    else
    {
        http_response_code(404);
        echo json_encode(array("message"=>"False"));
    }

?>
