<?php



/**
 * Description of Directorio
 *
 * @author rolandoantonio
 */
class _Directory {
    
    
    var $array_dir = array();
    
    
    public function __construct() {
        
    }
    
    public function CreateDirectory($path , $nombre_directorio)
    {
        $direccion = $path."/$nombre_directorio";
        if (!file_exists($direccion)) {
            mkdir($direccion, 777);
            RETURN TRUE;
        } else {
            RETURN FALSE;
        }
    }
    
    public function CopyFullDirectory( $source, $target ) {
    if ( is_dir( $source ) ) {
        @mkdir( $target , 777);
        $d = dir( $source );
        while ( FALSE !== ( $entry = $d->read() ) ) {
            if ( $entry == '.' || $entry == '..' ) {
                continue;
            }
            $Entry = $source . '/' . $entry; 
            if (is_dir($Entry)){
                CopyFullDirectory( $Entry, $target . '/' . $entry );
                continue;
            }
            copy( $Entry, $target . '/' . $entry );
        }
         $d->close();
    }else {
        copy( $source, $target );
    }
}

    /**
     *@version 1.0
     *@author Rolando Arriaza , ultima version
     *@todo Funcion para crear un arbol de archivos
     *@param string $directory directorio donde comenzara el arbol
     *@param string|array patron en cual el archivo debe respetar
     *@example  
     * <code>
     *   buscaremos los archivos que inicien en dashboard como dashboard.php o dashboard_img.jpg
     *   $pattern = "dashboard"
     * 
     *   busca archivos con el nombre inicial dashboard y extencion php
     *   $pattern = array("name"=>"dashboard" , "extend"=>"php");

     * </code>
     *@return bool | array false si no existe directorio 
     */
    public function FindDataDirectory($directory , $pattern = null)
    {
        if(!is_dir($directory)) { return false; }
      
        
         $object = new RecursiveIteratorIterator(
                        new RecursiveDirectoryIterator($directory),
                        RecursiveIteratorIterator::SELF_FIRST
                    );
        
        if(SivarApi\Tools\Validation::Is_Empty_OrNull($pattern))
        {
           
            foreach ($object  as $key=>$value){
                
                $class = new SplFileInfo($key);
                if( $class->getType() == "file"){
                    $filename = $class->getFilename();
                    $path = $class->getPath();
                    array_push($this->array_dir, array("root"=>$path , "filename"=>$filename));
                }
            }
        }
        else
        {
            
            $preg = null;
            
            if(is_array($pattern))
            {
                 $p = $pattern["name"];
                 $ext = $pattern["extend"];
                 $preg = "/^($p\w+\.$ext)$/";
            }else
            {
                $preg = "/^($pattern\w+\.php)$/";
            }
            
            foreach ($object  as $key=>$value){
                
                $class = new SplFileInfo($key);
                if( $class->getType() == "file"){
                    $filename = $class->getFilename();
                    $path = $class->getPath();
                    if(preg_match($preg, $filename)){
                        array_push($this->array_dir, array("root"=>$path , "filename"=>$filename));
                    }
                }
            }
        }
        return $this->array_dir;
    }
    
   
    
    
    
}
