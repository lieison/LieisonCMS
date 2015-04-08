<?php


 /**
 *@author Rolando Antonio Arriaza <rolignu90@gmail.com>
 *@copyright (c) 2015, SIVAR-API
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
 *@todo SIVAR-API
 */

 class Session {
    
    /**
      *@author Rolando Arriaza
      *@version 0.1
      *@todo Inicia la sesion 
     */
    public static function InitSession(){
        if (session_id() === "") {
            session_start();
        }
    }

    /**
     *@author Rolando Arriaza
     *@version 0.1
     *@todo verifica si existe la sesion
     *@param String $name id o nombre de la sesion
     *@return bool , true = si existe , false= no existe
     */
    public static function ExistSession($name){
        if(isset($_SESSION[$name])) {
            return true;
        }else{
            return false;
        }
    }
    
     /**
     *@author Rolando Arriaza
     *@version 0.1
     *@todo inserta una nueva sesion
     *@param String $name id o nombre de la sesion
     *@param Mixed $value valor al crear la sesion
     */
    public static function InsertSession($name , $value){
        $_SESSION[$name] = $value;
    }
    
     /**
     *@author Rolando Arriaza
     *@version 0.1
     *@todo Obtiene la sesion mediante su id
     *@param String $name id o nombre de la sesion
     *@param string $key , si la sesion tiene un arreglo $key obtiene el dato del nombre del arreglo
     *@return Mixed 
     */
    public static function  GetSession($name , $key = null){
        if(self::ExistSession($name)){
            if($key != null){
                return $_SESSION[$name][$key];
            }
            return $_SESSION[$name];
        }
    }
    
     /**
     *@author Rolando Arriaza
     *@version 0.1
     *@todo destruye la sesion
     *@param String $name id o nombre de la sesion
     *@param Bool $destroyAll opcional , TRUE = destruye toda variable de sesion
     */
    public static function DestroySession($name , $destroyAll= FALSE){
        switch ($destroyAll){
            case true:
                session_unset();
                session_destroy();
                break;
            case false:
                if(self::ExistSession($name)){
                   unset($_SESSION[$name]);
                }
                break;
        }
       
    } 
    
   
}
