<?php namespace SivarApi\Tools\Captcha\BaseCaptcha;


/*
 * CLASE BASECAPTCHA 
 * CLASE EN LA CUAL CONTROLA LAS FUNCIONES PARA GENERAR UN CAPTCHA
 * **/

/**
 *@author Rolando Arriaza 
 *@version 1.0
 *@name $BaseCaptcha 
 *@todo Esta clase es basica para una mejor manipulacion del captcha
 */


//include "Class/Tools/Captcha.php";



class BaseCaptcha {
    
    
    /**
     * LLAVE PUBLICA PREDETERMINADA
     * para obtener una llave propia generarla en 
     * https://www.google.com/recaptcha/admin
     */
    protected $publickey = "6LcHKeMSAAAAAOT44ko9ABNagbFST3RAMrinllIg";
    
    
    /**
     * LLAVE PRIVADA PARA COMPARACION DE LA CAPTCHA MANDADA
     * 
     */
    protected $privatekey = "6LcHKeMSAAAAAOAoANaejOfQyUw5UyTpGbaeB7YX";
    
    
    
    /**
     * @todo Contructor de la clase
     * @version 1.0
     * @param String $public_key llave publica para el captcha 6LcHKeMSAAAAAOT44ko9ABNagbFST3RAMrinllIg
     * @param String $private_key llave privada para el captcha 6LcHKeMSAAAAAOT44ko9ABNagbFST3RAMrinllIg
     * 
     * <code>
     *  para crear una llave privada y publica acceder a este link
     *  https://www.google.com/recaptcha/admin/
     * 
     * En esa direccion puedes crear una llave unica basadae en tu pagina web 
     * o usa la llaves siguientes
     * 
     *  public = 6LcHKeMSAAAAAOT44ko9ABNagbFST3RAMrinllIg
     * 
     *  private = 6LcHKeMSAAAAAOAoANaejOfQyUw5UyTpGbaeB7YX
     * </code>
     * 
     */
    function __construct($public_key = null , $private_key = null) {
        
        if(!\SivarApi\Tools\Validation::Is_Empty_OrNull($public_key) 
                || !\SivarApi\Tools\Validation::Is_Empty_OrNull($private_key)){
            $this->publickey = $public_key;
            $this->privatekey = $private_key;
        }
    }
    
    
    /**
     *@version 1.0
     *@param String $error variable de error en retorno
     *@return HTML devuelve el captcha en formato HTML 
     */
    function CreateCaptcha($error = null)
    {
      
        return  \SivarApi\Tools\Captcha\recaptcha_get_html($this->publickey, $error);
    }
    
    /**
     * @version 1.0
     * @return true si el captcha es igual al introducido
     */
    function CompareCaptcha()
    {
        if(isset($_REQUEST["recaptcha_response_field"]))
        {
             $resp = \SivarApi\Tools\Captcha\recaptcha_check_answer ($this->privatekey,
                                        $_SERVER["REMOTE_ADDR"],
                                        $_REQUEST["recaptcha_challenge_field"],
                                        $_REQUEST["recaptcha_response_field"]);
             
             if($resp->is_valid) return true;
             else return false;

        }
        else return false;
    }
    
}
