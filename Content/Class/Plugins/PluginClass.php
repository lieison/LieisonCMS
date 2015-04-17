<?php namespace Plugin;



class PluginClass extends \_Directory {
    
    protected $path         = NULL;
    protected $path_plugin  = NULL;

    public function __construct($path_origin = "Plugins" , $path_plugin = "/") {
        $this->path = $path_origin;
        $this->path_plugin = $path_plugin;
    }
    
    public function __destruct() {
        unset($this);
    }
    
    public function SetPathPlugin($path_plugin ){
         $this->path_plugin = $path_plugin;
    }
    
    public function UnZipPlugin(){
        $result = $this->VerifyPlugin();
        
        $flag_install = array();
        $flag_index = true;
        
        if(\SivarApi\Tools\Validation::Is_Empty_OrNull($result)){
            return null;
        }
        if(!is_array($result)){
            return null;
        }
        
        foreach($result as $k=>$v){
            if( $v['root'] == $this->path && strtolower($v['filename']) == "install.php" ){ 
                $flag_install = array( 0=>$v['root'] , 1=> $v['filename'] );
            }
            if( $v['root'] == $this->path && strtolower($v['filename']) == "index.php" ){ $flag_install = true;}
        }
        
        if($flag_index == TRUE && is_array($flag_install))
        {
            return $flag_install;
        }else {
            return null;
        }
    }
    
    private function VerifyPlugin(){
        $zip = new \ZipArchive();
        if(!$zip->open($this->path_plugin)){
            return null;
        }
        $zip->extractTo($this->path);
        $zip->close();
        $explode = explode(".zip", $this->path_plugin);
        $this->path = $explode[0];
        $data = parent::FindDataDirectory($this->path);
        return $data;
    }
    
    
    
}
