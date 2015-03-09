<?php namespace SivarApi\Tools\Encriptacion;

/** 
 * @author Rolando Arriaza <rolignu90@gmail.com>
 * @copyright (c) 2014, ROLIGNU
 * @version 1.1
 * @license GPL
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
