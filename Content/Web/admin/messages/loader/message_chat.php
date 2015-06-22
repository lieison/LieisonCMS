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


$request = $msj->GetChatById($id);

$data = array(
        "me"    => Session::GetSession("login", "id"),
        "chat"  => $request
);

$json = new SivarApi\Tools\Services_JSON();
echo $json->encode($data);
exit();

//CONVERTIMOS EN FORMATO JSON 
//echo "<pre>";
//print_r($request);
//echo "</pre>";

