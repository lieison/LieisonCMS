<?php

define("HTML", 0);
define("TEXT" , 1);


class MailController {
    
    var $test       = false;
    
    var $mail       = null;
    
    var $replaces   = array();
    
   public function __construct($test = false) {
        $this->test = $test;
        $this->mail = new PHPMailer(true);
   }

   public function SetTo($to){
        $this->mail->addAddress($to);
   }
   
   public function SetFrom($from , $name = null){
        $this->SetFrom($from, $name);
   }
   
   public function SetBody($string , $type = HTML ){
       switch ($type){
           case HTML:
               $this->msgHTML($string);
               break;
           case TEXT:
               $this->mail->Body = $string;
               break;
       }
   }
   
   public function SetBodyFile($file , $path ){
         $content = file_get_contents($file , $path);
         if(count($this->replaces) >= 1){
             foreach($this->replaces as $key=>$value){
                    $content = str_replace($key, $value, $content);
             }
         }
         
         $this->mail->msgHTML($content);
   }

   
   public function SetBodyReplaces($pattern , $value){
       array_push($this->replaces, array($pattern => $value));
   }
   
   public function SendMail(){
       
       if($this->test){
           
       }
       
       try{
            if (!$this->mail->send()) {
                echo false;
            } else {
                echo true;
            }  
       } 
       catch (phpmailerException $ex){
           
       }
       catch (Exception $ex){
            
       }
       
   }
   
   
   
   
    
}
