<?php

include   '../../../../../Conf/Include.php';

set_dependencies(array(
    "TaskController"
 ));

$id   = $_REQUEST['id'] ? : NULL;
$type = $_REQUEST['type'] ? : NULL;

if (SivarApi\Tools\Validation::Is_Empty_OrNull($id)) {
    exit();
}

$task = new TaskController();
$r    = $task->set_task_type($id, $type);
echo $r;
unset($r);
exit();