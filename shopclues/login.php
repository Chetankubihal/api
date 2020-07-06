<?php

$oauth_url = 'https://auth.shopclues.com/loginToken.php';   
$credentials = array(
    "username" => "kubihal21@gmail.com",
    "password" => md5("Stek@2020"),
    "client_id"=> "7ED1GGL7LT8DQ08ZD1SR19Z03LAAZZ5W49OAGZ",
    "client_secret"=> "YL(3651T9Q&JD^*#6L#6)Y02QZ_R76QJ*L#2&R+46^$989ZS_Q",
    "grant_type"=> "password"
    );

function genToken($oauth_url, $credentials)
{
 
$curl = curl_init($oauth_url);
curl_setopt_array($curl, array(
CURLOPT_RETURNTRANSFER => 1,
CURLOPT_HTTPHEADER => array(
'Content-Type: application/json'
),
CURLOPT_POST => 1,
CURLOPT_POSTFIELDS => json_encode($credentials)
));
$response = curl_exec($curl);
curl_close($curl);
$response = json_decode($response, true);
return $response;
}

$token = genToken($oauth_url, $credentials);  

// echo '{';
// echo '<br>';
// print_r("Access token: ".$token["access_token"]);
// echo '<br>';
// print_r("Expires(in seconds): ".$token["expires_in"]);
// echo '<br>';
// print_r("Token type: ".$token["token_type"]);
// echo '<br>';
// print_r("Scope: ".$token["scope"]);
// echo '<br>';
// print_r("Refresh token(in seconds): ".$token["refresh_token"]); 
// echo '<br>';
// echo'}';

 echo json_encode(array("Access token"=>$token["access_token"],"Expires in"=>$token['expires_in']));


?>

