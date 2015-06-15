<?php

 include   '../../../Conf/Include.php';
 
  set_dependencies(array(
      "PageController",
      "AdminController"
  ));

 $id = $_REQUEST['id'] ? : null;
 $status = $_REQUEST['status'] ?: null;
 
 if($id == null && $status == null){
     exit();
 }
 
 if($status == 0):
     $status = 1;
 elseif($status == 1):
     $status = 0;
 endif;
 
 $page = new PageController();
 $page->Set_UpdateDashboard($id, array("status" => $status) , " id_dashboard LIKE $id");