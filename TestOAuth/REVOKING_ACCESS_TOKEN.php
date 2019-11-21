<?php
session_start();
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"https://accounts.zoho.com/oauth/v2/token/revoke");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
http_build_query(array('token' => $_POST['token'])));

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec($ch);
curl_close ($ch);

unset($_SESSION['ZOHO']['refresh_token']);
echo $server_output;