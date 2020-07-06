<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../resources/shopclues.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare seller object
$shopclues = new Shopclues($db);

//set headers
// header("Content-Type: application/json; charset=UTF-8");
// header("Authorization: Bearer".$accessToken);

$seller_email='"'.$_POST['seller_email'].'"';
$product_sku='"'.$_POST['sku_code'].'"';

$stmt=$shopclues->uploadProduct($product_sku,$seller_email);

echo json_encode(array)



?>