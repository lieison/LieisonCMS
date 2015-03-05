<?php

 include '../../../Conf/Include.php';
 
 $header = new Http\Header();
 $url = null;
 
 if(!isset($_COOKIE['SERVER'])):
     setcookie("SERVER" , $_SERVER["SERVER_NAME"]);
     setcookie("FOLDER" , $GLOBALS['FOLDER']);
     $url = "http://" . $_SERVER["SERVER_NAME"] . "/" . $GLOBALS['FOLDER'];
 else:
     $url = "http://" . $_COOKIE['SERVER'] . "/" . $_COOKIE['FOLDER'];
 endif;


 if(!isset($_POST['username'])):
     $header->redirect($url . "/Content/Web/admin/login.php");
 endif;
 
 $user = $_POST['username'];
 $pass = $_POST['password'];
 
if ( preg_match("/[^A-Za-z0-9]/", $user) ||  preg_match("/[^A-Za-z0-9]/", $pass) ):
    if(!\SivarApi\Tools\Validation::CheckEmail($user)):
             $header->redirect($url . "/Content/Web/admin/login.php?error=true");
             exit();
    endif;
endif;

 $admin_controller = new AdminController();
 $is_user = $admin_controller->GetLogin($user, $pass);
 $date = new DateTime();
 
 if($is_user):
      $hora_entrada =date("H:i:s",time()-3600);
      $fecha = date("Y-m-d");
      $id_user = $_SESSION['login']["id"];
      $id_log = $admin_controller->Create_Log($id_user, $hora_entrada, $fecha);
      $_SESSION['log'] = $id_log;
      $header->redirect($url . "/Content/Web/admin/index.php");
 else:
      $header->redirect($url . "/Content/Web/admin/login.php?error=true");
 endif;
 
 
?>

