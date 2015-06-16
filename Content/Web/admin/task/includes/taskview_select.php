<?php

include   '../../../../Conf/Include.php';

set_dependencies(array(
    "TaskController"
 ));

Session::InitSession();

$id = Session::GetSession("login", "id");
$task = new TaskController();

/**
 * TAREAS ASIGNADAS  
 */
$count_task =  $task->GetCountCreateTask($id);
echo "";


unset($task);