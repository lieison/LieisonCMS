<?php

    include   '../../../Conf/Include.php';

    set_dependencies(array( "AdminController"));

    //INICIA UNA NUEVA SESION...CLASE DEL CORE Tools/Session
    Session::InitSession();
    Session::InsertSession("page_name", "Principal");

    //EN EL INDEX DESTRUYE TODO TIPO DE SESION DENTRO DE LOS TITULOS...
    if(Session::ExistSession("title")):
        Session::DestroySession("title");
        if(Session::ExistSession("home")):
              Session::DestroySession("home");
        endif;
    endif;


    //CARGARA LOS SCRIPTS NECESARIOS EN EL HEADER
    $header = "";
    
    //CARGARA EL BODY
    $body = "<?php include 'view_logout.php' ?>";

    //CARGARA EL FOOTER O LOS SCRIPTS JS
    $footer = "<script src='session.js'></script>";
    
    //CUIDADO SOLO CARGA LOS INITS DE JS ejemplo Load();
    $end_footer = "exit_session();";


    //PREPARANDO LA VISTA ...
    ViewClass::PrepareView("View.phtml", "Admin");

    
    //LLAMANDO LA VISTA
    ViewClass::SetView(ViewClass::SetParamsString($body ,$header , $end_footer , $footer));
