<?php

/**
 * ESTE SCRIPT LE HACEN UNA LLAMADA AJAX DEL SCRIPT FUNCTION.JS
 * 
 *  function FindClients(){ ... }
 * 
 *@todo solo se necesita el echo a enviar los values al ajax..
 * 
 */

include   '../../../../Conf/Include.php';

$task = new TaskController(); //declaracion de la clase
echo $task->Show_SelectClient();//imprime el html option value

