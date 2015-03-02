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
    
    //INSTANCIAMOS UN NUEVO HEADER DE REDIRECCIONAMIENTO
    $header = new Http\Header();
    
    //VERIFICAMOS SI LA SESION EXISTE
    if(!isset($_SESSION['login'])):
        $header->redirect("Login.php");
    endif;
    
    $_SESSION['page_name']  = "Principal";
    
    ViewClass::PrepareView("View.phtml", "Admin");
    ViewClass::SetView("CUERPO DEL MENSAJE");
    
    
?>