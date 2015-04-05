<?php

include '../../../Conf/Include.php';

Session::InitSession();//INICIA SESION
$header = new Http\Header();//INSTANCIA EL HEADER
 
if(Session::ExistSession("login")): //VERIFICA SI EXISTE LA SESION LOGIN
    $id_log = Session::GetSession("log"); //OBTIENE EL LOG DE LOGUEO
    $hora_salida = FunctionsController::get_time();//OBTIENE LA HORA DE SALIDA
    $admin = new AdminController();//INSTANCIA EL CONTROLADOR DEL ADMIN
    $admin->Update_log($id_log, $hora_salida); //ACTUALIZA EL LOG O BITACORA
    if(!Session::ExistSession("DUPLICATE_SESSION")){//VERIFICA SI ES SESION DUPLICADA
        $admin->UpdateSession($_SESSION['login']["id_log"], 0);//EN DADO CASO NO SEA ENTONCES RESTABLECE LA ACTIVIDAD A CERO
    }
    Session::DestroySession("", true);//LIBERA TODAS LAS VARIABLES DE SESION ... 
    $header->redirect(FunctionsController::GetUrl("login.php"));//REDIRECT
else:
    $header->redirect(FunctionsController::GetUrl("login.php"));//REDIRECT
endif;
