<?php

/** 
 * @author Rolando Arriaza <rolignu90@gmail.com>
 * @copyright (c) 2012, ROLIGNU
 * @version 1.1
 * @license GPL
 */

   
 class FileExtension {
     
     
    static $extensions = array(
        "docx" =>"DocWord.png",
        "doc"=>"DocWord.png",
        "xml"=>"DocFile.png",
        "txt"=>"DocFile.png"
    );
        
    
    public static function GetIcon_extension($dir , $ext ,$fname = null)
    {
         $directory = new _Directory();
         $datafiles = $directory->FindDataDirectory($dir);
         foreach($datafiles as $key =>$value)
         {
             if($fname == $value['filename'] && $fname != null)
             {
                 foreach (self::$extensions as $k=>$v)
                 {
                     if ($k === $ext) {
                        return $v;
                    }
                }
             }
             else
             {
                 foreach (self::$extensions as $k=>$v)
                 {
                     if ($k === $ext) {
                        return $v;
                    }
                }
             }
         }
         
         return false;
    }
    
    /**
     * @param String $dir Establece el directorio a buscar (raiz)
     * @todo Busca archivos en un directorio especifico.
     * @return Array Devuelve los archivos encontrados
     */
    
  /*  public function FindFiles($dir = null)
    {
        $raiz = null;
        $arreglo_file = array();
        
        if ($dir == null) {
                $raiz = $this->dir;
            } 
        else {
                $raiz = $dir;
            }

            $directorio = opendir($raiz);
        while ($archivo = readdir($directorio))
        {
            if (!is_dir($archivo)) {
                    array_push($arreglo_file, $archivo);
                }
        }
        
        return $arreglo_file;
     }*/
     

    /* public function DownloadFile($direccion_archivo , 
             $nuevo_nombre = null , 
             $extencion = null)
     {
         if($extencion == null) $extension = pathinfo($direccion_archivo,PATHINFO_EXTENSION); 
         if($nuevo_nombre == null)
         {
            $name_ = pathinfo($direccion_archivo, PATHINFO_FILENAME); 
            header ("Content-Disposition: attachment; filename=". $name . "." .  $extencion); 
         }
         else
         {
             header ("Content-Disposition: attachment; filename=". $nuevo_nombre . "." . $extencion); 
         }
          
          header ("Content-Type: application/octet-stream");
          header ("Content-Length: ".filesize($direccion_archivo));
          readfile($direccion_archivo);
     }*/
     
   

      
   /**
   * @param String $nombre Nombre del archivo a crear
   * @param String $direccion Direccion del archivo a crear en dado caso si es null se crea en la raiz
   */
 /* public  function CreateFile($name , $adress , $extension="php")
   {
      if( !\SivarApi\Tools\Validation::Is_Empty_OrNull($name))
      {
         $archivo = fopen($adress  . "/" . $name . "." . $extension, "w");
         fclose($archivo); 
      }
   }
   */
    
}

