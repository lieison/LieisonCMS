<?php


include   '../../../../Conf/Include.php';

Session::InitSession();

set_dependencies(array(
    "TaskController"
 ));

$task = new TaskController(); //declaracion de la clase
echo $task->AsignTouser(session::GetSession("login" , "id"));
