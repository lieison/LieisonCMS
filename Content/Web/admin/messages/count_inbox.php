<?php


 include   '../../../Conf/Include.php';
 
 Session::InitSession();
 
 set_dependencies(array(
        "AdminController",
        "MessageController"
  ));
 
 $messagecontroller = new MessageController();
 
 $id_user = $_SESSION['login']['id'];
 $count = $messagecontroller->GetMessageCountFrom($id_user);
 $msjto = $messagecontroller->GetMessageFrom($id_user , null);
 $count_submsj = 0;
 
 if(count($msjto) == 0){
      $msjto = $messagecontroller->GetMessageTo($id_user , null);
 }
 foreach ($msjto as $k=>$v){
     $r = $messagecontroller->GetCountSubMessage($v['id_mensaje'] , $id_user);
     $count_submsj += count($r);
 }
 
 $count += $count_submsj;
 if($count == 0){
     echo 0;
 }
 else{
     echo $count;
 }
 
 unset($messagecontroller);
 

 
