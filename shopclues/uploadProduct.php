<?php

include_once('login.php');

//call token generating function and store the access token
$token=genToken();
$accessToken=$token["access_token"];

//set headers
header("Content-Type: application/json; charset=UTF-8");
header("Authorization: Bearer".$accessToken)




?>