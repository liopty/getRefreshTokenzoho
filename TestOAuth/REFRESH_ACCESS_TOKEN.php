<?php
session_start();
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"https://accounts.zoho.com/oauth/v2/token");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
http_build_query(array(
    'client_id' => $_POST['client_id'], 
    'grant_type' => $_POST['grant_type'],
    'client_secret' => $_POST['client_secret'],
    'refresh_token' => $_POST['refresh_token'])));

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec($ch);
curl_close ($ch);

$refresh_token_response = json_decode($server_output);
$_SESSION["ZOHO"]["access_token"] =  $refresh_token_response->access_token;
echo "£".$_SESSION["ZOHO"]["access_token"]."£";
echo $server_output;