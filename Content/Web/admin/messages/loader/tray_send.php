<?php


include   '../../../../Conf/Include.php';

//INICIAMOS SESION
Session::InitSession();

$to         = $_GET['msj_to'];
$from       = Session::GetSession("login", "id");
$business   = $_GET['msj_bussines'];
$msj        = $_GET['msj'];

//CARGAMOS LA DEPENDENCIA
set_dependencies(array(
    "MessageController"
));
$messages = new MessageController();
$request = $messages->SetMessage($to, $from, $msj, $business);
echo $request;
unset($messages);
exit();
