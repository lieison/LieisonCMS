<?php

 include '../../../Conf/Include.php';
/**
 *                      "usuario" : jqInputs[0].value
                       "nombre":jqInputs[0].value,
                       "email": jqInputs[0].value,
                       "privilegios": jqselect[0].value,
                       "estado":jqselect[1].value
                       "key": aData[8]
 * 
 */

 $admin = new AdminController();
 
 $user = $_REQUEST['usuario'];
 $nombre = explode(" ", $_REQUEST['nombre']);
 
 if(count($nombre) >= 3):
     $nombre[0] = $nombre[0] . " " . $nombre[1];
     $nombre[1] = $nombre[2]  ;
     for($i=3; $i < count($nombre); $i++):
         $nombre[1] .= " " . $nombre[$i];
     endfor;
 endif;
 
 
 $mail = $_REQUEST['email'];
 $priv = $_REQUEST['privilegios'];
 $estado = $_REQUEST['estado'];
 $id = explode(",", $_REQUEST['key']);
 

 $login = array("user"=>$user , "activo"=> $estado , "rol"=>$priv);
 $user = array("nombre"=>$nombre[0] , "apellido"=>$nombre[1] , "email"=>$mail);
 
 $update = $admin->UpdateUsers($user, $login, $id[0], $id[1]);
 
 if($update):
     echo true;
 else:
     echo false;
 endif;