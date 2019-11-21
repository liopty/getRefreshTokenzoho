21/11/2019
## You can't use it if you are not me, but maybe you can understand how it's work for your own use


If you still want to use it to get refresh token :
   1) Create your client at https://accounts.zoho.com/developerconsole with http://localhost/TestOAuth/page3.php as redirect_uri
   2) Run this project localy (http://localhost/TestOAuth/) (php and curl requiered)
   3) Put your scope (you can find more information here https://www.zoho.com/crm/developer/docs/api/oauth-overview.html#scopes),
   client id and redirect uri(http://localhost/TestOAuth/page3.php)
   4) Press 'connexion'
   5) You should be redirect to zoho authorization page, accept it
   6) If you are not at http://localhost/TestOAuth/page3.php something failed, else press 'Get Grant Token'
   7) Put your client secret (don't change anything else) and press 'get refresh token'
   8) End
    
/!\
* Code get by 'Get Grant Token' is only available for 5min.
* You can only get refresh token the first time (zoho restriction ?) if you didn't save it create a new client.
