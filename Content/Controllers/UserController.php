<?php

class UserController extends UserModel  {
    
   protected $array_file = null;
    
    public function __construct($id_user = null) {
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
    
    public function find_contract($dir , $id_user = null)
    {
        $contract_array = array();
        $directory = new _Directory();
        
        if($id_user == null){
            $this->QUERY = "SELECT id_contrato , nombre , contrato , "
                . "aceptado , fecha_envio , fecha_contrato FROM contrato WHERE id_usuario LIKE '$this->ID_USER'";
        }
        else{
             $this->QUERY = "SELECT id_contrato , nombre , contrato , "
                . "aceptado , fecha_envio , fecha_contrato FROM contrato WHERE id_usuario LIKE '$id_user'";
        }
        
        $result = parent::RawQuery($this->QUERY);
        foreach ($result as $key=>$value)
        {
           
           $extension = $directory->Get_Extension($value['contrato']);
           $datafile = FileExtension::GetIcon_extension($dir , $extension , $value['contrato']);
           if($datafile != false ){
                    $contract_array[] = array(
                        "id"=>$value['id_contrato'],
                        "nombre"=>$value['nombre'],
                        "contrato"=>$value['contrato'],
                        "aceptado"=>$value['aceptado'],
                        "fecha_envio"=>$value['fecha_envio'],
                        "fecha_contrato"=>$value['fecha_contrato'],
                        "icono"=> $datafile
                    );
           }
           else {
                 $contract_array[] = array(
                        "id"=>$value['id_contrato'],
                        "nombre"=>$value['nombre'],
                        "contrato"=>$value['contrato'],
                        "aceptado"=>$value['aceptado'],
                        "fecha_envio"=>$value['fecha_envio'],
                        "fecha_contrato"=>$value['fecha_contrato'],
                        "icono"=> "DocBroken.png"
                    );
           }
        }
        
        return  $contract_array;
    }
    
    public function set_contract($id_contrato)
    {
        $fecha = date("y-m-d");
        $update = parent::Update("contrato", array("aceptado"=>"1" ,
                "fecha_contrato"=>$fecha) , "id_contrato LIKE $id_contrato");
        return $update;
    }
    

}
