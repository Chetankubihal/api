<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include_once '../config/database.php';
include_once '../resources/seller.php';

include_once 'email.php';

$database=new Database();
$conn=$database->getConnection();

$seller=new Seller($conn);
$email = new Mail();

$seller->email='"'. $_POST['sellerEmail'] .'"';
$agencyEmail='"' . $_POST['agencyEmail'] . '"';
$secret_key= $seller->addAgency($agencyEmail)
if($secret_key)
{

    $email->agencyRequestEmail($agencyEmail,$secret_key);
    echo json_encode(array("message" => "True"));
}
else
{
    echo json_encode(array("message" => "False"));
}


?>