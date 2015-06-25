<?php

include   '../../../../Conf/Include.php';

//INICIAMOS SESION
Session::InitSession();

//CARGAMOS LA DEPENDENCIA
set_dependencies(array(
    "MessageController"
));

//VERIFICAMOS LOS MULTIPLES IDS 
$id         = explode(",",  $_GET['id_message']);

$array_     = array();


//RECORREMOS LOS IDS 
foreach($id as $value){
$msj = new MessageController(); //controlador
$request = $msj->GetActiveUserChat($value); //data
$count_msj = $msj->GetCountSubMessage($value, Session::GetSession("login", "id")); //cantidad de mensajes

$array_[] = array(
        "date"      => $request['fecha'],
        "time"      => $request['hora'],
        "count"     => $count_msj,
        "data"      => $request,
        "id"        => $value,
        "id_user"   => $request['id_user']
);

unset($msj);
}

function comparedate($a , $b){
    if($a['date'] < $b['date']){
        return $b;
    }
}

function comparetime($a , $b){
    return ($a['time'] < $b['time']);
}

function comparecount($a , $b){
    return ($a['count'] < $b['count']);
}

function compareuser($a , $b){
    return ($a['id_user'] < $b['id_user']);
}


uasort($array_, 'comparecount');
uasort($array_, 'comparetime' );
uasort($array_, 'comparedate' );
uasort($array_, 'compareuser' );


$flag_id         = NULL;
$count_chat      = count($array_);
$i = 1;

foreach ($array_ as $value){
    
   
   
    $c = $value['count'];
    $request = $value['data'];
    
    if($flag_id == NULL){
        $flag_id = $value['id_user'];
        echo ' <ul id="user_chat" class="media-list list-items">';
        echo '<h3 class="list-heading">' . $request['to_name']  . '</h3>';
    }
    else if($flag_id != $value['id_user']){
        $flag_id = $value['id_user'];
        echo '</ul>';
        echo ' <ul id="user_chat" class="media-list list-items">';
        echo '<h3 class="list-heading">' . $request['to_name'] . '</h3>';
    }
    
    
    $del = "javascript:delele_chat(" . $value['id'] .");";
    echo '<li  title="' . $request['to_rol']. '"  id="chat_' . $value['id'] . '" class="media">';
    if($c != 0){
        echo '<div class="media-status">';
        echo '<a href="' . $del . '"><i class="fa fa-times-circle"></i></a><br>';
        echo '<span class="badge badge-success">' . $c. '</span>';
        echo "</div>";
    }
    else{
        echo '<div class="media-status">';
        echo '<a href="' . $del . '"><i class="fa fa-times-circle"></i></a>';
        echo "</div>";
    }

    echo '<img class="media-object" src="' .
        Url\Url::GetUrl("img/users/") .
        $request['avatar']  . '" alt="...">';
    echo '<div onclick="chat_message('. $value['id'] .');" class="media-body">';
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
    
    if($i == $count_chat){
        echo "</ul>";
    }else{ $i++;}
    
}


exit();

