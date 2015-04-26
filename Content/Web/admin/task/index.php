<?php

    //INCLUIMOS LIBRERIA PRINCIPAL DONDE SE CARGAN TODAS LAS DEMAS LIBRERIAS O SCRIPTS
    include   '../../../Conf/Include.php';
    //INDEX APUNTA AL DIRECTORIO USER
    $header = new \Http\Header();
    $header->redirect("dashboard_index.php");