<?php
 include '../../../Conf/Include.php';

 set_dependencies(array( "AdminController"));
 
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
 
 if(!\SivarApi\Tools\Validation::Is_Empty_OrNull($mail)):
     if(!\SivarApi\Tools\Validation::CheckEmail($mail)):
          echo "mail";
          exit();
     endif;
     elseif(\SivarApi\Tools\Validation::Is_Empty_OrNull($user)):
         echo "user";
         exit();
     elseif(is_array($nombre)):
            if(count($nombre) == 0):
                echo "nombre";
                exit();
            endif;
     elseif(\SivarApi\Tools\Validation::Is_Empty_OrNull($nombre)):
         echo "nombre";
         exit();
     elseif(\SivarApi\Tools\Validation::Is_Empty_OrNull($mail)):
         echo "mail";
         exit();
 endif;
 
 
 $id = $user . rand(0, 100) . $priv . rand(5000, 20000) . rand(500, 1000);
 $password = \SivarApi\Tools\Encriptacion\Encriptacion::encrypt($user);
 
 $fecha_actual = date("Y-m-d");
 

 $login = array( "id_usuario"=>$id , 
     "password"=>$password , 
     "user"=>$user , 
     "activo"=> $estado , 
     "rol"=>$priv ,
     "fecha"=>$fecha_actual);
 
 $user = array( "id_usuario"=>$id ,
     "nombre"=>$nombre[0] , 
     "apellido"=>$nombre[1] , 
     "email"=>$mail);
 
 $create = $admin->CreateUser($user, $login);
 
 if($create):
     echo true;
 else:
     echo false;
 endif;
