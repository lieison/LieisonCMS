<?php

include   '../../../../Conf/Include.php';

//INICIAMOS SESION
Session::InitSession();

//CARGAMOS LA DEPENDENCIA
set_dependencies(array(
    "MessageController"
));

//OBTENEMOS EL ID DEL MENSAJE 
$message      =   $_GET['message'];
$iduser       =   Session::GetSession("login", "id");  
$id           =   $_GET['id'];

//CARGAMOS EL CONTROLADOR
$msj = new MessageController();

if($msj->SetSubmessage($id, $iduser, $message)){
    echo 1;
}else{ echo 0; }

exit();

