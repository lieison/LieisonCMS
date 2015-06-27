<?php

 include '../../../Conf/Include.php';

 set_dependencies(array( "AdminController"));
 
 $header = new Http\Header();
 $redirect = $_REQUEST['redirect'] ? : null;
 

 $url = null;
 $url_err = null;
 $url_index = null;
 
 if(SivarApi\Tools\Validation::Is_Empty_OrNull($redirect)):
     $url = "login.php";
     $url_err = "login.php?error=true";
     $url_index = "index.php";
 else:
     $url = "login.php?redirect=" . $_REQUEST['redirect'];
     $url_err = "login.php?error=true&redirect=" . $_REQUEST['redirect'];
     $url_index ="index.php?redirect=" . $_REQUEST['redirect'];
 endif;
 
 
 
 if(!isset($_POST['username'])):
     $header->redirect(FunctionsController::GetUrl($url));
 endif;
 
 $user = $_POST['username'];
 $pass = $_POST['password'];
 
 
if ( preg_match("/[^A-Za-z0-9]/", $user) ||  preg_match("/[^A-Za-z0-9]/", $pass) ):
    if(!\SivarApi\Tools\Validation::CheckEmail($user)):
             $header->redirect(FunctionsController::GetUrl($url_err));
             exit();
    endif;
endif;

 $admin_controller = new AdminController();

 $is_user = $admin_controller->GetLogin($user, $pass);
 
 $date = new DateTime();
 
 if($is_user):  
      $hora_entrada =  FunctionsController::get_time();
      $fecha = FunctionsController::get_date();
      $id_user = Session::GetSession("login", "id");
      if(!$admin_controller->SessionActive(Session::GetSession('login', "id_log"))):
          $id_log = $admin_controller->Create_Log($id_user, $hora_entrada, $fecha);
          $admin_controller->UpdateSession(Session::GetSession('login', "id_log"), 1);
      else:
          $_SESSION['DUPLICATE_SESSION'] = true;
      endif;
      $_SESSION['log'] = $id_log;
      $header->redirect(FunctionsController::GetUrl($url_index));   
 else:
      $header->redirect(FunctionsController::GetUrl($url_err));
 endif;
 
  

 


