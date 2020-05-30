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

$product->product_SKU= '"'.$_POST['product_sku'].'"'; 
$product->product_HSN ='"'.$_POST["product_hsn"].'"';
$product->product_name ='"'.  $_POST["product_name"].'"';
$product->product_description ='"'. $_POST["product_description"].'"';
$product->product_category = '"'. $_POST["product_category"].'"';
$product->product_sub_category='"'.  $_POST["product_sub_category"].'"';
$product->product_MRP='"'.  $_POST["product_MRP"].'"';
$product->product_selling_price='"'.  $_POST["product_selling_price"].'"';
$product->package_length='"'.  $_POST["package_length"] .'"';
$product->package_width='"'.  $_POST["package_width"]. '"';
$product->package_breadth='"'.  $_POST["package_breadth"].'"';
$product->package_weight='"'.  $_POST["package_weight"].'"';

    

    if($product->updateProduct())
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