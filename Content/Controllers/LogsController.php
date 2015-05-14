<?php


class LogsController {
    
    var $log_name   = "log.txt";
    
    var $fopen      = null;
    
    public function __construct( $path ) {
         $this->fopen = fopen($path .$this->log_name, "a+" , true);
    }
    
    public function SetLog($message){
        fwrite($this->fopen, $message . "\n");
    }
    
    public function CloseLog(){
        fclose($this->fopen);
    }
   
}
