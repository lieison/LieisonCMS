<?php

include   '../../../../Conf/Include.php';

//INICIAMOS SESION
Session::InitSession();


//CARGAMOS LA DEPENDENCIA
set_dependencies(array(
    "MessageController"
));

$messages = new MessageController();

$r = $messages->GetMessageTo(Session::GetSession("login", "id"));

$a = array(
    "count" => sizeof($r),
    "data"  => $r
);

unset($messages);
echo json_encode($a);
exit();