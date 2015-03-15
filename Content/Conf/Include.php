<?php

/**
 * @author Rolando Arriaza
 * @access public
 * @version 1.2
 * @since 2015
 * 
 * INCLUDE.PHP
 * SE INCLUIRAN TODOS LOS SCRIPTS DEL PLUGIN 
 * SI REMUEVE ALGUN SCRIPT PUEDE QUE EL PLUGIN NO FUNCIONE COMO DEBE
 * DADO CASO NO FUNCIONE , REVISAR LAS RUTAS DEL SCRIPT
 * 
 * NOTA: 
 *      LOS SCRIPTS DENTRO DE LA CARPETA MODEL Y CONTROLLER SE AGREGARAN AUTOMATICAMENTE
 * 
 */

require 'Config.php';

$GLOBAL_ROOT = $CONFIG_["DIR"]["root"];
$GLOBAL_DIRECTORY = $CONFIG_["DIR"]["directory"];
$FOLDER = $CONFIG_["APP_FOLDER"];


/**
 * LLAMADA DE LAS BASES DE DATOS 
 * NO DEPENDE LA UNA DE LA OTRA
 */
include $GLOBAL_ROOT . $FOLDER . '/Content/Class/Database/Class.Mysql.php';
include $GLOBAL_ROOT . $FOLDER . '/Content/Class/Database/Class.Sqlite.php';
include $GLOBAL_ROOT . $FOLDER . '/Content/Class/Database/Class.Oci8.php';


/**
 * LLAMADA DE LAS CLASES DIRECTORY
 * directory.php no depende de otra clase
 * file.php depende de directory
 */
include $GLOBAL_ROOT . $FOLDER . '/Content/Class/Directory/Class.Directory.php';
include $GLOBAL_ROOT . $FOLDER . '/Content/Class/Directory/Class.File.php';


/**
 * LLAMADA DE CAPTCHA
 * BaseCaptcha.php depende de Captcha.php
 */
require $GLOBAL_ROOT . $FOLDER . '/Content/Class/Tools/Captcha.php';
require $GLOBAL_ROOT . $FOLDER . '/Content/Class/Tools/BaseCaptcha.php';



/**
 * Google 
 */

require $GLOBAL_ROOT . $FOLDER . '/Content/Class/Google/GoogleTranslate.php';
require $GLOBAL_ROOT . $FOLDER . '/Content/Class/Google/GoogleAnalyticsAPI.class.php';

/**
 * LLAMADA DE PAGINACION
 * basepaginacion.php depende de paginacion.php
 */
require $GLOBAL_ROOT . $FOLDER . '/Content/Class/Pagination/Class.Paginacion.php';
require $GLOBAL_ROOT . $FOLDER . '/Content/Class/Pagination/Class.BasePaginacion.php';


/**
 * LLAMADA DE DISTINTAS CLASES
 * CADA CLASE ES INDEPENDIENTE DE LA OTRA
 */

require $GLOBAL_ROOT . $FOLDER . '/Content/Class/Tools/Encriptacion.php';
require $GLOBAL_ROOT . $FOLDER . '/Content/Class/Tools/Validation.php';
require $GLOBAL_ROOT . $FOLDER . '/Content/Class/Tools/CurlAccess.php';
require $GLOBAL_ROOT . $FOLDER . '/Content/Class/Tools/JsonClass.php';
require $GLOBAL_ROOT . $FOLDER . '/Content/Class/Tools/JSON.php';
require $GLOBAL_ROOT . $FOLDER . '/Content/Class/Tools/Calendar.php';
require $GLOBAL_ROOT . $FOLDER . '/Content/Class/Tools/RegexClass.php';
require $GLOBAL_ROOT . $FOLDER . '/Content/Class/Tools/UrlClass.php';
/**
 * LLAMADA DE LAS CLASES EN EL DIRECTORIO VIEW 
 * 
 */

require $GLOBAL_ROOT . $FOLDER . '/Content/Class/View/ViewLoader.php';
require $GLOBAL_ROOT . $FOLDER . '/Content/Class/View/ImageRender.php';


/* CLASE PHP MAIL , HEREDA CLASES EXTERNAS DENTRO DEL DIRECTORIO Mail**/

require $GLOBAL_ROOT . $FOLDER . '/Content/Class/Mail/PHPMailerAutoload.php';

/*LLAMADA DE LA CLASE HEADER **/
require $GLOBAL_ROOT . $FOLDER . '/Content/Class/Http/Class.Header.php';
require $GLOBAL_ROOT . $FOLDER . '/Content/Class/Http/Class.HttpClient.php';

/** API PDF */

/**
 * SE DEBE DE INSTALAR PHP_IMAGIC.DLL COMO EXTENSION
 * PARA EL USO DE ESTA CLASE
 */

//require 'Class/Pdf/Class-PdfToImage.php';

require $GLOBAL_ROOT . $FOLDER . '/Content/Class/Pdf/Class-Fpdf.php';
require $GLOBAL_ROOT . $FOLDER . '/Content/Class/Pdf/exportPDF.class.php';


/**
 * E-COMMERCE CLASS 
 */

//require $GLOBAL_ROOT . $FOLDER . '/Content/Class/Ecommerce/GoPaypal.class.php';
require $GLOBAL_ROOT . $FOLDER . '/Content/Class/Ecommerce/ccvalidator.class.php';


/**AGREGANDO PLUGINS**/

 $Dir_ = new _Directory();
 $path_plugins = $Dir_->FindDataDirectory($GLOBAL_ROOT . $FOLDER ."/Content/Class/Plugins/" , 
         array("name"=>"index" , "extend"=> "php" ,  "pattern"=>false));
 foreach ($path_plugins as $k=>$val)
 {
     require $val['root'] . '/' . $val['filename'];
 }

/**
 * Modelos | Models
 */
 $Dir_ = new _Directory();
 $path_model = $Dir_->FindDataDirectory($GLOBAL_ROOT . $FOLDER ."/Content/Models/");
 foreach ($path_model as $k=>$val)
 {
     require $val['root'] . '/' . $val['filename'];
 }

 
 /**
  * View del sistema
  */
 
  require $GLOBAL_ROOT . $FOLDER . '/Content/View/ViewClass.php';
 
  
  
 /**
 * Controladores | Controllers
 */
$Dir_ = new _Directory();
$path_controller = $Dir_->FindDataDirectory($GLOBAL_ROOT . $FOLDER ."/Content/Controllers/");
foreach ($path_controller as $k=>$val)
{
     require $val['root'] . '/' . $val['filename'];
}

  
 /**
  * ACA SE AGREGARAN LOS SCRIPTS FUERA DEL NUCLEO DEL SISTEMA ...
  * **/
  
 require $GLOBAL_ROOT . $FOLDER . '/Content/Web/admin/ViewPage/ViewHeader.php';



?>
