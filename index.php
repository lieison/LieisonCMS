<!DOCTYPE html>

<?php

      /**
       *@author Rolando <rmarroquin@lieison.com>
       *@version 1.0 
       *@copyright (c) Lieison, Working Together
       *@since 1.0 , index.php
       */

     /**
      * NO MODIFICAR 
      * CUALQUIER MODIFICACION PUEDE AFECTAR EL ENRUTAMIENTO Y REDIRECCIONAMIENTO 
      * DEL SISTEMA; TRABAJA CON UN SISTEMA DE DIRECCIONES RELATIVAS 
      * DADO CASO SE DEBE DETECTAR LA CARPETA DEL PROYECTO , RAIZ Y EL HOSTING 
      * 
      * SI ESTO FALLA , SE HA SEÑALADO COMO DEFAULT LA CARPETA LieisonCMS
      * ESTO SE PUEDE ALTERAR Y/O MODIFICAR EN Content/Conf/Config.php
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
     //header("Location: http://$SERVER__/$DIR_NAME/Content/Web/index.php" );  

     header("Location: http://$SERVER__/$DIR_NAME/Content/Web/admin/index.php" );  
     
?>

