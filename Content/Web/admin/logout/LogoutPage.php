<?php



include '../../../Conf/Include.php';

set_dependencies(array( "AdminController"));

Session::InitSession();//INICIA SESION

$id_log         = NULL;
$hora_salida    = NULL;
$admin          = new AdminController();


 
while(Session::ExistSession("login")):
        $id_log         = Session::GetSession("log"); //OBTIENE EL LOG DE LOGUEO
        $hora_salida    = FunctionsController::get_time();//OBTIENE LA HORA DE SALIDA
        $admin->Update_log($id_log, $hora_salida); //ACTUALIZA EL LOG O BITACORA
        if(!Session::ExistSession("DUPLICATE_SESSION")){//VERIFICA SI ES SESION DUPLICADA
            $admin->UpdateSession($_SESSION['login']["id_log"], 0);
        }
        Session::DestroySession("", true);//LIBERA TODAS LAS VARIABLES DE SESION ... 
endwhile;

echo FunctionsController::GetUrl("login.php");

 
