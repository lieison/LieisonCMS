<?php namespace SivarApi\Tools;


/** 
 * @author Rolando Arriaza <rolignu90@gmail.com>
 * @copyright (c) 2014, ROLIGNU
 * @version 1.1
 * @license GPL
 * 
 * JsonClass.php es un script en la cual llamas un archivo en .json 
 * o guardas un archivo en formato json con sus respectivos datos
 * 
 * 
 * 
 */

define("JSON_ARRAY", "ARRAY");
define("JSON_CLASS", "CLASS");

class Json_class {
    
     private $jason_class = null; 
     private $jason_encode = null;
     

     public function __construct() {
         
     }
    
     /**
      * @version 1.0
      * @todo funcion en la cual establece el archivo a llamar .json 
      * @param String $archivo_json direccion donde se encuentra el archivo
      */
     public function JsonFile($archivo_json)
     {
         $str_json_conf = file_get_contents($archivo_json);
         $this->jason_encode = $str_json_conf;
         $class = json_decode($str_json_conf);
         $this->jason_class = $class;
     }
     
     /**
      * @version 1.0 
      * @todo obtiene los datos json 
      * @param String $option Como devolvera los datos  JSON_ARRAY = ARRAY() , JSON_CLASS=OBJECT()
      * @return object devuelve los datos transformados de json a array o object
      */
     public function GetDecodeJsonFile($option = JSON_ARRAY)
     {
          if($option == JSON_ARRAY){
             RETURN $this->objectToArray($this->jason_class);
          }
          else if ($option == JSON_CLASS)
          {
              RETURN $this->jason_class;
          }
     }
      
     /**
      * @version 1.1
      * @todo Guarda un archivo en formato json 
      * @param array | object $json_object establece el objeto o arreglo a guardar
      * @param type $name Description
      */
     public function SaveNewJasonFile($json_object , $direccion)
     {
          $fh = fopen($direccion, 'w')
            or die("Error al abrir fichero de salida");
         fwrite($fh, json_encode($json_object,JSON_UNESCAPED_UNICODE));
         fclose($fh);
     }
     
     
     private function objectToArray($jason_class) {
        
        $recursivo = (array)$jason_class;
        foreach($recursivo  as $key => &$field){
               if (is_object($field)) {
                $field = $this->objectToArray($field);
            }
        }
        return $recursivo ;
     }
     
     
    
}
