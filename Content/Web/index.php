<?php 

    /*
     * SE CANCELO EL FRONT END ASI QUE 
     * REDIRIGIMOS DIRECTAMENTE AL CMS
     */

    include   '../Conf/Include.php'; 
    $head = new Http\Header();
    $head->redirect("admin/");
?>

