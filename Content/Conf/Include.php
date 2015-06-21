<?php


/**
 * @author Rolando Arriaza
 * @access public
 * @version 1.2
 * @since 2015
 * 
 */


/*
 * Configuracion General del sistema
 * 
 */
include  'Config.php';


$GLOBAL_ROOT = $CONFIG_["DIR"]["root"];
$GLOBAL_DIRECTORY = $CONFIG_["DIR"]["directory"];
$FOLDER = $CONFIG_["DIR"]['folder'];

if(strrpos($GLOBAL_ROOT, "/") != true):
    $GLOBAL_ROOT .= "/";
endif;

$GLOBAL_PATH = "";


if(file_exists($GLOBAL_ROOT .  $FOLDER . '/Content/Class/index.php')):
    $GLOBAL_PATH = $GLOBAL_ROOT . $FOLDER ;
else:
    $GLOBAL_PATH = $GLOBAL_ROOT ;
endif;


/**
 * LLAMADA DE LAS BASES DE DATOS 
 * NO DEPENDE LA UNA DE LA OTRA
 */

include $GLOBAL_PATH . '/Content/Class/Database/Class.Mysql.php';


/**
 * LLAMADA DE LAS CLASES DIRECTORY
 * directory.php no depende de otra clase
 * file.php depende de directory
 */

include $GLOBAL_PATH . '/Content/Class/Directory/Class.Directory.php';
include $GLOBAL_PATH . '/Content/Class/Directory/Class.File.php';
require $GLOBAL_PATH . '/Content/Class/Directory/BnFileReader.php';


/**
 * LLAMADA DE CAPTCHA
 * BaseCaptcha.php depende de Captcha.php
 */
require $GLOBAL_PATH . '/Content/Class/Tools/Captcha.php';
require $GLOBAL_PATH . '/Content/Class/Tools/BaseCaptcha.php';



/**
 * Google 
 */

require $GLOBAL_PATH . '/Content/Class/Google/GoogleTranslate.php';
require $GLOBAL_PATH . '/Content/Class/Google/GoogleAnalyticsAPI.class.php';


/**
 * LLAMADA DE PAGINACION
 * basepaginacion.php depende de paginacion.php
 */

require $GLOBAL_PATH . '/Content/Class/Pagination/Class.Paginacion.php';
require $GLOBAL_PATH . '/Content/Class/Pagination/Class.BasePaginacion.php';


/**
 * LLAMADA DE DISTINTAS CLASES
 * CADA CLASE ES INDEPENDIENTE DE LA OTRA
 */

require $GLOBAL_PATH . '/Content/Class/Tools/Encriptacion.php';
require $GLOBAL_PATH . '/Content/Class/Tools/Validation.php';
require $GLOBAL_PATH . '/Content/Class/Tools/CurlAccess.php';
require $GLOBAL_PATH . '/Content/Class/Tools/JsonClass.php';
require $GLOBAL_PATH . '/Content/Class/Tools/JSON.php';
require $GLOBAL_PATH . '/Content/Class/Tools/Calendar.php';
require $GLOBAL_PATH . '/Content/Class/Tools/RegexClass.php';
require $GLOBAL_PATH . '/Content/Class/Tools/UrlClass.php';
require $GLOBAL_PATH . '/Content/Class/Tools/Time.php';
require $GLOBAL_PATH . '/Content/Class/Tools/Session.php';

/**
 * LLAMADA DE LAS CLASES EN EL DIRECTORIO VIEW 
 * 
 */

require $GLOBAL_PATH . '/Content/Class/View/ViewLoader.php';
require $GLOBAL_PATH . '/Content/Class/View/ImageRender.php';



require $GLOBAL_PATH . '/Content/Class/Mail/PHPMailerAutoload.php';


/*LLAMADA DE LA CLASE HEADER **/
require $GLOBAL_PATH . '/Content/Class/Http/Class.Header.php';
require $GLOBAL_PATH . '/Content/Class/Http/Class.HttpClient.php';

/** API PDF */

/**
 * SE DEBE DE INSTALAR PHP_IMAGIC.DLL COMO EXTENSION
 * PARA EL USO DE ESTA CLASE
 */

//require 'Class/Pdf/Class-PdfToImage.php';

require $GLOBAL_PATH . '/Content/Class/Pdf/Class-Fpdf.php';
require $GLOBAL_PATH . '/Content/Class/Pdf/exportPDF.class.php';



/**
 * PLUGIN CLASS
 */
require $GLOBAL_PATH . '/Content/Class/Plugins/PluginClass.php';
require $GLOBAL_PATH . '/Content/Class/Plugins/InstallClass.php';



/**AGREGANDO PLUGINS**/

 $Dir_ = new _Directory();
 $path_plugins = $Dir_->FindDataDirectory($GLOBAL_PATH ."/Content/Class/Plugins/" , 
         array("name"=>"index" , "extend"=> "php" ,  "pattern"=>false));
 foreach ($path_plugins as $k=>$val)
 {
     require $val['root'] . '/' . $val['filename'];
 }
 
 
/**
 * Modelos | Models
 */
 $Dir_ = new _Directory();
 $path_model = $Dir_->FindDataDirectory($GLOBAL_PATH ."/Content/Models/");
 foreach ($path_model as $k=>$val)
 {
     require $val['root'] . '/' . $val['filename'];
 }
 
 
 

/*
 * Helper
 * 
 * **/

$Dir_ = new _Directory();
$path_controller = $Dir_->FindDataDirectory($GLOBAL_PATH ."/Content/Helper/");
foreach ($path_controller as $k=>$val)
{
     require $val['root'] . '/' . $val['filename'];
}

/*
 * Library
 * 
 * **/

$Dir_ = new _Directory();
$path_controller = $Dir_->FindDataDirectory($GLOBAL_PATH ."/Content/Library/");
foreach ($path_controller as $k=>$val)
{
     require $val['root'] . '/' . $val['filename'];
}


  
 /**
  * View del sistema
  */
 
  require $GLOBAL_PATH . '/Content/View/ViewClass.php';
 

  
 /**
  * ACA SE AGREGARAN LOS SCRIPTS FUERA DEL NUCLEO DEL SISTEMA ...
  * **/
  
 require $GLOBAL_PATH . '/Content/Web/admin/ViewPage/ViewHeader.php';
 
 
 if(!function_exists("set_dependencies")){

    function set_dependencies(array $lib ){
        
          global $GLOBAL_PATH;

          $dir_      = $GLOBAL_PATH . "/Content/Controllers/" ;

          foreach($lib as $values){

               $depend = $dir_ . $values . ".php";

               if(file_exists($depend)){
                    include $depend;
               }

          }
    }

}




?>
