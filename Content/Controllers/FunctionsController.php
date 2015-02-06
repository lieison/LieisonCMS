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
        $dir = new _Directory();
        echo "<pre>";
        print_r($dir->FindDataDirectory($directory , $pattern));
        echo "</pre>";
     }

}
