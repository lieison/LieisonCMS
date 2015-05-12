<?php

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


include   '../../../../Conf/Include.php';

$type = $_REQUEST['type'] ? : null;

if(SivarApi\Tools\Validation::Is_Empty_OrNull($type)):
    echo 0;
    exit();
endif;

$task = new TaskController();
Session::InitSession();
$id_user = Session::GetSession("login", "id");
$encript = new \SivarApi\Tools\Encriptacion\Encriptacion();
$id_mt = $encript->Md5Encrypt((mt_rand(0, 1000) . mt_rand(100, 500) . $id_user . $_REQUEST['title']));
$box_files = $_REQUEST['box_nodes'] ? : "";

switch ($type):
    case "task":
     try{
        $val = $task->SaveTask(array(
            "id_multitask"          => $id_mt,
            "id_client"             => $_REQUEST['id_client'],
            "id_user_from"          => $id_user, 
            "description"           => htmlspecialchars($_REQUEST['client_description'] , ENT_QUOTES) ? : "ERROR",
            "title"                 => $_REQUEST['title'],
            "status"                => 1
        ),
        array(
            "id_multitask"          => $id_mt,
             "id_type"              => 1,
             "id_user_from"         => $id_user,
             "id_user_to"           => $_REQUEST['id_user'],
             "id_message"           => null,
             "date_asign"           => FunctionsController::get_date(),
             "time_asign"           => FunctionsController::get_time(),
             "box_files"            => $box_files,
             "files"                => $_REQUEST['other_docs'] ? : "",
             "comments"             => $_REQUEST['user_comment'],
             "date_deadline"        => FunctionsController::ReWriteDate($_REQUEST['deadline']),
             "time_deadline"        => $_REQUEST['hourdead'],
             "status"               => $_REQUEST['user_activate']
           ));
            
            if(!$val):
                echo 0;
            else:
                echo $id_mt;
            endif;
            
        } catch (Exception $ex){
            
            $error = "(" . FunctionsController::get_date() . ")";
            $error .= "(" . FunctionsController::get_time() . ")";
            $error .= "(ERROR==>" . $ex->getMessage() . ")";
            $dir = "../../task/logs/";
            $log = new LogsController($dir);
            $log->SetLog($error);
            $log->CloseLog();
        }
        
        break;
    case "multitask":
        break;
endswitch;


unset($task);

