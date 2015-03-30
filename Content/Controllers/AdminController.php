<?php

    
 /**
 *@author Rolando Antonio Arriaza <rmarroquin@lieison.com>
 *@copyright (c) 2015, Lieison
 *
 *  Permission is hereby granted, free of charge, to any person obtaining a copy
    of this software and associated documentation files (the "Software"), to deal
    in the Software without restriction, including without limitation the rights
    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the Software is
    furnished to do so, subject to the following conditions:

    The above copyright notice and this permission notice shall be included in
    all copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
    SOFTWARE. 
 * 
 *@version 1.0
 *@todo Lieison S.A de C.V 
 */



class AdminController extends MysqlConection {
    
    var $query = null;
   
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * @todo Funcion para obtener si el usuario logueado esta dentro de la base de datos
     * @version 1.1 
     * @author Rolando Arriaza
     * @param String $user usuario o correo corporativo
     * @param String $password contraseña 
     * @return boolean , true si existe , false si no existe
     */
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
    
    /**
     *@todo funcion en la cual registra a un usuario cuando utiliza el sistema
     *@version 0.9 
     *@author Rolando
     *@param  string $id_user
     *@param String $hora_entrada
     *@param String/date $fecha 
     *@return string/md5 , retorna el id del log iniciado
     */
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
    
    /**
     *@todo  funcion en la cual actualiza la bitacora segun el id del log 
     *@version 0.9
     *@author Rolando Arriaza
     */
    public function Update_log($id_log , $hora_salida)
    {
        $this->Update("log", array("salida"=>$hora_salida) , "id_log LIKE '$id_log'");
    }
    
    
    /**
     *@todo funcion en la cual muestra la bitacora 
     *@version 0.9
     *@author Rolando Arriaza
     *@param string/optional $date fecha a mostrar de la bitacora
     *@return array/mixed devuelve un arreglo 
     */
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
    
    /**
     *@todo funcion que obtiene el nivel del rol o privilegio
     *@version 0.1
     *@author Rolando
     *@return int retorna el nivel si existe / si no retorna nivel por defecto "0"
     */
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
    
    /**
     *@todo Funcion que establece nuevos privilegios en la base de datos
     *@version 1.5
     *@author Rolando Arriaza
     *@param string $rol_name nombre del rol a agregar
     *@param string $padre nombre del rol padre si es hijo el rol_name
     */
    public function add_rols($rol_name , $padre = null)
    {
        $data = array();
        $insert = false;
        $id = rand(1, 2000);
        $is_exist = $this->RawQuery("SELECT * FROM privilegios WHERE NIVEL LIKE $id");
        if(count($is_exist)>=1):
                 while(count($is_exist)>= 1):
                    $id = rand(1,200);
                    $is_exist = $this->RawQuery("SELECT * FROM privilegios WHERE NIVEL LIKE $id");
                 endwhile;
        endif;
        
        if(\SivarApi\Tools\Validation::Is_Empty_OrNull($padre)):
              $data = array("nivel" => $id  , "nombre"=> $rol_name , "padre"=>0);
              $insert = $this->Insert("privilegios", $data );
            else:
               $data = array("nivel"=>$id , "nombre"=> $rol_name , "padre"=>$padre);
               $insert = $this->Insert("privilegios", $data );
        endif;
            
       return $insert;
    }
    
    /**
     *@todo funcion que elimina el rol por medio de su id
     */
    public function delete_rols($id_rols)
    {
        $this->query = "id_privilegios LIKE $id_rols";
        return $this->Delete("privilegios", $this->query);
    }
    
    /**
     *@todo function que obtiene el rol padre o rol maestro , dado caso obtiene el hijo
     *@param boolean $name oibteniendo el padre o hijo
     *              true=padre
     *              false=hijo
     *@version 1.1
     *@author Rolando
     *@return Array devuelve un arreglo de los roles
     */
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
    
    
        
    public function get_permission_page($rol , $dashboard_page)
    {
        $this->query = "SELECT privilegios FROM dashboard WHERE link LIKE '%$dashboard_page%'";
        $result = $this->RawQuery($this->query);
        $rol_value = $this->get_rols_values($rol);
        foreach ($result as $k=>$v)
        {
           $page_rol = explode(',' , $v['privilegios']);
           if(count($page_rol) >=2)
           {
                foreach($page_rol as $rol)
               {
                    if((int)$rol_value == (int) $rol)
                    {
                        return true;
                    }
               }
           }else{
                if((int)$rol_value == (int) $page_rol[0])
                {
                    return true;
                }
           }
        }
        
        return false;
    }
    
     /**
      * @todo funcion que obtiene los niveles de los roles o privilegios
      * @version 0.1
      * @author Rolando
      * @since 0.1
      * @deprecated since version 0.1
      */
     public function Get_MasterPrivilegios()
    {
        $this->query = "SELECT nivel , nombre FROM privilegios";
        return $this->RawQuery($this->query);
    }
    
    
    /**
     *@todo Funcion para otorgar permisos a la pagina , esta funcion requiere de parametros especiales
     *@version 1.0
     *@since 1.0 
     *@depends get_permission_page , get_option_permission
     *@return mixed bool/redirect 
     * 
     * 
     */

    public function Get_Permission($rol , $dashboard_page , $redirect =
                    array("redirect"=> "../index.php" , 
                           "activate" => true) 
            )
    {
        $is_priv = $this->get_permission_page($rol, $dashboard_page);
        if(!$is_priv && $rol != "admin" )
        {
            if ($redirect['activate'] == true) {
                ob_start();
                $header = new \Http\Header();
                $header->redirect($redirect['redirect']);
                unset($header);
                ob_end_clean();
            } else {
                return $is_priv;
            }
        }
    }
    
        
    public static function get_option_permission($redirect = ".../index.php" , $activate=true )
    {
        return array("redirect"=> $redirect , 
                           "activate" => $activate);
    }
    
    
    /***********************************************************************************************
     * AREA DEL CONTROL DE USUARIOS DE FORMA ADMINISTRADOR 
     * ESTA AREA NO ES IGUAL AL CONTROLADOR UserController.php
     * YA QUE SE ESPECIFICA QUE ES PARA MANTENCION DE UN USUARIO RAPIDO
     * 
     *@version 1.5 todas las funciones
     *@author Rolando Arriaza
    ***********************************************************************************************/
    
    
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
            $this->Update("login", $args_login , "id_login LIKE $id_login" );
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
                $this->Insert("login", $args_login );
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
              $this->Delete("login", "id_login LIKE $id_login");
              $delete = $this->Delete("usuario", "id_usuario LIKE '$id_user'");
        elseif($id_user != null):
             $delete = $this->Delete("usuario", "id_usuario LIKE '$id_user'");
        elseif($id_login != null):
              $delete = $this->Delete("login", "id_login LIKE $id_login");
        endif;
        
        return $delete;
    }
    
 
    
  
 
}
