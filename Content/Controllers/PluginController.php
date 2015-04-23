<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PluginController
 *
 * @author rolandoantonio
 */
class PluginController extends \Plugin\PluginClass {
    
    var $filter             = array();
    
    var $plugins            = array();
    

    /**
     *@author Rolando Arriaza
     *@todo  Contructor
     *@param string $path_origin direcotrio donde se instalara el plugin
     *@param string $path_plugin directorio donde se encuentra actualmente el plugin a cargar
     */
    public function __construct($path_origin = "Plugins", $path_plugin = "/") {
        parent::__construct($path_origin, $path_plugin);
    }
    
    
    /**
     * @author Rolando Arriaza
     * @todo  obtiene todos los modulos de los plugins instalados 
     * @return Mixed Array() : esta informacion la tiene del archivo json configuracion
     */
    public function GetAllModules(){
        
        $this->filter = array();
        $this->plugins_installed = array();
        
        $data = parent::FindDataDirectory($this->path , array("name"=>"conf" , "extend"=> "json"));
        for($i=0 ; $i <=count($data); $i++){
            if(!empty($data[$i])){
                    $this->filter[] = 
                    array(
                        "root"      => $data[$i]['root'] , 
                        "file"      => $data[$i]['filename']
                    );
                
            }
        }

        for($i=0 ; $i < count($this->filter); $i++){
            $string_root = str_replace('\\', "/",$this->filter[$i]['root'] );
            $archive =  $string_root . "/" . $this->filter[$i]['file'] ;
            $json_decode = new \SivarApi\Tools\Json_class();
            $json_decode->JsonFile($archive);
            $this->plugins[] = 
                    array(
                        "root"      => $string_root . "/" , 
                        "decode"    => $json_decode->GetDecodeJsonFile(JSON_CLASS)
                    );
        }
        
        return $this->plugins;
 
    }
    
    
    /**
     *@author Rolando Arriaza
     *@param string $directory directorio donde se instalara el plugin o modulo
     * 
     */
    public function InstallModule($directory){
        parent::SetPathPlugin($directory);
        $flag = parent::UnZipPlugin();
        return $flag;
    }
    
    
    public function GetConfigPlugin($path = null){
            if($path == null) {$path = "";}
            $path = $path . "config.json";
            $json_class = new \SivarApi\Tools\Json_class();
            $json_class->JsonFile($path);
            return $json_class->GetDecodeJsonFile(JSON_CLASS);
    }
    
    public function SetNewConfig($config , $path = null  ){
        if($path == null) {$path = "";}
        $json_class = new \SivarApi\Tools\Json_class();
        $path = $path . "config.json";
        $json_class->JsonFile($path);
        $json_class->SaveNewJasonFile($config, $path);
    }
    
    public function SetDashboard($section , $icon , $link , $title , $start_index , $priv){
        $mysql = new MysqlConection();
        $mysql->Insert(
                        "dashboard" , 
                        array(
                            "id_seccion" =>$section, 
                            "icono" =>$icon,
                            "link"=>$link,
                            "titulo"=>$title,
                            "start" =>$start_index,
                            "privilegios" =>$priv
                        )
                );
    }
    
    public function InstallModel($model_name , $path = null){
        $path_model = FunctionsController::GetRootUrl("Models" , true);
        $clean = str_replace("../" , "" , $path);
        $clean = str_replace("/" , "" , $clean);
        $dest_model = FunctionsController::GetRootUrl("admin/" . $clean);
        $dest_model .= "$model_name";
        if(file_exists($path_model)){
            if(file_exists($path)){
              if(@rename($dest_model, $path_model. "$model_name")){
                   return true;
               }
               else {
                   return false;
               } 
            }
        }
    }
    
    public function InstallController($controller_name , $path = null){
        $path_controller = FunctionsController::GetRootUrl("Controllers" , true);
        $clean = str_replace("../" , "" , $path);
        $clean = str_replace("/" , "" , $clean);
        $dest_c = FunctionsController::GetRootUrl("admin/" . $clean);
        $dest_c .= "$controller_name";
        if(file_exists($path_controller)){
            if(file_exists($path)){
               if(@rename($dest_c, $path_controller. "$controller_name")){
                   return true;
               }
               else {
                   return false;
               } 
            }
        }
       
    }
    
    
    public function UninstallModule($directory){
       
    }
    
}
