<?php

include   '../../../../Conf/Include.php';

//INICIAMOS SESION
Session::InitSession();

//CARGAMOS LA DEPENDENCIA
set_dependencies(array(
    "MessageController"
));

//OBTENEMOS EL ID DEL MENSAJE 
$id     =   $_GET['id_message'];

//CARGAMOS EL CONTROLADOR
$msj = new MessageController();

//OBTENEMOS LOS DATOS 
$request = $msj->GetChatById($id);

//CONVERTIMOS EN FORMATO JSON 
echo "<pre>";
print_r($request);
echo "</pre>";
