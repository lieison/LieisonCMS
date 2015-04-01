<?php

include '../../../Conf/Include.php';

session_start();
$header = new Http\Header();
 
if(isset($_SESSION['login'])):
    $id_log = $_SESSION['log'];
    session_destroy();
    $hora_salida = FunctionsController::get_time();
    $admin = new AdminController();
    $admin->Update_log($id_log, $hora_salida);
    if(!isset($_SESSION['DUPLICATE_SESSION'])){
        $admin->UpdateSession($_SESSION['login']["id_log"], 0);
    }
    unset($_SESSION['login']);
    unset($_SESSION['log']);
    unset($_SESSION['DUPLICATE_SESSION']);
    $header->redirect(FunctionsController::GetUrl("login.php"));
else:
    $header->redirect(FunctionsController::GetUrl("login.php"));
endif;
