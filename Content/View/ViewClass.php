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
 *@version 1.3
  *     MEJORAS: *TIEMPO DE RESPUESTA EN EL SET VIEW CON LOS PATRONES INDICADOS
  *              *ADAPTABLE A CUALQUIER VISTA
  *@version 1.4
  *     MEJORAS: *PARAMETROS DINAMICOS POR MEDIO DE UN ARCHIVO JSON
  *              *AGREGA PARAMETROS NECESARIOS EN EL ARCHIVO
  * 
 *@todo Sivar Framework 2015
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
         
         global $CONFIG_;
         $folder = $CONFIG_['DIR']['folder'];

        if(!\SivarApi\Tools\Validation::Is_Empty_OrNull($folder)){
             $route = $CONFIG_['DIR']['root']  . $folder  . 
                 self::$relative_route . 
                 self::$end_route . "/" . self::$pointer ? : "/" . self::$pointer;
        }
        else{
            $route = $CONFIG_['DIR']['root']   . 
                 self::$relative_route . 
                 self::$end_route . "/" . self::$pointer ? : "/" . self::$pointer;
        }
        
       

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
                
                if($params['type'] == "static"){  
                    foreach($params['pattern'] as $key=>$value){
                        $temp_file = str_replace($key, $value , $temp_file);
                    }
                }
                else if($params['type'] == "dynamic"){
                    foreach ($params['pattern']  as $key=>$value){
                        $temp_file = str_replace($key, $value, $temp_file);
                    }
                }
                         
                 file_put_contents($route, $temp_file);
                 include $route;
                 
             }else{
                include $route;
             }
         }
         return null;
     }   
     

     public static function SetParamsString( $body ="%{BODY_CLASS_VIEW}%" ,
             $header = "%{HEADER_CLASS_VIEW}%", $js_init = "%{FOOTER_CLASS_VIEW}%" , 
             $js_script = "%{FOOTER_CLASS_VIEW_END}%")
     {
         return array( 
             "type"=>"static", 
             "pattern"=>array("%{BODY_CLASS_VIEW}%"=>$body ,
                 "%{HEADER_CLASS_VIEW}%"=>$header ,
                 "%{FOOTER_CLASS_VIEW}%"=>$js_init , 
                 "%{FOOTER_CLASS_VIEW_END}%"=>$js_script
               ));
     }
     
     
     public static function SetPatternString($patterns){
         return array(
             "type"=>"dynamic" , 
             "pattern" => $patterns
        );
     }
     
   
}


