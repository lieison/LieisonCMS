<?php

include   '../../../../Conf/Include.php';

set_dependencies(array(
    "LogsController"
));


 $dir = FunctionsController::GetRootUrl("task");
 
 echo $dir . "<br>";
 if($dir){
     echo "existe";
 }
 else{
     echo "no existe";
 }
 
 $log = new LogsController("../../task/");
 $log->SetLog("prueba");
 $log->CloseLog();
