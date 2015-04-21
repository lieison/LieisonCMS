<?php

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
    $header .= '<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/select2/select2.css"/>
                ';

    //BODY , SE INCLUIRA LA ESTRUCTURA QUE ESTA DENTRO DE ViewAdminProspecto
    $body = "<?php include 'view_edit_paginas.php' ?>";
    
    //FOOTER , SE INCLUIRAN EN EL PIE DE PAGINA PERO 
    // ESTOS DATOS SOLO DEBE SER FUNCIONES
    $footer = 'PrivF.init();';

    //AL FINAL DEL FOOTER SE INCLUIRAN LOS JS NECESARIOS PARA QUE FUNCIONE EL SCRIPT ADECUADAMENTE
    $footer_end = '<script type="text/javascript" src="PageFunctions.js"></script><script type="text/javascript" src="../../assets/global/plugins/select2/select2.min.js"></script>';


    ViewClass::PrepareView("View.phtml", "Admin");//PREPARANDO LA VISTA APUNTAMOS A "View.phtml" Dentro de la locacion "Admin"
    ViewClass::SetView(ViewClass::SetParamsString($body , $header , $footer , $footer_end)); //ENVIAMOS LOS PARAMETROS .. 