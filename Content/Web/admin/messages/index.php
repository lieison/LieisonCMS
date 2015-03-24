<?php

   /**
     *@todo LIEISOFT CMS SCRIPT AUTOGENERACION
     *@author Rolando Arriaza <rmarroquin@lieison.com>
     *@version 1.x
     *@since 0.1
     */

    session_start();
    
    include   '../../../Conf/Include.php';
    $header = new Http\Header();
    $header->redirect("../index.php");