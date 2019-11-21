<?php include 'header.php';
    session_start();
        $_SESSION['ZOHO']['refresh_token'] = "1000.129e25999fa39162dc2be00c21a2d8aa.4f3c7a8019f5c094c1bf6e0891dd3c86";//obtenu uniquement la premier fois que l on get l access token, penser à le recup et a le mettre en brut
        $_SESSION['ZOHO']['client_id'] = "1000.5Y2G8CPSMKT49G5LYB6G43AG8KZ7AH";
        $_SESSION['ZOHO']['client_secret'] = "0f61bd35a84a5f976304976fea01e2530ce5d73f90";
        $_SESSION['ZOHO']['redirect_uri'] ="http://localhost/TestOAuth/page2.php";
        $scope = "ZohoCRM.modules.all,ZohoCRM.users.ALL";
        $grantTokenRequest = htmlspecialchars('https://accounts.zoho.com/oauth/v2/auth?scope='.$scope.'&client_id='.$_SESSION['ZOHO']['client_id'].'&response_type=code&access_type=offline&redirect_uri='.$_SESSION['ZOHO']['redirect_uri']);
?>
<div class="container">
    <br>
    <label>Vers tests, page 2</label>
    <form action="<?php echo $grantTokenRequest?>" method="post">
        <input type="submit" value="Connexion">
    </form>
    <br>
    <br>
    <label>Vers recup refresh token, page 3</label>
    <form action="page3.php" method="post">
        <label>Scope</label>
        <input type="text" class="form-control" name="scope" id="GET_GRANT_TOKEN_SCOPE" required>
        <label>Client id</label>
        <input type="text" class="form-control" name="client_id" id="GET_GRANT_TOKEN_CLIENT_ID"required>
        <label>Redirect uri</label>
        <input type="text" class="form-control" name="redirect_uri" id="GET_GRANT_TOKEN_REDIRECT_URI"required>
        <input type="submit" value="Connexion">
    </form>
    </div>
 <?php include 'footer.php'?>       
    