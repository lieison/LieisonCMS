<?php



class AdminController extends MysqlConection {
    
 
    var $query = null;
   
    public function __construct() {
        parent::__construct();
    }


    public function GetLogin($user , $password )
    {
        
        $password = \SivarApi\Tools\Encriptacion\Encriptacion::encrypt($password);
        
        $this->query = "SELECT usuario.id_usuario as id , login.user , login.activo , login.rol "
                    . ", concat(usuario.nombre , ' ' , usuario.apellido) as nombre"
                    . ", usuario.email , usuario.imagen , login.password FROM login "
                    . " INNER JOIN usuario ON login.id_usuario=usuario.id_usuario "
                    . " WHERE  ";
        
        if(\SivarApi\Tools\Validation::CheckEmail($user))
        {
            $this->query .= "usuario.email LIKE '$user' AND login.password LIKE '$password'";
        }
        else
        {
             $this->query .= "login.user LIKE '$user' AND login.password LIKE '$password'";
        }
        
        $result = $this->RawQuery($this->query);
        if(count($result)>=1)
        {
            session_start();
            $_SESSION['login'] = $result[0];
            return TRUE;
        }
        else {
            return FALSE;
        }
    }
    
    public function Create_Log( $id_user , $hora_entrada , $fecha )
    {
        $id_log = $hora_entrada . rand(100, 5000) . $id_user . rand(0, 99);
        $id_log = \SivarApi\Tools\Encriptacion\Encriptacion::Md5Encrypt($id_log);
        $this->Insert("log", array(
           "id_log"=>$id_log,
           "id_usuario"=>$id_user,
           "entrada"=>$hora_entrada,
           "fecha"=>$fecha
        ));
        return $id_log;
    }
    
    public function Update_log($id_log , $hora_salida)
    {
        $this->Update("log", array("salida"=>$hora_salida) , "id_log LIKE '$id_log'");
    }
    
    public function Show_log($date = null)
    {
        $this->query = "SELECT concat(usuario.nombre, ' ' , usuario.apellido ) as nombre "
                . ", log.id_log as id , log.entrada , log.salida , log.fecha FROM log "
                . "INNER JOIN usuario ON log.id_usuario=usuario.id_usuario ";
        
        
        if(!\SivarApi\Tools\Validation::Is_Empty_OrNull($date)){
            $this->query .= "WHERE fecha LIKE '$date'";
        }
        else{
            $this->query .= " ORDER BY fecha DESC";
        }
        
        return $result = $this->RawQuery($this->query) ?: NULL;
            
    }
    
    public function get_rols_values($rol_)
    {
        $this->query = "SELECT nivel FROM privilegios WHERE nombre LIKE '$rol_'";
        $result = $this->RawQuery($this->query);
        if(count($result)>= 1):
            return $result[0]["nivel"];
        else:
            return 0;
        endif;
    }
    
    public function get_master_rols($master = true)
    {
        if ($master != true) {
            $this->query = "SELECT id_privilegios , nombre , nivel , padre FROM privilegios WHERE padre NOT LIKE 0";
            $result = $this->RawQuery($this->query);
            $this->query = "SELECT nivel, nombre FROM privilegios WHERE padre LIKE 0";
            $result_padre = $this->RawQuery($this->query);
            foreach ($result as $k=>$v){
                foreach ($result_padre as $key=>$value)
                {
                    if($value['nivel'] == $v['padre'])
                    {
                        $result[$k]['padre'] =  $value['nombre'];
                    }
                }
            }
            
        } else {
            $this->query = "SELECT id_privilegios , nombre , nivel , padre FROM privilegios WHERE padre LIKE 0";
            $result = $this->RawQuery($this->query);
        }
        
        

        if (count($result) == 0) {
            return null;
        }

        return $result ?: null;
    }
    
    public function Get_Users()
    {
        $this->query = "SELECT login.id_usuario , login.id_login , login.user ,"
                . " concat(usuario.nombre , ' ', usuario.apellido) as nombre"
                . " ,usuario.email , login.rol , login.activo  "
                . " FROM login INNER JOIN usuario ON login.id_usuario=usuario.id_usuario ";
        $result = $this->RawQuery($this->query);
        return $result;
    }
    
    public function UpdateUsers($args_user = array() , $args_login = array() , $id_user = null , $id_login = null)
    {
        $update = false;
        
        if(count($args_login) != 0 && count($args_user) != 0):
            $update = $this->Update("login", $args_login , "id_login LIKE $id_login" );
            $update= $this->Update("usuario",$args_user , "id_usuario LIKE '$id_user'");
        elseif(count($args_user) != 0):
              $update= $this->Update("usuario",$args_user , "id_usuario LIKE '$id_user'");
        elseif(count($args_login) != 0):
             $update = $this->Update("login", $args_login , "id_login LIKE $id_login" );
        endif;
        
        return $update;
        
    }
    
    public function CreateUser($args_user = array() , $args_login = array())
    {
        $create = null;

        if(count($args_login) != 0 && count($args_user) != 0):
                $create =  $this->Insert("login", $args_login );
                $create= $this->Insert("usuario",$args_user );
        elseif(count($args_user) != 0):
              $create=  $this->Insert("usuario",$args_user );
        elseif(count($args_login) != 0):
             $create =  $this->Insert("login", $args_login);
        endif;
        
        return $create;
    }
    
    public function DeleteUser($id_user = null , $id_login=null)
    {
        $delete = null;
        if($id_user != null && $id_login != null):
              $delete = $this->Delete("login", "id_login LIKE $id_login");
              $delete = $this->Delete("usuario", "id_usuario LIKE '$id_user'");
        elseif($id_user != null):
             $delete = $this->Delete("usuario", "id_usuario LIKE '$id_user'");
        elseif($id_login != null):
              $delete = $this->Delete("login", "id_login LIKE $id_login");
        endif;
        
        return $delete;
    }
    
     public function Get_MasterPrivilegios()
    {
        $this->query = "SELECT nivel , nombre FROM privilegios";
        return $this->RawQuery($this->query);
    }
 
}
