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

$first  = $msj->GetMessageById($id);


if(count($first) == 0){
    $first = "";
}else{
    $first = $first[0]['mensaje'];
}

$data = array(
        "me"    => Session::GetSession("login", "id"),
        "chat"  => $request,
        "mensaje" => htmlspecialchars_decode($first, ENT_QUOTES) 
);

$json = new SivarApi\Tools\Services_JSON();
echo $json->encode($data);
exit();

//CONVERTIMOS EN FORMATO JSON 
//echo "<pre>";
//print_r($request);
//echo "</pre>";

