<?php namespace SivarApi\Tools;


/** 
 * @author Rolando Arriaza <rolignu90@gmail.com>
 * @copyright (c) 2014, ROLIGNU
 * @version 1.1
 * @license GPL
 */

class Validation  {
    
    
    
    /*
     * Genera el patron de los datos en hostname
     */
    protected static $_pattern = array(
	'hostname' => '(?:[_\p{L}0-9][-_\p{L}0-9]*\.)*(?:[\p{L}0-9][-\p{L}0-9]{0,62})\.(?:(?:[a-z]{2}\.)?[a-z]{2,})'
    );
    
    /*
     * verifica los patrones generados por regex
     */
    protected static function _check($check, $regex) {
		if (is_string($regex) && preg_match($regex, $check)) {
			return true;
		}
		return false;
    }
    
    /**
     * @param dimensional $check Cualquier tipo de variable
     * @todo Verifica si una variable esta vacia o no
     */
    public static function Is_Empty_OrNull ($check)
    {
        return empty($check);
    }
    
    /**
     * @param String $check Direccion electronica 
     * @param Bool $deep Lleve a cabo una validación más profunda ( si es verdadera) , por también comprobar la disponibilidad de acogida
     * @param String $regex cabio de sistema de caracteres a buscar condicional
     * 
     * @todo Verifica si un correo electronico esta bien escrito por medio de un patron de caracteres
     */
    public static function CheckEmail($check, $deep = false, $regex = null) {
		
        if (is_array($check)) {
	       extract(static::_defaults($check));
	}
        if ($regex === null) {
	     $regex = '/^[\p{L}0-9!#$%&\'*+\/=?^_`{|}~-]+(?:\.[\p{L}0-9!#$%&\'*+\/=?^_`{|}~-]+)*@' 
                     . self::$_pattern['hostname'] . '$/ui';
	}
	$return = static::_check($check, $regex);
	if ($deep === false || $deep === null) {
	      return $return;
	}
        if ($return === true && preg_match('/@(' . static::$_pattern['hostname'] . ')$/i', $check, $regs)) {
	   if (function_exists('getmxrr') && getmxrr($regs[1], $mxhosts)) {
		return true;
	}
	if (function_exists('checkdnsrr') && checkdnsrr($regs[1], 'MX')) {
		return true;
	}
	return is_array(gethostbynamel($regs[1]));
	}
	return false;
                
  }
  
  public static function validar_url($url){
	$urlregex = "^(https?|ftp)\:\/\/";

	$urlregex .= "([a-z0-9+!*(),;?&=\$_.-]+(\:[a-z0-9+!*(),;?&=\$_.-]+)?@)?";

	//$urlregex .= "[a-z0-9+\$_-]+(\.[a-z0-9+\$_-]+)*"; // http://x = allowed (ex. http://localhost, http://routerlogin)
	$urlregex .= "[a-z0-9+\$_-]+(\.[a-z0-9+\$_-]+)+"; // http://x.x = minimum
	//$urlregex .= "([a-z0-9+\$_-]+\.)*[a-z0-9+\$_-]{2,3}"; // http://x.xx(x) = minimum

	$urlregex .= "(\:[0-9]{2,5})?";
	$urlregex .= "(\/([a-z0-9+\$_-]\.?)+)*\/?";
	$urlregex .= "(\?[a-z+&\$_.-][a-z0-9;:@/&%=+\$_.-]*)?";
	$urlregex .= "(#[a-z_.-][a-z0-9+\$_.-]*)?\$";
	
	if(eregi($urlregex, $url)) return true;
	else return false;
  }
  
 

}
