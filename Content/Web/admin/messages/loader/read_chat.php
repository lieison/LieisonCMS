<?php

include   '../../../../Conf/Include.php';

//INICIAMOS SESION
Session::InitSession();

//CARGAMOS LA DEPENDENCIA
set_dependencies(array(
    "MessageController"
));

//OBTENEMOS EL ID DEL MENSAJE 
$id     =   $_GET['id'];

//CARGAMOS EL CONTROLADOR
$msj = new MessageController();

$msj->SetReadChat($id);

exit();