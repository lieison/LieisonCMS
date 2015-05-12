<?php


class TaskController extends TaskModel {
    
    /**
     *@todo Constructor herencia al model  
     */
    public function __construct($conect_dsn = array(), $directory = null) {
        parent::__construct($conect_dsn, $directory);
    }
    
    /**
     *@author Rolando Arriaza
     *@todo Muestra el cliente su id y su nombre
     *@return HTML retorna una cadena html que contiene los <option></option> al select generado 
     */
    public function Show_SelectClient(){
        $result = parent::Get_InfoClients();
        $string_select = "";
        foreach ($result as $class){
            $string_select .= "<option value='$class->id'>$class->name</option>";
        }
        return $string_select;
    }
    
    /**
     * @author Rolando Arriaza
     * @todo  funcion que verifica el usuario a asignar aplicando filtros por categoria
     * @param $id_from el id del usuario que esta asignando la tarea (el que crea la tarea)
     * @return HTML devuelve los option values de los usuarios filtrados o que se pueden asignar la tarea
     */
    public function AsignTouser($id_from){
        $result = parent::GetUserToAsign($id_from);
        $string_select = "";
        foreach ($result as $user){
            $id = $user['id'];
            $name = $user['name'];
            $priv = $user['priv'];
            $string_select .= "<option value='$id'>$name ($priv)</option>";
        }
        
        return $string_select;
    }
    
    
    /**
     * @author Rolando Arriaza
     * @todo muestra un arrreglo del usuario 
     * @return Array/STDclass 
     */
    public function Show_UserInfo($id_user){
        $result = parent::GetUserInfo($id_user);
        return $result[0];
    }
    
    
    /**
     * @todo Salva la tarea creada
     * @param Array $mtask Los valores de multitask su id y value correspondiente
     * @param Array $task los valores id => value de task segun bdd
     * @return bool 
     */
    public function SaveTask(array $mtask , array $task ){
        return parent::SetTask($mtask , $task);
    }
    
    
    public function GetCountCreateTask($id_user_from){
        return $task_count =  parent::FindTask("call GetCountMyTask('$id_user_from');");
    }
    
    
    
}
