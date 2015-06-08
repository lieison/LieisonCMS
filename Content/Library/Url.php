<?php  namespace Url;

define("URL" , 0);
define("NAME" , 1);

class Url {
    
    /**
     *@author Rolando Arriaza
     *@version 2.5
     *@name Url
     *@todo Url class  
     *@copyright (c) 2015, Sivar Framework 
     * **/
    

    public static function GetHost($type = URL){
        
        global $CONFIG_;
        
        switch ($type){
            case URL:
                return  $CONFIG_['DIR']['protocol'] . $CONFIG_['DIR']['server'];
            case NAME:
                return  $CONFIG_['DIR']['server'];
        }
    } 
    
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
    
    
    
}

