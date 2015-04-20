<?php

 
 /**
 *@author Rolando Antonio Arriaza <rmarroquin@lieison.com>
 *@copyright (c) 2015, Lieison
 *
 *  Permission is hereby granted, free of charge, to any person obtaining a copy
    of this software and associated documentation files (the "Software"), to deal
    in the Software without restriction, including without limitation the rights
    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the Software is
    furnished to do so, subject to the following conditions:

    The above copyright notice and this permission notice shall be included in
    all copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
    SOFTWARE. 
 * 
 *@version 1.0
 *@todo Lieison S.A de C.V 
 * 
 * 
 * 
 */

    //INICIAMOS SESION 
    session_start();
    
    //INCLUIMOS LIBRERIA PRINCIPAL DONDE SE CARGAN TODAS LAS DEMAS LIBRERIAS O SCRIPTS
    include   '../../../Conf/Include.php';
    
    $_SESSION['page_name']  = "Admin Prospecto";
    $_SESSION['home'] = "Sales";
    $_SESSION['title'] = "Sales <b> Edicion De Prospecto</b>";
    
    
    $rol = $_SESSION['login']['rol'];
    
    $adminc = new AdminController();
    
     $adminc->Get_Permission(
            $rol, 
            FunctionsController::get_actual_page(),
            AdminController::get_option_permission(),
            array("admin" , "Sales"));
    
    $header = '<div id="fb-root"></div>
            <script>(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&appId=271330856288382&version=v2.0";
                fjs.parentNode.insertBefore(js, fjs);
        }(document, "script", "facebook-jssdk"));</script>';
    
   $footer = 'var get_paises = function(id)
   {
   
        var params = { "id":id };
        
        $.ajax({
                      type: "POST",
                      data:params,
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
    get_paises(' .$_REQUEST['id'] . ');
   ';
    
    $footer_end = '<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>';
    $footer_end .= '<script src="AjaxAddSales.js"></script>';


    ViewClass::PrepareView("View.phtml", "Admin");
    ViewClass::SetView(ViewClass::SetParamsString("<?php include 'ViewEditProspecto.php'; ?>" , $header , $footer, $footer_end));

 


