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
$request = $msj->GetActiveUserChat($id);

$count_msj = $msj->GetCountSubMessage($id, Session::GetSession("login", "id"));

echo '<li title="' . $request['fecha'] . "&" . $request['hora'] . "&" . $count_msj . '" name="" id="chat_' . $id . '" class="media">';

if($count_msj != 0){
    echo '<div class="media-status">';
    echo '<a href=""><i class="fa fa-times-circle"></i></a><br>';
    echo '<span class="badge badge-success">' . $count_msj . '</span>';
    echo "</div>";
}else{
    echo '<div class="media-status">';
    echo '<a href=""><i class="fa fa-times-circle"></i></a>';
    echo "</div>";
}

echo '<img class="media-object" src="' .
        Url\Url::GetUrl("img/users/") .
        $request['avatar']  . '" alt="...">';
echo '<div class="media-body">';
echo '<h4 style="color:white;" class="media-heading">' . $request['to_name'] . '</h4>';
echo '<div class="media-heading-sub">';
echo '<p>' . $request['asunto'] . "</p>";
echo '<b>' . $request['Sales'] . "</b>";
echo '</div>';
echo '<div class="media-heading-small">';
echo '<p style="color:red;">Enviado el ' . $request['fecha'] . " a las " . $request['hora'] . "</p>";
echo '</div>';
echo '</div>';
echo "</li>";

unset($msj);

exit();

