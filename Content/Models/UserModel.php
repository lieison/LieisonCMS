<?php

abstract class UserModel extends MysqlConection {
    
    var $ID_USER = null;
    
    var $USER_ARRAY = array();
    
    var $QUERY = null;
    
    public abstract function Get_Password($actual_password , $new_password);
    public abstract function SetNew_Avatar($destination ,  $file_name);
    public abstract function Update_user($fields);
            
    function __construct() {
        parent::__construct();
    }
    
    public function Get_DataUser()
    {
        $this->QUERY = "SELECT * FROM usuario WHERE id_usuario LIKE '$this->ID_USER'";
        $data = parent::RawQuery($this->QUERY);
        return $data[0];
    }
    
    public function get_name()
    {
        $this->QUERY = "SELECT concat(nombre , ' ' , apellido) as nombres  FROM usuario WHERE id_usuario LIKE '$this->ID_USER'";
        $data = parent::RawQuery($this->QUERY);
        return $data[0];
    }
    
    public function get_login()
    {
        $this->QUERY = "SELECT * FROM login WHERE id_usuario LIKE '$this->ID_USER'";
         $data = parent::RawQuery($this->QUERY);
        return $data[0];
    }
    
  
        
    
 
}
