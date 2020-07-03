<?php 

class Shopclues{

    public $client_id;
    public $client_password;
    public $username;
    public $password;

     public $oauth_url = 'https://auth.shopclues.com/loginToken.php'; 
  
    public $credentials = array(
    "username" => $username,
    "password" => md5($password),
    "client_id"=> $client_id,
    "client_secret"=> $client_password,
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

function checkSeller()  {

$token = genToken($oauth_url, $credentials);  

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

if($token["expires_in"])
    return true;
else
    return false;
}

}

?>