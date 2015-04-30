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
    
    
    public function Show_UserInfo($id_user){
        
        $result = parent::GetUserInfo($id_user);
        return $result[0];
    }
    
    
    
}
