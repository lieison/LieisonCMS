<?php

/**
 * @version 1.0
 * @license MIT
 * @copyright (c) 2015, Lieison
 * 
 * ULTIMA ALTERACION 
 *      JUNIO 2015
 * 
 * ESTE SCRIPT SE MANEJA EN js/chat.js 
 * SE ENCARGA DE CARGAR AL SIDEBAR LOS CHATS
 * 
 * 
 */


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




