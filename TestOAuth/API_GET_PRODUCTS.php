<?php
session_start();
$access_token = $_POST['access_token'];
$module_api_name = "Products";
$page = (int)$_POST['page'];
$programme = $_POST['programme'];
$fields = "id,Surface_m,Programme,Grille_de_prix,tat,Product_Name,Product_Category,Niveau,Type";
$all_products_response = [];
$sort_by = "Code";
$i=0;
$VEFA = FALSE;
do{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL,"https://www.zohoapis.com/crm/v2/".$module_api_name."?page=$page"."&fields=".$fields."&sort_by=".$sort_by);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Authorization: Zoho-oauthtoken $access_token"
    ));

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec($ch);
    curl_close ($ch);
    $products_response = json_decode($server_output,true);
    //var_dump($server_output);
    foreach( $products_response["data"] as $v){ 
        if($v["Programme"] == $programme){
            $all_products_response["data"][$i] = $v;
            $i++;
            (!$VEFA && $v["Product_Category"] == "VEFA")?$VEFA = true:"";
        } 
    }
    $page++;
} while($products_response != NULL && $products_response["info"]["more_records"]);

$all_contacts_response_json = json_decode(json_encode($all_products_response));
?>
<div class="col-sm-6">
<table class="table table-striped table-sm" cellspacing="0" width="50%">
  <thead>
      <tr>
        <th scope="col">Lot</th>
        <?php echo ($VEFA)?"<th scope='col'>Type</th><th scope='col'>Niveau</th>":"";?>
        <th scope='col'>Surface</th>
        <th scope='col'>Prix</th>
        <th scope='col'>Dispo</th>
    </tr>
  </thead>
  <tbody>
      <?php
      if($all_contacts_response_json!=NULL){
          $tbody = "";
        for( $j = floor($i/2); $j < $i; $j++){
            $v = $all_contacts_response_json->data[$j];
                $lot = explode(" / ",$v->Product_Name);
                $dispo = "";
                 switch ($v->tat){
                    case "Stock":
                        $dispo = "✔";
                        $rowColor = "LOT_STOCK";
                        break;
                    case "Compromis":
                        $dispo = "Réservé";
                        $rowColor = "LOT_RESERVE";
                        break;
                    case "Acté":
                        $dispo = "Réservé";
                        $rowColor = "LOT_RESERVE";
                        break;
                    case "Option":
                        $dispo = "Option";
                         $rowColor = "LOT_OPTION";
                        break;
                    case "Option Constructeur":
                        $dispo = "Option";
                        $rowColor = "LOT_OPTION";
                        break;
                    default:
                        break;
                }
                if($VEFA){
                    $tbody = "<tr class='$rowColor'>  <th scope='row'>$lot[2]</th>"
                        . "<td>$v->Type</td>"
                        . "<td>$v->Niveau</td>"
                        . "<td>$v->Surface_m m²</td>"
                        . "<td>$v->Grille_de_prix €</td>"
                        . "<td>$dispo</td>"
                        . "</tr>".$tbody;
                } else {
                     $tbody = "<tr class='$rowColor'>  <th scope='row'>$lot[2]</th>"
                        . "<td>$v->Surface_m m²</td>"
                        . "<td>$v->Grille_de_prix €</td>"
                        . "<td>$dispo</td>"
                        . "</tr>".$tbody;
                }
                
        }
        echo $tbody;
      }?>
  </tbody>
</table>
    </div>
<div class="col-sm-6">
<table class="table table-striped table-sm" cellspacing="0" width="100%">
  <thead>
      <tr>
        <th scope="col">Lot</th>
        <?php echo ($VEFA)?"<th scope='col'>Type</th><th scope='col'>Niveau</th>":"";?>
        <th scope='col'>Surface</th>
        <th scope='col'>Prix</th>
        <th scope='col'>Dispo</th>
    </tr>
  </thead>
  <tbody>
      <?php
      if($all_contacts_response_json!=NULL){
          $tbody = "";
         for( $j = 0; $j < floor($i/2); $j++){
            $v = $all_contacts_response_json->data[$j];
                $lot = explode(" / ",$v->Product_Name);
                $dispo = "";
                $rowColor = "";
                switch ($v->tat){
                    case "Stock":
                        $dispo = "✔";
                        $rowColor = "LOT_STOCK";
                        break;
                    case "Compromis":
                        $dispo = "Réservé";
                        $rowColor = "LOT_RESERVE";
                        break;
                    case "Acté":
                        $dispo = "Réservé";
                        $rowColor = "LOT_RESERVE";
                        break;
                    case "Option":
                        $dispo = "Option";
                         $rowColor = "LOT_OPTION";
                        break;
                    case "Option Constructeur":
                        $dispo = "Option";
                        $rowColor = "LOT_OPTION";
                        break;
                    default:
                        break;
                }
                 if($VEFA){
                    $tbody = "<tr class='$rowColor'>  <th scope='row'>$lot[2]</th>"
                        . "<td>$v->Type</td>"
                        . "<td>$v->Niveau</td>"
                        . "<td>$v->Surface_m m²</td>"
                        . "<td>$v->Grille_de_prix €</td>"
                        . "<td>$dispo</td>"
                        . "</tr>".$tbody;
                } else {
                     $tbody = "<tr class='$rowColor'>  <th scope='row'>$lot[2]</th>"
                        . "<td>$v->Surface_m m²</td>"
                        . "<td>$v->Grille_de_prix €</td>"
                        . "<td>$dispo</td>"
                        . "</tr>".$tbody;
                }
        }
        echo $tbody;
      }?>
  </tbody>
</table>
</div>