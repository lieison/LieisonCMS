<?php

include   '../../../../Conf/Include.php';

//INICIAMOS SESION
Session::InitSession();


//CARGAMOS LA DEPENDENCIA
set_dependencies(array(
    "MessageController"
));

$messages = new MessageController();

$r = $messages->GetMessageFrom(
        Session::GetSession("login", "id"),
        NULL, 
        2, 
        TRUE
     );

$a = array(
    "count" => sizeof($r),
    "data"  => $r
);

unset($messages);
echo json_encode($a);
exit();
