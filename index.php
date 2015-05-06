<!DOCTYPE html>

<?php

     /**
       *@author Rolando Arriaza 
       *@version 1.1
       *@copyright (c) SV API 2014
       *@since 1.5, index.php
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


     //OBTENIENDO RUTAS ...
     $SERVER_DIR = getcwd();
     $ARRAY_DIR = explode("\\", $SERVER_DIR);
     
     if(count($ARRAY_DIR)<=1):
         $ARRAY_DIR = explode("/", $SERVER_DIR);
     endif;
     
     //NOMBRE DEL DIRECTORIO 
     $DIR_NAME = $ARRAY_DIR[count($ARRAY_DIR)-1];
     
     
     //NOMBRE DEL SERVIDOR
     $SERVER__ = $_SERVER["SERVER_NAME"];
     
     //Agrega el directorio inicial del proyecto 
     //si se borra la cookie favor agregar el folder de forma manual en Conf/Config.php
     if(isset($_COOKIE['FOLDER'])):
         unset($_COOKIE['FOLDER']);
     endif;
     
     if(isset($_COOKIE['SERVER'])):
         unset($_COOKIE['SERVER']);
     endif;
     
     //INICIANDO COOKIES ...
     setcookie("FOLDER" , $DIR_NAME);
     setcookie("SERVER" , $SERVER__);
     setcookie("HOST" , $_SERVER['HTTP_HOST']);
    
     //OPCIONAL
     header("Cache-Control: no-cache");
     //OPCIONAL
     header("Pragma: no-cache");
    
     
     //NOMBRE DEL ARCHIVO EN LA CUAL INICIARA , GENERALMENTE ES UN INDEX.PHP  
     $url = "http://$SERVER__/$DIR_NAME/Content/Web/admin/index.php" ;
     if(url_exists($url)):
          header("Location: http://$SERVER__/$DIR_NAME/Content/Web/admin/index.php" ); 
     else:
          header("Location: http://$SERVER__/Content/Web/admin/index.php" ); 
     endif;
    
 
     //FUNCION PARA VERIFICAR URL SE AGREGO EN LA VERSION 1.5
    function url_exists( $url = NULL ) {

        if(( $url == '' ) ||( $url == NULL ) ){
            return false;
        }

        $headers = @get_headers( $url );
        sscanf($headers[0], 'HTTP/%*d.%*d %d', $httpcode);

    
        $accepted_response = array(200,301,302);
        if( in_array( $httpcode, $accepted_response ) ) {
            return true;
        } else {
            return false;
        }
    
   
   }

 
?>

