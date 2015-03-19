<?php

  /**
     *@todo LIEISOFT CMS SCRIPT AUTOGENERACION
     *@author Rolando Arriaza <rmarroquin@lieison.com>
     *@version 1.x
     *@since 0.1
     */

    //INICIAMOS SESION 
    session_start();
    
    //INCLUIMOS LIBRERIA PRINCIPAL DONDE SE CARGAN TODAS LAS DEMAS LIBRERIAS O SCRIPTS
    include   '../../../Conf/Include.php';
    
    $_SESSION['page_name']  = "Admin Prospecto";
    $_SESSION['home'] = "Sales";
    $_SESSION['title'] = "Sales <b> Edicion De Prospecto</b>";
    
    $header = '<div id="fb-root"></div>
            <script>(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&appId=271330856288382&version=v2.0";
                fjs.parentNode.insertBefore(js, fjs);
        }(document, "script", "facebook-jssdk"));</script>';
    
    $footer = '   var get_paises = function()
   {
        $.ajax({
                      type: "POST",
                      url: "get_paises.php",
                      beforeSend: function()
                      {
                          $("#drown_pais").html("<p>Cargando datos ...</p>");
                      },
                      success: function(value){
                          document.getElementById("drown_pais").innerHTML = value;
                      },
                      error: function()
                      {
                          $("#combo_pais").html("Error al cargar");
                      }
                      
              });
   }
   
   get_paises();';
    
    $footer_end = '<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>';
    $footer_end .= '<script src="AjaxAddSales.js"></script>';


    $rol = $_SESSION['login']['rol'];
    
    
    $adminc = new AdminController();
    $adminc->Get_Permission($rol, FunctionsController::get_actual_page());
    
    ViewClass::PrepareView("View.phtml", "Admin");
    ViewClass::SetView(ViewClass::SetParamsString("<?php include 'ViewEditProspecto.php'; ?>" , $header , $footer, $footer_end));

 


