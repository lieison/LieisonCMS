<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TinyMce
 *
 * @author rolandoantonio
 */



class TinyMce {
    
    
    var $plugins = array('autolink', 
        'lists', 'image', 
        'charmap', 'print', 
        'preview', 'anchor', 
        'pagebreak', 'code', 
        'save', 'textcolor', 
        'colorpicker', 
        'importcss' , 'link image' , ' lists link image charmap print preview hr anchor pagebreak advlist autolink' , 
        'wordcount visualblocks visualchars code fullscreen' , 
        'insertdatetime media nonbreaking save table contextmenu directionality',
        'emoticons template paste textcolor colorpicker textpattern responsivefilemanager ');
    
    var $directory = "../Class/Plugins/TinyMce/";
    
    var $path = null;
    
    var $tiny_config = "";
    
    var $toolbar = "responsivefilemanager | insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons";
    
    var $width = null;
    
    var $height = null;
    
    var $theme = "";
    
    var $textarea_name = null;
    
    var $file_manager_path = "";
    
    var $file_manager_external_p = "";
    
    var $title = "FILE MANAGER";
    
    public function __construct($width = 600 , $height = 600 , $theme = "modern" , $file_manager_path = null) {
       
        include $_SERVER['DOCUMENT_ROOT'] . $_COOKIE['FOLDER'] . "/Content/Conf/Config.php";
        $GLOBAL_ROOT = $CONFIG_["DIR"]["root"];
        $FOLDER = $CONFIG_["APP_FOLDER"];
        $this->path = $GLOBAL_ROOT  . $FOLDER;
        $this->width = $width;
        $this->height = $height;
        $this->theme = $theme;
        if(!SivarApi\Tools\Validation::Is_Empty_OrNull($file_manager_path)):
            $this->file_manager_path = $file_manager_path;
        else:
            $this->file_manager_path = $CONFIG_["DIR"]["protocol"] . $CONFIG_["DIR"]["server"] .
                "/" . $CONFIG_["APP_FOLDER"] . "/Content/Class/Plugins/TinyMce/filemanager/";
        endif;
        
         $this->file_manager_external_p =  $CONFIG_["DIR"]["protocol"] . $CONFIG_["DIR"]["server"] .
                "/" . $CONFIG_["APP_FOLDER"] . "/Content/Class/Plugins/TinyMce/filemanager/plugin.min.js";
        
    }
    
    public function SetTheme($theme)
    {
         $this->theme = $theme;
    }
    
    
    public function SetFilemanagerTitle($title )
    {
        $this->title = $title;
    }
    
    
    public function  AddPlugins($plugin_name , $remove_default_plugin = FALSE )
    {
        if($remove_default_plugin == true):
            $this->plugins = array();
        endif;
        
        if (!is_array($plugin_name)) :
            array_push($this->plugins, $plugin_name);
        else :
            foreach ($plugin_name as $value):
                $this->plugins[] = $value;
            endforeach;
       endif;
    }
    
    public function GetTinyHeader($text_area = null)
    {
        $area = null;
        $this->textarea_name = $text_area;
        
        $string_plugin = implode(" ", $this->plugins);
        
        if (SivarApi\Tools\Validation::Is_Empty_OrNull($text_area)) :  
            $area = "textarea";
        else :
             $area = "textarea#$text_area";
        endif;
        $this->tiny_config .= $this->Resources();
        $this->tiny_config .= "<script>";
        $this->tiny_config .= "tinymce.init({"
                              . "selector: '$area',"
                              . "theme:'$this->theme' ," 
                              . "width: $this->width, height: $this->height,"
                              . "plugins:['$string_plugin'],"
                              . "toolbar:'$this->toolbar' ,"
                              . "relative_urls:false,"
                              . "image_advtab: true,"
                              . "filemanager_title:'$this->title',"
                              . "filemanager_crossdomain:true,"
                              . "external_filemanager_path:'$this->file_manager_path',"
                              . "codemirror: { indentOnInit: true, path: 'CodeMirror'},"
                              . "external_plugins: { 'filemanager' : '$this->file_manager_external_p'}"
                              . "});";
        $this->tiny_config .= "</script>";
        return $this->tiny_config;
    }
    
     
  
    
    public function GetTinyForm()
    {
        if(SivarApi\Tools\Validation::Is_Empty_OrNull($this->textarea_name)):
                return "<textarea></textarea>";
            else:
                return "<textarea name='$this->textarea_name' id='$this->textarea_name'></textarea>";
        endif;
    }
    
    
    
    private function Resources()
    {
        return '<script type="text/javascript" src="'   
        .  $this->directory . 'tinymce.min.js"></script>  ';
       
    }
    
    
} 
?>
