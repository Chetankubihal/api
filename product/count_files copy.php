<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$sku_code=$_GET['product_sku'];
$seller_email=$_GET['seller_email'];

$dir=getcwd()."/product_images/".$seller_email."/".$sku_code."/";

$fi = new FilesystemIterator($dir, FilesystemIterator::SKIP_DOTS);
$count= iterator_count($fi);

$a=scandir($dir);

echo json_encode(array("message"=>"True","count"=>$count,"image_array"=>$a));
?>