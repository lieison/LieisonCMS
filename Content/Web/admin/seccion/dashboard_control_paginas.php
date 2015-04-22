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

    
    include   '../../../Conf/Include.php';
    
    Session::InitSession();
    
    $login = Session::GetSession("login");
    $rol = $login['rol'];
    
    //VARIABLES DE SESION , CAMBIO EN EL VISTA
    Session::InsertSession("page_name", "Control de Paginas");
    Session::InsertSession("home", "Dashboard Control de paginas");
    Session::InsertSession("title", "<b>Control de Paginas </b>");
    
    
    //CONTROLADOR DEL ADMINISTRADOR 
    $adminc = new AdminController();
    //OBTIENE LOS PERMISOS MEDIANTE EL ROL INDICADO 
    $adminc->Get_Permission($rol, FunctionsController::get_actual_page());
    

    //HEADER , CABECERA DONDE SE INICIARA ELEMENTOS NECESARIOS PARA ESTE SCRIPT
    $header .= '<script type="text/javascript" src="PageFunctions.js"></script>';

    //BODY , SE INCLUIRA LA ESTRUCTURA QUE ESTA DENTRO DE ViewAdminProspecto
    $body = "<?php include 'view_paginas.php' ?>";
    
    //FOOTER , SE INCLUIRAN EN EL PIE DE PAGINA PERO 
    // ESTOS DATOS SOLO DEBE SER FUNCIONES
    $footer = 'buscar_log(1); buscar_seccion();';

    //AL FINAL DEL FOOTER SE INCLUIRAN LOS JS NECESARIOS PARA QUE FUNCIONE EL SCRIPT ADECUADAMENTE
    $footer_end = '';


    ViewClass::PrepareView("View.phtml", "Admin");//PREPARANDO LA VISTA APUNTAMOS A "View.phtml" Dentro de la locacion "Admin"
    ViewClass::SetView(ViewClass::SetParamsString($body , $header , $footer , $footer_end)); //ENVIAMOS LOS PARAMETROS .. 
    
   
