<?php namespace SivarApi\Tools; 

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

define("short", "Y-m-d");

define("long" ,"Y-m-d:H:i:s" );

define("hour", "H:i:s");

define("w3c" , \DateTime::W3C);

define("atom" , \DateTime::ATOM);

define("cookie" , \DateTime::COOKIE);

define("iso8601" , \DateTime::ISO8601);

define("rss" , \DateTime::RSS);

class Time {
    
    
    protected $datetime = null;
    
    protected  $time_string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
    );

    protected  $format = null;

    public function __construct($format = short) {
        $this->format = $format;
        $this->datetime = new \DateTime();
    }
    
    public function __destruct() {
        unset($this);
    }
    
    public function GetTimeAgo($datetime  ,$full = false){

        $now = new \DateTime;
        $ago = new \DateTime($datetime);
        $diff = $now->diff($ago);
        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;
     
       $this->time_string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
      );

     foreach ($this->time_string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($this->time_string[$k]);
        }
     }
     if (!$full) $this->time_string = array_slice($this->time_string, 0, 1);
        return $this->time_string ? implode(', ', $this->time_string) . ' ago ' : ' Just Moment';
    }
    
    public static function DiffHour($hourInit,$hourEnd) {
	$horai=substr($hourInit,0,2);
	$mini=substr($hourInit,3,2);
	$segi=substr($hourInit,6,2);

	$horaf=substr($hourEnd,0,2);
	$minf=substr($hourEnd,3,2);
	$segf=substr($hourEnd,6,2);

	$ini=((($horai*60)*60)+($mini*60)+$segi);
	$fin=((($horaf*60)*60)+($minf*60)+$segf);

	$dif=$fin-$ini;

	$difh=floor($dif/3600);
	$difm=floor(($dif-($difh*3600))/60);
	$difs=$dif-($difm*60)-($difh*3600);
	return date("H-i-s",mktime($difh,$difm,$difs));
    }
    
    public function GetDate(){
       return $this->datetime->format(short);
    }
    
    public function GetTime(){
        return $this->datetime->format(hour);
    }
    
    public function  GetFormatDate($format = null){
        if($format != null){ $this->format = $format;}
        return $this->datetime->format($this->format);
    }
    
    public function Getday(){
       return $this->datetime->format("d");
    }
    
    public function GetMonth(){
       return $this->datetime->format("m");
    }
    
    public function GetYear(){
       return $this->datetime->format("Y");
    }
    
    public function SetTimeZone($timezone = \DateTimeZone::AMERICA){
        $this->datetime->setTimezone($timezone);
    }
    
    
    

}
