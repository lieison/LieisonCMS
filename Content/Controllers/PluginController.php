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
    
    var $plugins_installed  = array();
    
    
    
    public function __construct($path_origin = "Plugins", $path_plugin = "/") {
        parent::__construct($path_origin, $path_plugin);
    }
    
    public function GetAllModules(){
        
        $this->filter = array();
        $this->plugins_installed = array();
        
        $data = parent::FindDirectory($this->path);
        for($i=0 ; $i < count($data); $i++){
            if(is_dir($this->path . "" . $data[$i])){
                $plug = parent::FindDataDirectory($data[$i] , array("name"=>"conf" , "extend"=> "json"));
                if(!empty($plug)){
                     $this->filter[] = array("root"=> $plug[0]['root'] , "file" => $plug[0]['filename'] );
                }
            }
        }

        for($i=0 ; $i < count($this->filter); $i++){
            $string_root = str_replace('\\', "/",$this->filter[$i]['root'] );
            $archive =  $string_root . "/" . $this->filter[$i]['file'] ;
            $json_decode = new \SivarApi\Tools\Json_class();
            $json_decode->JsonFile($archive);
            $this->plugins_installed[] = 
                    array(
                        "root"      => $string_root . "/" , 
                        "decode"    => $json_decode->GetDecodeJsonFile(JSON_CLASS)
                    );
        }
        
        return $this->plugins_installed;
 
    }
    
}
