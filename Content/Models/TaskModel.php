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
                        INNER JOIN privilegios ON privilegios.nombre=login.rol 
                        AND  login.id_usuario NOT LIKE '$id_user_from'";
       
        $result = parent::RawQuery($this->QUERY , pdo::FETCH_CLASS);

        $user_              = array();
        $priv_parent        = array();
        
        if(is_array($result)){

            $this->QUERY = "SELECT privilegios.nivel as nivel FROM login INNER "
                    . " JOIN privilegios ON login.rol=privilegios.nombre "
                    . " WHERE login.id_usuario LIKE '$id_user_from'";
            
            $nivel = parent::RawQuery($this->QUERY);
            $nivel = $nivel[0]['nivel'];
            
            foreach ($result as $value){
                
                if($value->padre == 0){
                     array_push($user_, array(
                              "id"      =>  $value->id_user,
                              "name"    =>  $value->nombre,
                              "priv"    =>  $value->priv_name
                         ));
                }else if($value->padre == $nivel){
                     array_push($user_, array(
                              "id"      =>  $value->id_user,
                              "name"    =>  $value->nombre,
                              "priv"    =>  $value->priv_name
                         ));
                }

            }
           
       /*     foreach ($result as $class){
                 if($class->padre == 0){
                     array_push($user_, array(
                              "id"      =>  $class->id_user,
                              "name"    =>  $class->nombre,
                              "priv"    =>  $class->priv_name
                         ));
                 }
                 else if($class->padre != 0){
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
            }*/
        }
        
        return $user_;
        
    }
    
    
    public function GetUserInfo($id_user){
        $this->QUERY = "SELECT imagen ,  email FROM usuario WHERE id_usuario LIKE '$id_user'";
        return parent::RawQuery($this->QUERY, PDO::FETCH_CLASS);
    }
    
    
    public function SetTask($multitask , $task){
           parent::beginTransaction();
           $query = "INSERT INTO task_multitask ";
           $query .= "(". implode(",", array_keys($multitask)).")";
           $query .= " VALUES ('" . implode("', '", array_values($multitask)) . "')";
           parent::exec($query);
           $query1 = "INSERT INTO task_task ";
           $query1 .= "(". implode(",", array_keys($task)).")";
           $query1 .= " VALUES ('" . implode("', '", array_values($task)) . "')";
           parent::exec($query1);
           return parent::commit();
    }
    
    public function FindTask($query){
         return parent::RawQuery($query, PDO::FETCH_CLASS);
    }
    
    
    public function ViewTask( $id_user_from , $order = NULL){
        
         $this->QUERY = "SELECT task_multitask.id_multitask as 'mt_id' ,
                          task_multitask.status as 'status',
                          task_multitask.description as 'mt_description',
                          task_multitask.title as 'title',
                          sales_client.nombre as 'client_name' ,
                          sales_client.telefono as 'client_phone' ,
                          sales_client.email as 'client_email' ,
                          concat(usuario.nombre , ' ' , usuario.apellido) as 'user_name',
                          usuario.imagen as 'user_image' ,
                          usuario.email as 'user_email',
                          task_task.date_asign as 'td_asign',
                          task_task.time_asign as 'tt_asign',
                          task_task.time_deadline as 't_timedeadline',
                          task_task.date_deadline as 't_deadline',
                          task_task.status as 't_status',
                          task_task.id_task as 't_id',
                          task_task.id_type as 't_idtype',
                          task_type.name as 't_nametype',
                          task_type.status as 't_typestatus',
                          task_task.box_files as 't_boxfiles',
                          task_task.files as 't_files',
                          task_task.comments as 't_comment'
                          FROM task_multitask
                          INNER JOIN task_task ON task_multitask.id_multitask = task_task.id_multitask
                          INNER JOIN sales_client ON task_multitask.id_client = sales_client.id_client
                          INNER JOIN usuario ON task_task.id_user_to=usuario.id_usuario
                          INNER JOIN task_type ON task_task.id_type = task_type.id_type
                          WHERE task_task.id_user_from LIKE '$id_user_from' ORDER BY task_task.date_asign DESC;";
         
         if(!\SivarApi\Tools\Validation::Is_Empty_OrNull($order)){
             
         }
         
         return $this->FindTask($this->QUERY);
    }
   
   
}
