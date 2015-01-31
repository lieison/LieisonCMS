<!DOCTYPE html>

<?php

  
     
     /**
      * NO MODIFICAR 
      * CUALQUIER MODIFICACION PUEDE AFECTAR EL RESULTADO 
      */
     $SERVER_DIR = getcwd();
     $ARRAY_DIR = explode("\\", $SERVER_DIR);
     
     if(!is_array($ARRAY_DIR)):
         $ARRAY_DIR = explode("/", $SERVER_DIR);
     endif;
     $DIR_NAME = $ARRAY_DIR[count($ARRAY_DIR)-1];
     
     
     $SERVER__ = $_SERVER["SERVER_NAME"];
     //Agrega el directorio inicial del proyecto 
     //si se borra la cookie favor agregar el folder de forma manual en Conf/Config.php
     setcookie("FOLDER" , $DIR_NAME);
     setcookie("SERVER" , $SERVER__);
    
     //OPCIONAL
     header("Cache-Control: no-cache");
     //OPCIONAL
     header("Pragma: no-cache");
    
     //NOMBRE DEL ARCHIVO EN LA CUAL INICIARA , GENERALMENTE ES UN INDEX.PHP    
     header("Location: http://$SERVER__/$DIR_NAME/Content/Web/index.php" );  

     
     
?>

