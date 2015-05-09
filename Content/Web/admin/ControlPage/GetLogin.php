<?php

 include '../../../Conf/Include.php';
 
 $header = new Http\Header();


 if(!isset($_POST['username'])):
     $header->redirect(FunctionsController::GetUrl("login.php"));
 endif;
 
 $user = $_POST['username'];
 $pass = $_POST['password'];
 
if ( preg_match("/[^A-Za-z0-9]/", $user) ||  preg_match("/[^A-Za-z0-9]/", $pass) ):
    if(!\SivarApi\Tools\Validation::CheckEmail($user)):
             $header->redirect(FunctionsController::GetUrl("login.php?error=true"));
             exit();
    endif;
endif;

 $admin_controller = new AdminController();
 $is_user = $admin_controller->GetLogin($user, $pass);
 $date = new DateTime();
 
 if($is_user):
      $hora_entrada =  FunctionsController::get_time();
      $fecha = FunctionsController::get_date();
      $id_user = $_SESSION['login']["id"];
      
      if(!$admin_controller->SessionActive($_SESSION['login']["id_log"])){
          $id_log = $admin_controller->Create_Log($id_user, $hora_entrada, $fecha);
          $admin_controller->UpdateSession($_SESSION['login']["id_log"], 1);
      }
      else{
          $_SESSION['DUPLICATE_SESSION'] = true;
      }
      
      $_SESSION['log'] = $id_log;
      $header->redirect(FunctionsController::GetUrl("index.php"));
 else:
      $header->redirect(FunctionsController::GetUrl("login.php?error=true"));
 endif;
 
 
?>

