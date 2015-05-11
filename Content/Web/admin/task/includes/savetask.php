<?php

include   '../../../../Conf/Include.php';

$type = $_REQUEST['type'] ? : null;
if(SivarApi\Tools\Validation::Is_Empty_OrNull($type)):
    echo 0;
    exit();
endif;

/*
 *  var data = {
        "type":"task",
        "box_nodes" : BoxNodes,
        "other_docs":ODocs,
        "title":title,
        "deadline": deadline,
        "hourdead": hourdead,
        "id_client": id_client,
        "client_description": client_description,
        "id_user": id_user,
        "user_comment": user_comment,
        "user_activate":user_activate
        
   };
 * 
 */


$task = new TaskController();

Session::InitSession();

$id_user = Session::GetSession("login", "id");

switch ($type):
    case "task":
        $task->SaveTask(array(
            "id_client" => $_REQUEST['id_client'],
            "id_u_from" => $id_user, 
            "description" => $_REQUEST['client_description'],
            "title" => $_REQUEST['title'],
            "status" => 1
        ),
        array(
             
         ));
        break;
    case "multitask":
        break;
endswitch;

unset($task);

