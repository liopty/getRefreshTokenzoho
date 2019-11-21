<?php
session_start();
$access_token = $_POST['access_token'];
$type = $_POST['type'];

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"https://www.zohoapis.com/crm/v2/users?type=".$type);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Authorization: Zoho-oauthtoken $access_token"
));

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec($ch);
curl_close ($ch);

$all_users_response = json_decode($server_output);
?>

<table class="table">
  <thead>
    <tr>
        <th scope="col">#</th>
        <th scope='col'>id</th>
        <th scope='col'>firs_name</th>
        <th scope='col'>last_name</th>
        <th scope='col'>email</th>
        <th scope='col'>phone</th>
        <th scope='col'>fax</th>
        <th scope='col'>role</th>
        <th scope='col'>profile</th>
        <th scope='col'>created_time</th>
        <th scope='col'>created_by</th>
        <th scope='col'>Modified_Time</th>
        <th scope='col'>Modified_By</th>
        <th scope='col'>Isonline</th>
        <th scope='col'>status</th>
    </tr>
  </thead>
  <tbody>
      <?php
      $i =1;
        foreach( $all_users_response->users as $v){
            echo "<tr>  <th scope='row'>$i</th>";
            echo "<td>$v->id</td>";  
            echo "<td>$v->first_name</td>";    
            echo "<td>$v->last_name</td>";    
            echo "<td>$v->email</td>";    
            echo "<td>$v->phone</td>";
            echo "<td>$v->fax</td>"; 
            echo "<td>".$v->role->name."</td>"; 
            echo "<td>".$v->profile->name."</td>"; 
            echo "<td>$v->created_time</td>";
            echo "<td>".$v->created_by->name."</td>"; 
            echo "<td>$v->Modified_Time</td>";  
            echo "<td>".$v->Modified_By->name."</td>"; 
            echo "<td>$v->Isonline</td>"; 
            echo "<td>$v->status</td>"; 
            $i++;
            echo "</tr>";
        }?>
  </tbody>
</table>