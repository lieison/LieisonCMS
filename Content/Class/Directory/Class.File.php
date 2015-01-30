<?php

/** 
 * @author Rolando Arriaza <rolignu90@gmail.com>
 * @copyright (c) 2012, ROLIGNU
 * @version 1.1
 * @license GPL
 */

   
 class File extends _Directory {
        
    
    private $dir = null;
    private $att_name = null;
    private $arreglo = null;
    
    private $original_name = null;
    private $encrypt_name = null;
    
   
    /**
     * 
     * @param String $directorio Crea un nuevo directorio raiz donde se guardara los archivos 
     * @todo parametro opcional
     */
    
    function __construct($directorio = null)
    {

        if ($directorio != null) {
            $this->dir = dirname(__FILE__) . "/$directorio";
        } else {
            $this->dir = dirname(__FILE__) . "/images";
        }

        if(!file_exists($this->dir))
        {
            $priv = 777;
            mkdir($this->dir , $priv);
        }
    }
    
    
    /**
     * @todo obtiene el nombre original del archivo con su extencion
     * @return String devuelve una cadena con el nombre
     */
    
    public function GetOriginalName()
    {
        return $this->original_name ? : NULL;
    }
    
     /**
     * @todo obtiene el nombre encriptado del archivo con su extencion
     * @return String devuelve una cadena con el nombre encriptado
     */
    
    public function GetEncryptName()
    {
        return $this->encrypt_name ? : NULL;
    }
    
    /**
     * @param String $att_name Establece nombre del archivo $_FILES para ser manejado
     */
    
    public function SetNameFile($att_name)
    {
        $this->att_name = $att_name;
    }
    
    
    /**
     * @param String $new_name Establece un nuevo nombde al archivo en dado caso no exista se le dejara
     * el nombre ya expuesto.
     */
    
    public function UploadFile($new_name = "")
    {
        if(is_uploaded_file($_FILES[$this->att_name]['tmp_name'])){
            
            $name = "";
            $archivo=$_FILES[$this->att_name]['name']; 
            $this->original_name = $archivo;
         
            if ($new_name == "") {
                $name_ = pathinfo($archivo, PATHINFO_FILENAME);
            } else {
                $name_ = $new_name;
            }

            $extension = pathinfo($archivo,PATHINFO_EXTENSION); 
            $random = substr(md5(time().rand()),2,8);
            $name = base64_encode("$name_$random") . ".$extension"; 
            $this->encrypt_name = $name;
            
            if (move_uploaded_file($_FILES[$this->att_name]['tmp_name'], $this->dir . "/$name")) {
                
                $this->arreglo = array(
                    "nombre"=> $archivo,
                    "tipo"=>$_FILES[$this->att_name]['type'],
                    "extencion"=>$extension,
                    "encriptacion"=>$name,
                    "dimension"=>$_FILES[$this->att_name]['size'] / 1024
                );
                
                return true;
            } else {
                $this->showError();
                return false;
            }
        }
        else
        {
            $this->showError();
            return false;
        }
    }
    
    
    /**
     * @return Array Devuelve un arreglo con la informacion del archivo a subir
     */
    public function GetArray()
    {
        return $this->arreglo;
    }
    
    
    /**
     * @todo Muestra los errores
     */
    private function showError()
    {
        $err = $file[$this->att_name]['error'];
        echo "<br><b>Hubo un error inesperado ($err)</b>";
    }
    
    /**
     * @param String $dir Establece el directorio a buscar (raiz)
     * @todo Busca archivos en un directorio especifico.
     * @return Array Devuelve los archivos encontrados
     */
    
    public function FindFiles($dir = null)
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
     }
     
     /**
      * 
      */
     public function DownloadFile($direccion_archivo , 
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
     }
     
   
     
    public static function RootDirectory()
    {
        include '/Content/Conf/Conf.php';
        return  $configuracion["Dir"]["root"];
    }
      
      
   /**
   * @param String $nombre Nombre del archivo a crear
   * @param String $direccion Direccion del archivo a crear en dado caso si es null se crea en la raiz
   */
  public  function CreateFile($name , $adress , $extension="php")
   {
      if( !\SivarApi\Tools\Validation::Is_Empty_OrNull($name))
      {
         $archivo = fopen($adress  . "/" . $name . "." . $extension, "w");
         fclose($archivo); 
      }
   }
   
   /**
    * 
    */
   public function CreateDirectory($name , $adress  )
   {
      if( !\SivarApi\Tools\Validation::Is_Empty_OrNull($name))
      {
         $is_create = mkdir($adress  . "\\" . $nombre , $mode = 0777);
         return $is_create;
      }
   }
     
    
}

