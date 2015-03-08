<?php 

    /**
     *@todo LIEISOFT CMS SCRIPT AUTOGENERACION
     *@author Rolando Arriaza <rmarroquin@lieison.com>
     *@version 1.x
     *@since 0.1
     */
    session_start();
    
    //INCLUIMOS LIBRERIA PRINCIPAL DONDE SE CARGAN TODAS LAS DEMAS LIBRERIAS O SCRIPTS
    include   '../../Conf/Include.php';
 
    $_SESSION['page_name']  = "Principal";
    
    //Condicion ... x+y=Z
    if(isset($_SESSION['title'])):
        unset( $_SESSION['title']);
        if(isset($_SESSION['home'])):
              unset($_SESSION['home']);
        endif;
    endif;
 
    
    //PREPARANDO LA VISTA ...
    ViewClass::PrepareView("View.phtml", "Admin");
    //LLAMANDO LA VISTA ... OBTENIENDO DATOS
    ViewClass::SetView(ViewClass::SetParamsString("" ,"" , "" , ""));
    
