<!DOCTYPE html>

<?php

     /**
       *@author Rolando Arriaza 
       *@version 1.8
       *@copyright (c) SV API 2015
       *@since 1.5, index.php
       * @todo Ultima actualizacion 1.8
       * 
       *     SE ACTUALIZO EL CORE EN LA DIFERENCIA DE DIRECTORIOS
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

      

     include __DIR__ . '/Content/Conf/Config.php' ;
     
     global $CONFIG_;
     
     
     $MASK              = $CONFIG_['MASK']['enable'];
     $MASK_TYPE         = $CONFIG_['MASK']['type'];
     
     $PROTOCOL          = $CONFIG_['DIR']['protocol'];
     $SERVER            = $CONFIG_['DIR']['server'];
     $FOLDER            = $CONFIG_['DIR']['folder'];

   
     header("Cache-Control: no-cache");
     header("Pragma: no-cache");

    
     if($FOLDER != NULL || $FOLDER != ""):
         $FOLDER = "/" . $FOLDER;
     endif;
     

     if($MASK):
          header("Location: " .  $PROTOCOL . $SERVER . $FOLDER . "/$MASK_TYPE/" ); 
     else:
         header("Location:" .  $PROTOCOL . $SERVER . $FOLDER . "/Content/Web/admin/index.php" ); 
     endif;
    
    


 
?>

