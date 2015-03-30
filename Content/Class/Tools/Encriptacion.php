<?php namespace SivarApi\Tools\Encriptacion;

 /**
 *@author Rolando Antonio Arriaza <rmarroquin@lieison.com>
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


class Encriptacion {
    
    
   private static $llave= "LieisonData%%@Work??group256788";
  
   public static function CrearLLave($auto_crear = false , $llave = null)
   {
        if($auto_crear != false)
        {
            $arr_key = array();
            for($i=1; $i<=10; $i++)
            {
                $arr_key[] = rand(1, pow(($i*pi()), $i));
            }
            $new_key = implode("", $arr_key);
            self::$llave = self::Md5Encrypt($new_key);
        }
        else{
            self::$llave = $llave;
        }
   }
   
   
   public static function ObtenerLLave()
   {
       return self::$llave;
   }
   
   public static function Mencrypt256($cadena_entrada)
   {
       $iv_size = mcrypt_get_iv_size(MCRYPT_CAST_256, MCRYPT_MODE_CBC);
       $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
       $E = mcrypt_encrypt(MCRYPT_CAST_256 , 
               self::$llave , 
               $cadena_entrada , 
               MCRYPT_MODE_CBC , 
               $iv);
       $cifrado = $iv . $E;
       return base64_encode($cifrado);
   }
   
   public static function MenDecrypt256($cadena_encryptada)
   {
       $dec = base64_decode($cadena_encryptada);
       $iv_size = mcrypt_get_iv_size(MCRYPT_CAST_256, MCRYPT_MODE_CBC);
       $iv_dec = substr($dec, 0, $iv_size);
       $dec = mcrypt_decrypt(
               MCRYPT_RIJNDAEL_128, 
               self::$llave,                 
               $dec,
               MCRYPT_MODE_CBC,
               $iv_dec);
       return $dec;
   }
   
   
   public static function Md5Encrypt($palabra)
   {
       return md5($palabra);
   }
 
   
    public static function encrypt ($cadena_entrada) {
        $cadena_encryp = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, 
                md5(self::$llave), 
                $cadena_entrada, 
                MCRYPT_MODE_CBC, md5(md5(self::$llave))));
        return $cadena_encryp;
    }
    
    public static function decrypt ($cadena_encryptada) {
        $cadena_desencryp = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, 
                md5(self::$llave),
                base64_decode($cadena_encryptada), 
                MCRYPT_MODE_CBC, 
                md5(md5(self::$llave))), "\0");
        return $cadena_desencryp ;
    }
    
}
