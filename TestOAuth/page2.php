<?php include 'header.php'?>

        <?php 
        session_start();
        (isset($_GET['code']))? $_SESSION['ZOHO']['code'] = $_GET['code']:""; 
        ?>
<br>
<div class="container" id="global_container">
    <div class="row">
         
         <!--GET ACCESS TOKEN ajax!-->
         <div class="col-sm-12">
            <label>Obtenir le token d acces à partir du code (et le token de refresh la premiere fois, /!\ Penser à le sauvgarder)</label>
            <br>
            <input type="button" id="GET_ACCESS_TOKEN_AJAX" value="GET ACCESS TOKEN ajax" class="btn btn-secondary"
               data-grant_type="authorization_code" 
               data-client_id="<?php echo $_SESSION['ZOHO']['client_id'];?>" 
               data-client_secret="<?php echo $_SESSION['ZOHO']['client_secret'];?>" 
               data-redirect_uri="<?php echo $_SESSION['ZOHO']['redirect_uri'];?>" 
               data-code="<?php echo $_SESSION['ZOHO']['code'];?>"> 
            <div id="GET_ACCESS_TOKEN_REP"></div>
         </div>
        
        <!--REFRESH ACCESS TOKEN ajax!-->
        <div class="col-sm-12">
            <label>Permet de réobtenir le token d acces lorsque il est expiré (1h de dura)</label>   
             <br>
            <input type="button" id="REFRESH_ACCESS_TOKEN_AJAX" value="REFRESH ACCESS TOKEN ajax" class="btn btn-secondary"
               data-grant_type="refresh_token" 
               data-client_id="<?php echo $_SESSION['ZOHO']['client_id'];?>" 
               data-client_secret="<?php echo $_SESSION['ZOHO']['client_secret'];?>"
               data-refresh_token="<?php echo $_SESSION['ZOHO']['refresh_token'];?>"> 
            <div id="REFRESH_ACCESS_TOKEN_REP"></div>
        </div>
        
        <!--REVOKE ACCESS TOKEN ajax!-->
        <div class="col-sm-12">
            <label>Permet de supprimer le token de refresh (normalement permanent) pour pouvoir en recréer un par exemple</label>
            <br>
            <input type="button" id="REVOKING_ACCESS_TOKEN_AJAX" value="REVOKING ACCESS TOKEN ajax" disabled="true" class="btn btn-secondary"
               data-token="<?php echo $_SESSION['ZOHO']['refresh_token'];?>">
            <div id="REVOKING_ACCESS_TOKEN_REP"></div>
        </div>
            
        <!--API_GET_ALL_USERS!-->
        <div class="col-sm-12">
            <label>Permet de lister tt les utilisateurs présents dans Zoho</label>
             <br>
            <input type="button" value="list users" id="API_GET_ALL_USERS" class="btn btn-secondary SET_ACCESS_TOKEN"
               data-access_token="<?php echo $_SESSION["ZOHO"]["access_token"];?>" 
               data-type="AllUsers">
            <div id="API_GET_ALL_USERS_REP"></div>
        </div>
            
        <!--API_GET_CONTACTS https://www.zoho.com/crm/developer/docs/api/get-records.html !-->
        <div class="col-sm-12">
            <label>Permet de lister les contacts présents dans Zoho</label>
             <br>
            <input type="button" value="list contacts" class="API_GET_CONTACTS btn btn-secondary SET_ACCESS_TOKEN"
               data-access_token="<?php echo $_SESSION["ZOHO"]["access_token"];?>" data-page="1">
            
            <input type="button" value="<" id="API_GET_CONTACTS_PREVIOUS" class="API_GET_CONTACTS btn btn-secondary SET_ACCESS_TOKEN"
                   data-access_token="<?php echo $_SESSION["ZOHO"]["access_token"];?>" data-page="1" disabled="disabled">
            <label id="API_GET_CONTACTS_ACTIF">Page 1</label>
            <input type="button" value=">" id="API_GET_CONTACTS_NEXT" class="API_GET_CONTACTS btn btn-secondary SET_ACCESS_TOKEN"
               data-access_token="<?php echo $_SESSION["ZOHO"]["access_token"];?>" data-page="2">
                
            <div id="API_GET_ALL_CONTACTS_REP"></div>
        </div>
        
        <!--API_INSERT_NEW_CONTACTS https://www.zoho.com/crm/developer/docs/api/insert-records.html !-->
        <div class="col-sm-12">
            <label>Permet de créer un nouveau contact dans Zoho</label>
             <br>
            <input type="button" value="new contact" class="btn btn-secondary SET_ACCESS_TOKEN" data-toggle="modal" data-target="#MODAL_INSERT_NEW_CONTACTS">
            <div id="API_INSERT_NEW_CONTACTS_REP"></div>
        </div>
        
        <!--API_GET_PRODUCTS https://www.zoho.com/crm/developer/docs/api/get-records.html !-->
        <div class="col-sm-12">
            <label>Permet de lister les produit pour un progamme donné</label>
            <select class="form-control" id="API_GET_PRODUCTS_NAME">
                <option>Aigue Marine</option>
                <option>DP - Impasse de la Margelle</option>
                <option>Hestia</option>
                <option>L'Estuaire</option>
                <option>L'Orée du Bois</option>
                <option>La Concorde</option>
                <option>La Grenouillère</option>
                <option>Le Carré Fleuri</option>
                <option>Le Carrousel</option>
                <option>Le Champ des Abeilles</option>
                <option>Le Clos d'Opale</option>
                <option>Le Clos de la Pépinière</option>
                <option>Le Clos des Avocettes</option>
                <option>Le Clos des Fleurs</option>
                <option>Le Clos des Lierres</option>
                <option>Le Clos des Lucioles</option>
                <option>Le Clos du Champs des Noyers</option>
                <option>Le Domaine du Pas des Roches</option>
                <option>Le Hammeau de la Treille</option>
                <option>Le Manège</option>
                <option>Le Petit Moulin</option>
                <option>Le Querry Crochet</option>
                <option>Le Square du Pieuré</option>
                <option>Le Treuil</option>
                <option>Le Verger</option>
                <option>Les Chênes Verts</option>
                <option>Les Cigognes</option>
                <option>Les Grands Champs</option>
                <option>Les Groix 3</option>
                <option>Les Iris</option>
                <option>Les Jardins de l'Ardillières</option>
                <option>Les Jardins de la Colindrie</option>
                <option>Les Jardins de la Prée</option>
                <option>Les Jardins du Moulin Neuf 2</option>
                <option>Les Jardins du Moulin Neuf 3</option>
                <option>Les Meuniers - Tranche 2</option>
                <option>Les Ondines</option>
                <option>Les Orchidées</option>
                <option>Les Templiers</option>
                <option>Les Terres du Levant</option>
                <option>Les Terres du Vivier - Tranche 1</option>
                <option>Les Terres du Vivier - Tranche 2</option>
                <option>Osiria</option>
                <option>Résidence Les Rochers</option>
            </select>
            <input type="button" value="list products" class="API_GET_PRODUCTS btn btn-secondary SET_ACCESS_TOKEN"
               data-access_token="<?php echo $_SESSION["ZOHO"]["access_token"];?>" data-page="1">
            <br><br>
            <div id="API_GET_PRODUCTS_REP" class="row"></div>
        </div>
    </div>    
</div>
<br>

<!-- Modal new contact-->
<div class="modal fade" id="MODAL_INSERT_NEW_CONTACTS" tabindex="-1" role="dialog" aria-labelledby="MODAL_INSERT_NEW_CONTACTS" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">New Contact</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          
          <div class="form-group">
            <label for="NEW_CONTACTS_LNAME" class="col-form-label">Nom</label>
            <input type="text" class="form-control" id="NEW_CONTACTS_LNAME">
          </div>
          <div class="form-group">
            <label for="NEW_CONTACTS_FNAME" class="col-form-label">Prenom</label>
           <input type="text" class="form-control" id="NEW_CONTACTS_FNAME">
          </div>
       <div class="form-group">
            <label for="NEW_CONTACTS_EMAIL" class="col-form-label">Email</label>
            <input type="email" class="form-control" id="NEW_CONTACTS_EMAIL">
          </div>
          <div class="form-group">
            <label for="NEW_CONTACTS_PHONE" class="col-form-label">Téléphone</label>
           <input type="tel" class="form-control" id="NEW_CONTACTS_PHONE">
          </div>
          <div class="form-group">
            <label for="NEW_CONTACTS_MOBILE" class="col-form-label">Portable</label>
            <input type="tel" class="form-control" id="NEW_CONTACTS_MOBILE">
          </div>
          <div class="form-group">
            <label for="NEW_CONTACTS_STATUT" class="col-form-label">Statut</label>
            <select class="form-control" id="NEW_CONTACTS_STATUT">
                <option>-None-</option>
                <option>En cours</option>
                <option>Option</option>
                <option>Sous compromis</option>
                <option>Acté</option>
                <option>Sans suite</option>
            </select>
          </div>
          <div class="form-group">
              <input type="text" class="form-control" id="NEW_CONTACTS_ORIGINE" value="Site Internet" hidden>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         <input type="button" value="new contact" id="API_INSERT_NEW_CONTACTS" class="btn btn-secondary SET_ACCESS_TOKEN" data-dismiss="modal"
               data-access_token="<?php echo $_SESSION["ZOHO"]["access_token"];?>"  >
        
      </div>
    </div>
  </div>
</div>
<?php include 'footer.php'?>   