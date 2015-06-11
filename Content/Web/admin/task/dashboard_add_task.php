<?php


    //INCLUIMOS LIBRERIA PRINCIPAL DONDE SE CARGAN TODAS LAS DEMAS LIBRERIAS O SCRIPTS
    include   '../../../Conf/Include.php';

    get_dependencies(array(
        "AdminController"
    ));
    
    //INICIA UNA NUEVA SESION...CLASE DEL CORE Tools/Session
    Session::InitSession();
    Session::InsertSession("page_name", "Add Tasks");
    Session::InsertSession("home", "Task -> Add Task");
    Session::InsertSession("title", "Add Task");
    
    $login = Session::GetSession("login");
    $rol = $login['rol'];
    
    //CONTROLADOR DEL ADMINISTRADOR 
    $adminc = new AdminController();
    //OBTIENE LOS PERMISOS MEDIANTE EL ROL INDICADO 
    $adminc->Get_Permission(
            $rol, 
            FunctionsController::get_actual_page(),
            AdminController::get_option_permission());
  
    
    //CARGARA LOS SCRIPTS NECESARIOS EN EL HEADER
    $header = '<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/jstree/dist/themes/default/style.min.css"/>'
            . '<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />'
            . '<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-wysihtml5/wysiwyg-color.css" />';
    
    //CARGARA EL BODY SISTEMA DE SEGURIDAD CORTESIA DE BOX
    if(isset($_REQUEST['security'])):
        $body = "<?php include 'view_add_task.php' ?>";
       if(isset($_REQUEST['box'])):
           if($_REQUEST['box'] == 0):
               $end_footer = "TaskInit.init();FormWizard.init();ComponentsEditors.init();"; 
           else:
               $end_footer = "TaskInit.init();FormWizard.init();ShowBoxDocument();ComponentsEditors.init();";
           endif;
       endif;
    else:
        $body = "<?php include 'security.php' ?>";
    endif;
    

    //CARGARA EL FOOTER O LOS SCRIPTS JS
    $footer = "<script src='js/Functions.js'></script>";
    $footer .= '<script type="text/javascript" src="../../assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>';
    $footer .= '<script src="../../assets/global/plugins/jstree/dist/jstree.min.js"></script>'
            . '<script type="text/javascript" src="../../assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>'
            . '<script type="text/javascript" src="../../assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>';
  
    //PREPARANDO LA VISTA ...
    ViewClass::PrepareView("View.phtml", "Admin");
    
    //LLAMANDO LA VISTA
    ViewClass::SetView(ViewClass::SetParamsString($body ,$header , $end_footer , $footer));
    
    
    //AGREGA LAS TAREAS