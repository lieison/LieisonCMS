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
    
    public static function get_time()
    {
         $d = new DateTime();
         return $d->format("H:i:s");
    }

    public static function get_directory_tree($directory , $pattern = null)
    {
        $directory = self::GetRootUrl($directory);
        $dir = new _Directory();
        return $dir->FindDataDirectory($directory , $pattern);
     }
     
    public static function DiffHour($horaini,$horafin)
    {
	$horai=substr($horaini,0,2);
	$mini=substr($horaini,3,2);
	$segi=substr($horaini,6,2);

	$horaf=substr($horafin,0,2);
	$minf=substr($horafin,3,2);
	$segf=substr($horafin,6,2);

	$ini=((($horai*60)*60)+($mini*60)+$segi);
	$fin=((($horaf*60)*60)+($minf*60)+$segf);

	$dif=$fin-$ini;

	$difh=floor($dif/3600);
	$difm=floor(($dif-($difh*3600))/60);
	$difs=$dif-($difm*60)-($difh*3600);
	return date("H-i-s",mktime($difh,$difm,$difs));
    }
    
    public static function Get_TimeAgo($datetime, $full = false) 
    {
   
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

     if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago ' : ' Just Moment';

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
