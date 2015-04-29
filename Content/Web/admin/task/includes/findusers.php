<?php


include   '../../../../Conf/Include.php';

Session::InitSession();

$task = new TaskController(); //declaracion de la clase
echo $task->AsignTouser(session::GetSession("login" , "id"));
