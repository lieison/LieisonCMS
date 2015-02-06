<?php

class UserController extends UserModel  {
    
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

    public function Get_Password() {
        
    }

}
