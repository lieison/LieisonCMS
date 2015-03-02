<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ViewClass
 *
 * @author rolandoantonio
 */
 class ViewClass {
     
     static $pointer = null;
     static $relative_route = "/Content/View/";
     static $end_route = null;
     
     public static function PrepareView($pointer , $end_route = null)
     {
         self::$pointer = $pointer;
         self::$end_route = $end_route;
     }
     
     public static function ChangeRelativeRoute($route = "/Content/View/")
     {
         self::$relative_route = $route;
     }
     
     
     public static function SetView($params = array())
     {
         $route = $_SERVER['DOCUMENT_ROOT'] .  "/" . $_COOKIE['FOLDER'] . 
                 self::$relative_route . 
                 self::$end_route . "/" . self::$pointer ? : "/" . self::$pointer;

         if(file_exists($route) && is_readable($route))
         { 
             if(count($params) >= 1)
             {
                 
                 if(file_exists($route . ".bak")){
                     copy($route . ".bak" , $route);
                 }else{
                    copy($route, $route . ".bak");
                 }
                 
                        $temp_file = file_get_contents($route);

                         if($params['B'] != "%{BODY_CLASS_VIEW}%"){
                           $temp_file = str_replace("%{BODY_CLASS_VIEW}%", $params['B'] , $temp_file);
                         }
                         if($params['H'] != "%{HEADER_CLASS_VIEW}%"){
                           $temp_file = str_replace("%{HEADER_CLASS_VIEW}%", $params['H'] , $temp_file);
                         }
                         if($params['F'] != "%{FOOTER_CLASS_VIEW}%"){
                           $temp_file = str_replace("%{FOOTER_CLASS_VIEW}%", $params['F'] , $temp_file);
                         }
                         
                 file_put_contents($route, $temp_file);
                 include $route;
                 
             }else{
                include $route;
             }
         }
         return null;
     }   
     
     /**
      * TYPE = INCLUDE , STRING minusculas
      */
     public static function SetParamsString( $body ="%{BODY_CLASS_VIEW}%" ,
             $header = "%{HEADER_CLASS_VIEW}%", $footer = "%{FOOTER_CLASS_VIEW}%")
     {
         return array(  "B"=>$body , "H"=>$header , "F"=>$footer);
     }
     

    
}
