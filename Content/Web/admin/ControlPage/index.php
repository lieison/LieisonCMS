<?php 

    /**
     *@todo LIEISOFT CMS SCRIPT AUTOGENERACION
     *@author Rolando Arriaza <rmarroquin@lieison.com>
     *@version 1.x
     *@since 0.1
     */
     Session::InitSession();
    
    //INCLUIMOS LIBRERIA PRINCIPAL DONDE SE CARGAN TODAS LAS DEMAS LIBRERIAS O SCRIPTS
    include   '../../../Conf/Include.php';
    $header = new Http\Header();
    $header->redirect("../index.php");
    
?>