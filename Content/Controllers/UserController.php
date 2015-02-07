<?php

class UserController extends UserModel  {
    
   protected $array_file = null;
    
   function __construct($id_user = null) {
        if(!\SivarApi\Tools\Validation::Is_Empty_OrNull($id_user))
        {
            $this->ID_USER = $id_user;
        }
        parent::__construct();
    }
    
    public function set_idUser($id_user)
    {
      $this->ID_USER = $id_user;
    }

    public function Get_Password($actual_password) {
        
    }

    public function SetNew_Avatar($destination , $file_name) {
       
        if(!is_dir($destination)) {
            return false;
        }
        else if(SivarApi\Tools\Validation::Is_Empty_OrNull($file_name)){
            return false;
        }
        
        $directory = new _Directory();
        $this->array_file = $directory->UploadFile($destination, $file_name);
        
        if ($this->array_file  != null ) {
            unset($directory);
            $update_avatar = parent::Update("usuario",
                    array("imagen"=>$this->array_file), 
                    "id_usuario LIKE '$this->ID_USER'");
            if ($update_avatar) {
                return true;
            }else{ return false;}
        } else {
            unset($directory);
            return null;
        }
    }
    
    public function get_file_name()
    {
        return $this->array_file;
    }

}
