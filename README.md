# LIEISON CMS 
 
      
      @name LIEISON CMS
      @version 0.1
      @author Rolando Arriaza <Rolignu90@gmail.com>
      @copyright (c) 2015, LIEISON 
      @since 1.0

     




     /**
      * ¿DONDE AGREGAR MI PROYECTO?
      *  LOS PROYECTOS DEBEN SER AGREGADOS EN LA CARPETA "Content"
      *  POR EJEMPLO:
      *     TIENE UN PROYECTO EN LA CUAL CONSISTE DE 
      *     *js
      *     *image
      *     *css
      *     *index.php
      *  CADA ARCHIVO DEBE IR DENTRO DE LA CARPETA CONTENT
      *  YA QUE EL ENRUTADOR ESTA ESPECIFICADO PARA DICHO DIRECTORIO  
      */

     
     /**
      * NO MODIFICAR 
      * CUALQUIER MODIFICACION PUEDE AFECTAR EL PROGRAMA
      */

     $SERVER_DIR = getcwd();
     $ARRAY_DIR = explode("\\", $SERVER_DIR);
     $DIR_NAME = $ARRAY_DIR[count($ARRAY_DIR)-1];
     
     //OPCIONAL
     header("Cache-Control: no-cache");
     //OPCIONAL
     header("Pragma: no-cache");
     
     //NOMBRE DEL ARCHIVO EN LA CUAL INICIARA , GENERALMENTE ES UN INDEX.PHP    
     header("Location: /$DIR_NAME/Content/index.php" );  

     ***************************************************************************
