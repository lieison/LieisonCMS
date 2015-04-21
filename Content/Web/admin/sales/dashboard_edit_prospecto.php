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
 */

    
    //INCLUIMOS LIBRERIA PRINCIPAL DONDE SE CARGAN TODAS LAS DEMAS LIBRERIAS O SCRIPTS
    include   '../../../Conf/Include.php';
    
    Session::InitSession();
    $login = Session::GetSession("login");
    $rol = $login['rol'];
    
    //VARIABLES DE SESION , CAMBIO EN EL VISTA
    Session::InsertSession("page_name", "Admin Prospectos");
    Session::InsertSession("home", "Edicion del prospecto ...");
    Session::InsertSession("title", "Sales: <b> Administrar Prospectos</b>");
    
    
    $adminc = new AdminController();
    
    //VERIFICANDO LOS PERMISOS PARA ESTA PAGINA 
    //ESTE CASO SE DAN PERMISOS ESPECIALES "Sales"
    $adminc->Get_Permission(
            $rol, 
            FunctionsController::get_actual_page(),
            AdminController::get_option_permission(),
            array("Sales"));/*YA QUE LA PAGINA ACTUAL NO ESTA CONFIGURADA PARA PERMISOS SOLO dashboard_admin_prospecto.php
             * SE LE OTROGAN PERMISOS EXTRA A "Sales"
             */
    
    
   //VALORES DEL HEADER EN EL VIEW
   $header = '<div id="fb-root"></div>
            <script>(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&appId=271330856288382&version=v2.0";
                fjs.parentNode.insertBefore(js, fjs);
        }(document, "script", "facebook-jssdk"));</script>';
    
   //VALORES DE INICIO JAVASCRIPT
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
    
    //SCRIPT QUE IRAN AL FINAL 
    $footer_end = '<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>';
    $footer_end .= '<script src="AjaxAddSales.js"></script>';


    ViewClass::PrepareView("View.phtml", "Admin");//PREAPRANDO LA VISTA 
    ViewClass::SetView(ViewClass::SetParamsString(
            "<?php include 'ViewEditProspecto.php'; ?>" , //body
            $header , //header
            $footer, //footer
            $footer_end //end footer
    ));//OBTENIENDO LA VISTA
    

 


