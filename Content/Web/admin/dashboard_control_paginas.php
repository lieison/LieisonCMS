<?php

    session_start();
    include   '../../Conf/Include.php';
    $header = new Http\Header();
    
    if(!isset($_SESSION['login'])):
        $header->redirect("Login.php");
    endif;
    
    $usuario = $_SESSION['login']['user'];
    $rol = $_SESSION['login']['rol'];
    $nombre = $_SESSION['login']['nombre'];
    $mail = $_SESSION['login']['email'];
    $activo = $_SESSION['login']['activo'];
    $id_user = $_SESSION['login']['id'];
    
    $imagen = $_SESSION['login']['imagen'];
    if(\SivarApi\Tools\Validation::Is_Empty_OrNull($imagen)):
        $imagen = "avatar.png";
    endif;
    
    if($activo == 0):
        $header->redirect("cuenta_desactivada.php");
    endif;
    
    $adminc = new AdminController();
    $nivel= $adminc->get_rols_values($rol);
    
    if($nivel == 50):
        $header->redirect("index.php");
    endif;
    
    FunctionsController::get_directory_tree("admin" ,  array("name"=>"dashboard" , "extend"=> "php"));
    
    
    ?>