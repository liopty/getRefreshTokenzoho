$( document ).ready(function() {
   $('#GET_ACCESS_TOKEN_AJAX').click(function(){
       let obj = $(this).data();
       let data ='';
       data += 'client_id='+obj.client_id+
               '&grant_type='+obj.grant_type+
               '&client_secret='+obj.client_secret+
               '&redirect_uri='+obj.redirect_uri+
               '&code='+obj.code;
       $.ajax({
       url : 'http://localhost/TestOAuth/GET_ACCESS_TOKEN.php',
       type : 'POST',
       data : data,
       success : function(code_html, statut){
            $("#GET_ACCESS_TOKEN_REP").html(code_html);
            console.log(code_html);
            //Update les attributs access token dans la page
            code_html = code_html.split("£");
            $(".SET_ACCESS_TOKEN").each(function(){
                $(this).attr("data-access_token",code_html[1]);
            });
            //desactive le btn get access token et active refresh/revoke
            $('#GET_ACCESS_TOKEN_AJAX').attr("disabled","true");
            $('#REFRESH_ACCESS_TOKEN_AJAX').removeAttr("disabled");
            $('#REVOKING_ACCESS_TOKEN_AJAX').removeAttr("disabled");
       },

       error : function(resultat, statut, erreur){
        $("#GET_ACCESS_TOKEN_REP").html("erreur"+erreur);
       }

    });
   });
   
   $('#REFRESH_ACCESS_TOKEN_AJAX').click(function(){
       let obj = $(this).data();
       let data ='';
       data += 'client_id='+obj.client_id+
               '&grant_type='+obj.grant_type+
               '&client_secret='+obj.client_secret+
               '&refresh_token='+obj.refresh_token;
       $.ajax({
       url : 'http://localhost/TestOAuth/REFRESH_ACCESS_TOKEN.php',
       type : 'POST',
       data : data,
       success : function(code_html, statut){
           $("#REFRESH_ACCESS_TOKEN_REP").html(code_html);
           //Update les attributs access token dans la page
           code_html = code_html.split("£");
            $(".SET_ACCESS_TOKEN").each(function(){
                $(this).attr("data-access_token",code_html[1]);
            });
       },

       error : function(resultat, statut, erreur){
        $("#REFRESH_ACCESS_TOKEN_REP").html("erreur"+erreur);
       }

    });
   });
   
   $('#REVOKING_ACCESS_TOKEN_AJAX').click(function(){
       let obj = $(this).data();
       let data ='';
       data += 'token='+obj.token;
       $.ajax({
       url : 'http://localhost/TestOAuth/REVOKING_ACCESS_TOKEN.php',
       type : 'POST',
       data : data,
       success : function(code_html, statut){
           $("#REVOKING_ACCESS_TOKEN_REP").html(code_html);
           //on desactive tt les btn
           $("input[type=button]").each(function(){
              $(this).attr("disabled","true"); 
           });
           
       },
       error : function(resultat, statut, erreur){
        $("#REVOKING_ACCESS_TOKEN_REP").html("erreur"+erreur);
       }
    });
   });
   
   
    /////////////////////API//////////////
    $('#API_GET_ALL_USERS').click(function(){
       let obj = $(this).data();
       let data ='';
       data += 'type='+obj.type+
               '&access_token='+obj.access_token;
       $.ajax({
       url : 'http://localhost/TestOAuth/API_GET_ALL_USERS.php',
       type : 'POST',
       data : data,
       success : function(code_html, statut){
           $("#API_GET_ALL_USERS_REP").html(code_html);
           document.getElementById('REFRESH_ACCESS_TOKEN_AJAX').click();
       },
       error : function(resultat, statut, erreur){
        $("#API_GET_ALL_USERS_REP").html("erreur"+erreur);
       }
    });
   });
   
   let page = 1; 
   const api_get_contact_prev = $('#API_GET_CONTACTS_PREVIOUS');
   const api_get_contact_actif = $('#API_GET_CONTACTS_ACTIF');
   const api_get_contact_next = $('#API_GET_CONTACTS_NEXT');
   
   api_get_contact_prev.click(function(){
       page--;
       $(this).attr("data-page",page-1);
       (page<=1)?$(this).attr("disabled","true"):"";
       
       api_get_contact_actif.html("Page "+page);
       
       api_get_contact_next.removeAttr("disabled");
       api_get_contact_next.attr("data-page",page+1);
       
   });
   api_get_contact_next.click(function(){
       page++;
       $(this).attr("data-page",page+1);
       //$(this).attr("disabled","true"):"";
       
       api_get_contact_actif.html("Page "+page);
       
       api_get_contact_prev.removeAttr("disabled");
       api_get_contact_prev.attr("data-page",page-1);
       
   });
    $('.API_GET_CONTACTS').click(function(){
       let obj = $(this).data();
       let data ='';
       data += 'access_token='+obj.access_token+
               '&page='+page;
       $.ajax({
       url : 'http://localhost/TestOAuth/API_GET_ALL_CONTACTS.php',
       type : 'POST',
       data : data,
       success : function(code_html, statut){
           $("#API_GET_ALL_CONTACTS_REP").html(code_html);
           document.getElementById('REFRESH_ACCESS_TOKEN_AJAX').click();
       },
       error : function(resultat, statut, erreur){
        $("#API_GET_ALL_CONTACTS_REP").html("erreur"+erreur);
       }
    });
   });
   
   $('#API_INSERT_NEW_CONTACTS').click(function(){
       let obj = $(this).data();
       let Last_Name = $("#NEW_CONTACTS_LNAME").val();
       let First_Name = $("#NEW_CONTACTS_FNAME").val();
       let Email = $("#NEW_CONTACTS_EMAIL").val();
       let Phone = $("#NEW_CONTACTS_PHONE").val();
       let Mobile = $("#NEW_CONTACTS_MOBILE").val();
       let Statu = $("#NEW_CONTACTS_STATUT").val();
       let Origine_contact = $("#NEW_CONTACTS_ORIGINE").val();
       let data ="";
       data += 'access_token='+obj.access_token+
               '&Last_Name='+Last_Name+
               '&First_Name='+First_Name+
               '&Email='+Email+
               '&Phone='+Phone+
               '&Mobile='+Mobile+
               '&Statu='+Statu+
               '&Origine_contact='+Origine_contact;
       
       $.ajax({
       url : 'http://localhost/TestOAuth/API_INSERT_NEW_CONTACTS.php',
       type : 'POST',
       data : data,
       success : function(code_html, statut){
           $("#API_INSERT_NEW_CONTACTS_REP").html(code_html);
           document.getElementById('REFRESH_ACCESS_TOKEN_AJAX').click();
       },
       error : function(resultat, statut, erreur){
        $("#API_INSERT_NEW_CONTACTS_REP").html("erreur"+erreur);
       }
    });
   });
   
    $('.API_GET_PRODUCTS').click(function(){
       let obj = $(this).data();
       let data ='';
       data += 'access_token='+obj.access_token+
               '&page='+page+
               '&programme='+$("#API_GET_PRODUCTS_NAME").val();
        $("#API_GET_PRODUCTS_REP").html('<div class="spinner-border" style="margin-left:2em;"></div>');
       $.ajax({
       url : 'http://localhost/TestOAuth/API_GET_PRODUCTS.php',
       type : 'POST',
       data : data,
       success : function(code_html, statut){
           $("#API_GET_PRODUCTS_REP").html(code_html);
           document.getElementById('REFRESH_ACCESS_TOKEN_AJAX').click();
       },
       error : function(resultat, statut, erreur){
        $("#API_GET_PRODUCTS_REP").html("erreur"+erreur);
       }
    });
   });
   
   

    ////////////////////////////PAGE 3///////////////////////////////////////
    
   $('#GET_REFRESH_TOKEN_AJAX').click(function(){
        let data = "";
        data += 'client_id='+$("#GET_REFRESH_TOKEN_CLIENT_ID").val()+
                '&grant_type='+$("#GET_REFRESH_TOKEN_GRANT_TYPE").val()+
                '&client_secret='+$("#GET_REFRESH_TOKEN_CLIENT_SECRET").val()+
                '&redirect_uri='+$("#GET_REFRESH_TOKEN_REDIRECT_URI").val()+
                '&code='+$("#GET_REFRESH_TOKEN_CODE").val();
         $.ajax({
         url : 'http://localhost/TestOAuth/GET_ACCESS_TOKEN.php',
        type : 'POST',
        data : data,
        success : function(code_html, statut){
            console.log(code_html);
            code_html = code_html.split('"');
            $("#GET_REFRESH_TOKEN_REP").html(code_html[7]);
            $('#GET_REFRESH_TOKEN_AJAX').attr("disabled","true");  
        },
        error : function(resultat, statut, erreur){
            $("#GET_REFRESH_TOKEN_REP").html("erreur"+erreur);
        }

    });
   });
   
});

