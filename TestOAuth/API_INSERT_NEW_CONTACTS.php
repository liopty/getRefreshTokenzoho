<?php
session_start();
$access_token = $_POST['access_token'];
$module_api_name = "Contacts";

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"https://www.zohoapis.com/crm/v2/".$module_api_name);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Authorization: Zoho-oauthtoken $access_token"
));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
json_encode(array(
    'data' => array(
        array(
            'Last_Name' => $_POST['Last_Name'],
            'First_Name' => $_POST['First_Name'],
            'Email' => $_POST['Email'],
            'Phone' => $_POST['Phone'],
            'Mobile' => $_POST['Mobile'],
            'Statu' => $_POST['Statu'],
            'Origine_contact' => $_POST['Origine_contact']
        )
    )
    )));


curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec($ch);
curl_close ($ch);
//$all_contacts_response = json_decode($server_output);
echo $server_output;
?>


