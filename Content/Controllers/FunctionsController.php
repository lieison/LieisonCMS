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
    
    public static function GetUrl($link)
    {
        return $url = "http://" . $_COOKIE['SERVER'] . "/" . $_COOKIE['FOLDER'] . "/Content/Web/admin/$link";
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
    
    public static function  get_date()
    {
        return  date("Y-m-d");
    }


    public static function get_directory_tree($directory , $pattern = null)
    {
        $directory = self::GetRootUrl($directory);
        $dir = new _Directory();
        return $dir->FindDataDirectory($directory , $pattern);
     }
     
    public static function get_actual_page()
     {
        $data_server =  $_SERVER['REQUEST_URI'];
        $data_server = explode("/" , $data_server);
        if (count($data_server) < 2) {
            $data_server = explode("\\" , $data_server);
            if(count($data_server) < 2)
                return $data_server[0];
            else
                return $data_server[count($data_server) - 1];
        } else {
            return $data_server[count($data_server) - 1];
        }
    }
    
    public static function get_paises()
    {
        $mysql = new MysqlConection();
        return $paises = $mysql->RawQuery("SELECT PAI_PK  as id , PAI_NOMBRE as nombre FROM pais");
    }
    
    

}
