<?php

include '../../../Conf/Include.php';

session_start();

$url = "http://" . $_COOKIE['SERVER'] . "/" . $_COOKIE['FOLDER'];
$header = new Http\Header();
 
if(isset($_SESSION['login'])):
    unset($_SESSION['login']);
    $id_log = $_SESSION['log'];
    unset($_SESSION['log']);
    session_destroy();
    $hora_salida =date("H:i:s",time()-3600);
    $admin = new AdminController();
    $admin->Update_log($id_log, $hora_salida);
    $header->redirect($url . "/Content/Web/admin/login.php");
endif;
