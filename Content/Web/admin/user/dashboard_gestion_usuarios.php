<?php

     //INCLUIMOS LIBRERIA PRINCIPAL DONDE SE CARGAN TODAS LAS DEMAS LIBRERIAS O SCRIPTS
    include   '../../../Conf/Include.php';
    
       
    set_dependencies(array(
        "AdminController"
    ));

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
    $body = "<?php include 'view_gestion.php' ?>";

    //CARGARA EL FOOTER O LOS SCRIPTS JS
    $footer = "<script src='PrimaryFunctions.js'></script>"
            . '<script src="../../assets/global/scripts/metronic.js" type="text/javascript"></script>
               <script src="../../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
               <script src="../../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
               <script src="../../assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
               <script src="../../assets/admin/pages/scripts/index.js" type="text/javascript"></script>
               <script src="../../assets/admin/pages/scripts/tasks.js" type="text/javascript"></script>
               <script type="text/javascript" src="../../assets/global/plugins/select2/select2.min.js"></script>
               <script type="text/javascript" src="../../assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
               <script type="text/javascript" src="../../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>';
    
    //CUIDADO SOLO CARGA LOS INITS DE JS ejemplo Load();
    $end_footer = "TablaUsuarios.init();";
    

    //PREPARANDO LA VISTA ...
    ViewClass::PrepareView("View.phtml", "Admin");
    
    //LLAMANDO LA VISTA
    ViewClass::SetView(ViewClass::SetParamsString($body ,$header , $end_footer , $footer));






