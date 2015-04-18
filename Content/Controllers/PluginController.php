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
    

    public function __construct($path_origin = "Plugins", $path_plugin = "/") {
        parent::__construct($path_origin, $path_plugin);
    }
    
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
    
    public function UninstallModule($directory){
       
    }
    
}
