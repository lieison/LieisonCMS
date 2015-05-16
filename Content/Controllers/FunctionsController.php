<?php

    
 /**
 *@author Rolando Antonio Arriaza <rmarroquin@lieison.com>
 *@copyright (c) 2015, Lieison
 *
 *  Permission is hereby granted, free of charge, to any person obtaining a copy
    of this software and associated documentation files (the "Software"), to deal
    in the Software without restriction, including without limitation the rights
    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the Software is
    furnished to do so, subject to the following conditions:

    The above copyright notice and this permission notice shall be included in
    all copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
    SOFTWARE. 
 * 
 *@version 1.0
 *@todo Lieison S.A de C.V 
 */

define("URL" , 0);
define("NAME" , 1);


class FunctionsController {
    
    
    public static function GetHost($type = URL){
        
        global $CONFIG_;
        
        switch ($type){
            case URL:
                return  $CONFIG_['DIR']['protocol'] . $CONFIG_['DIR']['server'];
            case NAME:
                return  $CONFIG_['DIR']['server'];
        }
    }
    
    /**
     * @author Rolando Arriaza
     * @todo funcion estatica que devuelve la raiz del host o de la carpeta admin
     * 
     */
    public static function GetRootUrl($directory , $host = false)
    {
        global $CONFIG_;
        $folder = $CONFIG_['DIR']['folder'];
        if(\SivarApi\Tools\Validation::Is_Empty_OrNull($folder)){
            if(!$host){
              return $url = $CONFIG_['DIR']['root'] .  "Content/Web/$directory/";
            }else
            {
              return $url = $CONFIG_['DIR']['root'] .  "Content/$directory/";
            }
        }
        if(!$host){
            return $url = $CONFIG_['DIR']['root'] .  "" . $folder . "/Content/Web/$directory/";
        }else{
              return $url = $CONFIG_['DIR']['root'] .  "" . $folder . "/Content/$directory/";
        }
    }
    
    public static function GetContentUrl($link = ""){
        global $CONFIG_;
        $folder = $CONFIG_['DIR']['folder'];
        if(\SivarApi\Tools\Validation::Is_Empty_OrNull($folder)){
             return $url = $CONFIG_['DIR']['protocol'] .$CONFIG_['DIR']['server'] .  "/Content/$link";
        }
        return $url = $CONFIG_['DIR']['protocol'] . 
                      $CONFIG_['DIR']['server'] .
                      "/" . $folder . 
                      "/Content/$link";
    }

    /**
     * 
     * @version 2.5
     */
    public static function GetUrl($link , $mask_state = TRUE )
    {
       global $CONFIG_;
       
       $url = $CONFIG_['DIR']['protocol'] .  $CONFIG_['DIR']['server'] ;
       $folder = $CONFIG_['DIR']['folder'];
       $mask = $CONFIG_['MASK']['enable'];
       

       if($mask && $mask_state){
           $type = $CONFIG_['MASK']['type'];
           $mask_host = $CONFIG_['MASK']['host'];
           
           if(!$mask_host){
               if(!\SivarApi\Tools\Validation::Is_Empty_OrNull($folder)){
                    $url .= "/" . $folder;
                }
           }
           
           $url .= "/$type/admin/$link";
       }else{
            if(!\SivarApi\Tools\Validation::Is_Empty_OrNull($folder)){
                $url .= "/" . $folder;
            }
            $url .= "/Content/Web/admin/$link";
       }
       
       return $url ;
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
        $time = new \SivarApi\Tools\Time(short);
        return  $time->GetFormatDate();
    }
    
    public static function  ReWriteDate($date){
          $format = new DateTime($date);
          return $format->format("Y-m-d");
    }


    public static function get_time()
    {
         $time = new \SivarApi\Tools\Time(hour);
         return $time->GetFormatDate();
    }

    public static function get_directory_tree($directory , $pattern = null)
    {
        $directory = self::GetRootUrl($directory);
        $dir = new _Directory();
        return $dir->FindDataDirectory($directory , $pattern);
     }
     
    public static function DiffHour($horaini,$horafin)
    {
        \SivarApi\Tools\Time::DiffHour($horaini, $horafin);
    }
    
    public static function Get_TimeAgo($datetime, $full = false) 
    {
   
        $timeago = new \SivarApi\Tools\Time();
        return $timeago->GetTimeAgo($datetime, $full);
    }
     
    public static function get_actual_page()
     {
        $data_server =  $_SERVER['REQUEST_URI'];
        $data_server = explode("/" , $data_server);
        if (count($data_server) < 2) {
            $data_server = explode("\\" , $data_server);
            if (count($data_server) < 2) {
                return $data_server[0];
            } else
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
