<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FunctionsController
 *
 * @author rolandoantonio
 */
class FunctionsController {
    
    
    public static function GetRootUrl($directory)
    {
        return $url = $_SERVER['DOCUMENT_ROOT'] .  "/" . $_COOKIE['FOLDER'] . "/Content/Web/$directory/";
    }
    
    public static function get_year(){
        return date('Y');
    }
    
    public static function get_month()
    {
        return date('m');
    }
    
    public static function get_day()
    {
        return date('d');
    }
    
    
    public static function get_directory_tree($directory , $pattern = null)
    {
        $directory = self::GetRootUrl($directory);
        
        if(is_dir($directory))
        {
          
         if ($dh = opendir($directory)) { 
         while (($file = readdir($dh)) !== false) { 
            //esta línea la utilizaríamos si queremos listar todo lo que hay en el directorio 
            //mostraría tanto archivos como directorios 
            //echo "<br>Nombre de archivo: $file : Es un: " . filetype($ruta . $file); 
            if (is_dir($directory . $file) && $file!="." && $file!=".."){ 
               //solo si el archivo es un directorio, distinto que "." y ".." 
               echo "<br>Directorio: $ruta$file"; 
             //  listar_directorios_ruta($ruta . $file . "/"); 
            } 
         } 
            closedir($dh); 
        } 
         
       
        if(SivarApi\Tools\Validation::Is_Empty_OrNull($pattern))
        {
            
        }
        else
        {
            
        }
           
        }
        
    }
    
}
