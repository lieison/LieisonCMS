<?php


class TaskModel extends MysqlConection {
    
    /**
     *@var string 
     */
    var $QUERY      = null;
    
    
    /**
     *@todo Constructor herencia mysqlconection 
     */
    public function __construct($conect_dsn = array(), $directory = null) {
        parent::__construct($conect_dsn, $directory);
    }
    
    
    /**
     *@todo obtiene la informacion del cliente su id y nombre
     *@return array->STD:CLASS devuelve un arreglo de objetos cuyo objeto lleva
     *                         un id->id , name->name
     *@example  STD_CLASS->id , STD:CLASS->name  
     */
    public function Get_InfoClients(){
        $this->QUERY = "SELECT id_client as id , nombre as name FROM sales_client ORDER BY fecha DESC";
        return parent::RawQuery($this->QUERY, PDO::FETCH_CLASS); 
    }
    
    
    public function GetUserToAsign($id_user_from){
        $this->QUERY = "SELECT privilegios.nivel , privilegios.padre , privilegios.nombre as priv_name , login.user as user , 
                        login.id_usuario as id_user , concat(usuario.nombre , ' ' , usuario.apellido) as nombre
                        FROM login INNER JOIN usuario ON login.id_usuario=usuario.id_usuario 
                        INNER JOIN privilegios ON privilegios.nombre=login.rol;";
        
        $result = parent::RawQuery($this->QUERY , pdo::FETCH_CLASS);
        $user_ = array();
        if(is_array($result)){
            
            $this->QUERY = "SELECT privilegios.nivel as nivel FROM login INNER JOIN privilegios ON login.rol=privilegios.nombre "
                    . " WHERE login.id_usuario LIKE '$id_user_from'";
            
            $nivel = parent::RawQuery($this->QUERY);
            $nivel = $nivel[0]['nivel'];
            $priv_parent = array();
            
            foreach ($result as $class){
                 if($class->padre == 0){
                     array_push($user_, array(
                              "id"      =>  $class->id_user,
                              "name"    =>  $class->nombre,
                              "priv"    =>  $class->priv_name
                         ));
                 }
                 else if($class->padre != 0){
                     //|| $nivel == 55
                     if($class->padre == $nivel ){
                         if(count($priv_parent) == 0){
                             $admin = new AdminController();
                             $priv_parent = $admin->Get_MasterPrivilegios();
                         }
                         $priv_parent_name = null;
                         foreach ($priv_parent as $priv){
                             if($class->padre === $priv['nivel']){
                                 $priv_parent_name .= $priv['nombre'] . "->";
                                 break;
                             }
                         }
                         array_push($user_, array(
                              "id"      =>  $class->id_user,
                              "name"    =>  $class->nombre,
                              "priv"    =>  $priv_parent_name  .  $class->priv_name
                         ));
                     }
                 }
            }
        }
        
        return $user_;
        
    }
    
    
    public function GetUserInfo($id_user){
        $this->QUERY = "SELECT imagen ,  email FROM usuario WHERE id_usuario LIKE '$id_user'";
        return parent::RawQuery($this->QUERY, PDO::FETCH_CLASS);
    }
   
}
