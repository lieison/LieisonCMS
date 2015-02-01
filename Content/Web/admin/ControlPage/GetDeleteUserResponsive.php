<?php


 include '../../../Conf/Include.php';
 
 if(!isset($_REQUEST['id'])):
     echo false;
     exit();
 endif;
 
 $id = explode(",", $_REQUEST['id']);
 $admin = new AdminController();
 $delete = $admin->DeleteUser($id[0], $id[1]);
 
 if($delete) echo true;
 else echo false;