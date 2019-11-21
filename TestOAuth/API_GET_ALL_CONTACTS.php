<?php
session_start();
$access_token = $_POST['access_token'];
$module_api_name = "Contacts";
$page = (int)$_POST['page'];

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"https://www.zohoapis.com/crm/v2/".$module_api_name."?page=$page");
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Authorization: Zoho-oauthtoken $access_token"
));

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec($ch);
curl_close ($ch);
$all_contacts_response = json_decode($server_output);
//var_dump($server_output);
?>



<table class="table" >
  <thead>
      <tr>
        <th scope="col">#</th>
        <th scope='col'>id</th>
        <th scope='col'>firs_name</th>
        <th scope='col'>last_name</th>
        <th scope='col'>email</th>
        <th scope='col'>phone</th>
        <th scope='col'>mobile</th>
        <th scope='col'>statu</th>
        <th scope='col'>Owner</th>
        <th scope='col'>Origine_contact</th>
        <th scope='col'>Created_Time</th>
        <th scope='col'>Modified_Time</th>
    </tr>
  </thead>
  <tbody>
      <?php
      if($all_contacts_response!=NULL){
      $i = ($page-1)*200+1;
        foreach( $all_contacts_response->data as $v){
            echo "<tr>  <th scope='row'>$i</th>";
            echo "<td>$v->id</td>";  
            echo "<td>$v->First_Name</td>";    
            echo "<td>$v->Last_Name</td>";    
            echo "<td>$v->Email</td>";    
            echo "<td>$v->Phone</td>";
            echo "<td>$v->Mobile</td>"; 
            echo "<td>$v->Statu</td>"; 
            echo "<td>".$v->Owner->name."</td>"; 
            echo "<td>$v->Origine_contact</td>";
            echo "<td>$v->Created_Time</td>"; 
            echo "<td>$v->Modified_Time</td>"; 
            $i++;
            echo "</tr>";
        }
      }?>
  </tbody>
</table>
