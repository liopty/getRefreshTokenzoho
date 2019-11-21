<?php include 'header.php';
    session_start();
    (isset($_POST["client_id"]))?$_SESSION['ZOHO']['client_id'] = $_POST["client_id"]:"";
    (isset($_POST["redirect_uri"]))?$_SESSION['ZOHO']['redirect_uri'] = $_POST["redirect_uri"]:"";
    $scope = (isset($_POST["scope"]))?$_POST["scope"]:"none";
    $grantTokenRequest = htmlspecialchars('https://accounts.zoho.com/oauth/v2/auth');
    $code = (isset($_GET["code"]))?$_GET["code"]:"";
?>
<div class="container">
    <br>
    <form action="<?php echo $grantTokenRequest?>" method="get">
        <input type="text" class="form-control" name="scope" value="<?php echo $scope?>" id="GET_GRANT_TOKEN_SCOPE" hidden>
        <input type="text" class="form-control" name="client_id" value="<?php echo (isset($_SESSION['ZOHO']['client_id']))?$_SESSION['ZOHO']['client_id']:"";?>" id="GET_GRANT_TOKEN_CLIENT_ID" hidden>
         <input type="text" class="form-control" name="response_type" value="code" id="" hidden>
         <input type="text" class="form-control" name="access_type" value="offline" id="" hidden>
         <input type="text" class="form-control" name="redirect_uri" value="<?php echo (isset($_SESSION['ZOHO']['redirect_uri']))?$_SESSION['ZOHO']['redirect_uri']:"";?>" id="GET_GRANT_TOKEN_REDIRECT_URI" hidden>
        <input type="submit" value="Get Grant Token" class="btn btn-secondary form-control" id="GET_GRANT_TOKEN">
    </form>

 <!--GET REFRESH TOKEN ajax!-->
 <br><br>
    <label>Obtenir le refresh token (la premiere fois) /!\ Penser à le sauvgarder</label>
    <br>
     <label>Client id</label>
    <input type="text" value="<?php echo (isset($_SESSION['ZOHO']['client_id']))?$_SESSION['ZOHO']['client_id']:"";?>" id="GET_REFRESH_TOKEN_CLIENT_ID" class="form-control">
     <label>Redirect uri</label>
    <input type="text" value="<?php echo (isset($_SESSION['ZOHO']['redirect_uri']))?$_SESSION['ZOHO']['redirect_uri']:"";?>" id="GET_REFRESH_TOKEN_REDIRECT_URI" class="form-control">
     <label>Code</label>
    <input type="text" value="<?php echo $code;?>" id="GET_REFRESH_TOKEN_CODE" class="form-control">
     <label>Client secret</label>
    <input type="text" value="" id="GET_REFRESH_TOKEN_CLIENT_SECRET" class="form-control">
     <label>Grant type</label>
    <input type="text" value="authorization_code" id="GET_REFRESH_TOKEN_GRANT_TYPE" class="form-control">
    <input type="button" id="GET_REFRESH_TOKEN_AJAX" value="GET REFRESH TOKEN" class="btn btn-secondary form-control">
    <div id="GET_REFRESH_TOKEN_REP"></div>
    
</div>

 <?php include 'footer.php'?>   