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

/**
 * clase en la cual se encarga de la mensajeria cliente servidor 
 * 
 */


class MessageController extends MessageModel {
    
    
    /**
     * @todo Agrega nuevos permisos a quien se le puede enviar mensajes
     * @version 0.1
     * @param string/key $id_usuario usuario receptor
     * @param String/key $id_usuario_permission usuario emisor o quien emitira el permiso
     * @return null no hay valor de retorno
     */
    public function SetPermisssionMessage($id_usuario , $id_usuario_permission){
        $this->Insert("lieisoft_mensajes_permisos", array(
                        "id_usuario"            =>$id_usuario,
                        "id_usuario_permiso"    =>$id_usuario_permission
        ));
    }

    public function GetUsersPermission($id_usuario){
         $result = $this->RawQuery("SELECT usuario.id_usuario , concat(usuario.nombre , ' ' , usuario.apellido) as nombre"
                 . " usuario.imagen FROM usuario INNER JOIN lieisoft_mensajes_permisos ON "
                 . " usuario.id_usuario=lieisoft_mensajes_permisos.id_usuario_permiso WHERE "
                 . " usuario.id_usuario LIKE '$id_usuario'");
         return $result;
    }

    public function GetMessageCountFrom($id_u_para, $no_read = true) {
         $result = null;
         if($no_read == true){
           $result = $this->RawQuery("SELECT count(*) as count FROM "
                    . " lieisoft_mensajeria WHERE id_usuario_para LIKE '$id_u_para' AND leido=0");
         }
         else{
            $result = $this->RawQuery("SELECT count(*) as count FROM "
                    . " lieisoft_mensajeria WHERE id_usuario_para LIKE '$id_u_para'");
         }
         return $result[0]['count'];
    }

    public function GetMessageFrom($id_u_para , $limit = null , $not_read = 0 , $trash = false) {
        
        $query = "SELECT lieisoft_mensajeria.id_mensaje ,  lieisoft_mensajeria.asunto ,"
                . " lieisoft_mensajeria.fecha , lieisoft_mensajeria.hora , lieisoft_mensajeria.mensaje ,"
                . " concat(usuario.nombre , ' ' , usuario.apellido) as nombre , "
                . " usuario.imagen , lieisoft_mensajeria.leido as 'leido' "
                . " FROM lieisoft_mensajeria INNER JOIN usuario "
                . " ON lieisoft_mensajeria.id_usuario_de=usuario.id_usuario "
                . " WHERE lieisoft_mensajeria.id_usuario_para LIKE '$id_u_para' ";
       
        if($not_read == 1){
             $query .= " AND lieisoft_mensajeria.leido LIKE 0 ";
        }
        else if($not_read == 2){
            $query .= " AND lieisoft_mensajeria.leido LIKE 1 ";
        }
        
        if($trash){
            $query .= " AND lieisoft_mensajeria.eliminado LIKE 0 ";
        }
        
        $query .= " ORDER BY lieisoft_mensajeria.fecha DESC , lieisoft_mensajeria.hora DESC";
        
        
        if($limit != null){
            $query .= " LIMIT $limit ";
        }        
        
        return $result = $this->RawQuery($query); 
    }

    public function GetMessageTrash($id_u_para, $state = MESSAGE_FROM) {
         
        $e = "lieisoft_mensajeria.id_usuario_de";
        
        if($state == MESSAGE_TO){
            $e = "lieisoft_mensajeria.id_usuario_para";
        }
        
        $query = "SELECT lieisoft_mensajeria.id_mensaje ,  lieisoft_mensajeria.asunto ,"
                . " lieisoft_mensajeria.fecha , lieisoft_mensajeria.hora , lieisoft_mensajeria.mensaje ,"
                . " concat(usuario.nombre , ' ' , usuario.apellido) as nombre , "
                . " usuario.imagen , lieisoft_mensajeria.leido as 'leido' "
                . " FROM lieisoft_mensajeria INNER JOIN usuario "
                . " ON lieisoft_mensajeria.id_usuario_de=usuario.id_usuario "
                . " WHERE $e LIKE '$id_u_para' AND  lieisoft_mensajeria.eliminado LIKE 1";
        
        return $result = $this->RawQuery($query); 
    }
    
    public function GetMessageTo($id_u_de , $limit = null) {
      
        $query = "SELECT lieisoft_mensajeria.id_mensaje ,  lieisoft_mensajeria.asunto ,"
                . " lieisoft_mensajeria.fecha , lieisoft_mensajeria.hora , lieisoft_mensajeria.mensaje ,"
                . " concat(usuario.nombre , ' ' , usuario.apellido) as nombre , usuario.imagen "
                . " FROM lieisoft_mensajeria INNER JOIN usuario ON lieisoft_mensajeria.id_usuario_para=usuario.id_usuario"
                . " WHERE lieisoft_mensajeria.id_usuario_de LIKE '$id_u_de' ORDER BY lieisoft_mensajeria.hora ASC";
        
        
        if($limit != null){
            $query .= " LIMIT $limit ";
        }        
        
        return $result = $this->RawQuery($query); 
    }

    public function SetMessage($id_u_para, $id_u_de, $mensaje ,  $asunto = null) {
        return  $this->Insert("lieisoft_mensajeria" , array(
                "id_usuario_para"       => $id_u_para ,
                "id_usuario_de"         => $id_u_de,
                "asunto"                => $asunto ,
                "mensaje"               => $mensaje,
                "fecha"                 => FunctionsController::get_date(),
                "hora"                  => FunctionsController::get_time(),
                "leido"                 => 0
             ));
    }
    
    
    public function SetmessageLastId($id_u_para, $id_u_de, $mensaje ,  $asunto = null) {
         $this->Insert("lieisoft_mensajeria" , array(
                "id_usuario_para"       => $id_u_para ,
                "id_usuario_de"         => $id_u_de,
                "asunto"                => $asunto ,
                "mensaje"               => $mensaje,
                "fecha"                 => FunctionsController::get_date(),
                "hora"                  => FunctionsController::get_time(),
                "leido"                 => 0
             ));
         return parent::RawQuery("SELECT LAST_INSERT_ID();");
    }
    

    public function SetSubmessage($id_message, $id_usuario, $mensaje) {
        return $this->Insert("lieisoft_submensajeria" , array(
                    "id_mensajeria"         =>$id_message,
                    "id_usuario"            =>$id_usuario,
                    "mensaje"               =>$mensaje,
                    "fecha"                 => FunctionsController::get_date(),
                    "hora"                  => FunctionsController::get_time()
        ));
    }

    public function GetSubMessage($id_mensaje) {
         $query = "SELECT lieisoft_submensajeria.id_submensajeria , "
                . " concat(usuario.nombre , ' ' , usuario.apellido) as nombre , usuario.imagen, "
                . " lieisoft_submensajeria.mensaje , lieisoft_submensajeria.fecha , lieisoft_submensajeria.hora , "
                . "lieisoft_submensajeria.leido FROM lieisoft_submensajeria INNER JOIN usuario ON "
                . "lieisoft_submensajeria.id_usuario=usuario.id_usuario "
                . "WHERE lieisoft_submensajeria.id_mensajeria LIKE '$id_mensaje'";
         return $this->RawQuery($query);
    }

    public function GetCountSubMessage($id_mensaje,  $id_user , $not_read = true) {
        
        $query = "SELECT count(*) as count FROM lieisoft_submensajeria "
                . " WHERE lieisoft_submensajeria.id_mensajeria LIKE $id_mensaje and lieisoft_submensajeria.id_usuario NOT LIKE '$id_user'";
        
         if($not_read == true){
             $query .= " AND lieisoft_submensajeria.leido=0";
         }
         
         $result = $this->RawQuery($query);
         
         return $result[0]['count'];
    }

    public function DeleteMessage($id_message) {
        
    }

    public function DeleteSubMessage($id_submesage) {
        
    }

    public function GetChatById($id) {
        
        $query = "SELECT lieisoft_submensajeria.mensaje as 'mensaje' ,
                  lieisoft_submensajeria.fecha as 'fecha',
                  lieisoft_submensajeria.hora as 'hora' ,
                  lieisoft_submensajeria.leido as 'leido' ,
                  lieisoft_submensajeria.id_usuario as 'id',
                  usuario.nombre as 'nombre',
                  usuario.imagen as 'avatar' FROM lieisoft_submensajeria 
                  INNER JOIN usuario ON usuario.id_usuario=lieisoft_submensajeria.id_usuario
                  WHERE lieisoft_submensajeria.id_mensajeria 
                  LIKE $id
                  ORDER BY lieisoft_submensajeria.fecha ASC , lieisoft_submensajeria.hora ASC ;";
      
        
        return  parent::RawQuery($query);
    }

    public function GetActiveUserChat($id) {
        
        //el id del usuario 
        $me         = Session::GetSession("login", "id");
        
        //defecto el usuario quien lo mando y para quien 
        $msj       = "lieisoft_mensajeria.id_usuario_de";
        $to        = "lieisoft_mensajeria.id_usuario_para";
        
        
        //preparamos la query de verificar si el usuario actual es el que envio el mensaje
        //si en dado caso el envio el mensaje los parametros cambian 
        $query =    "SELECT lieisoft_mensajeria.id_usuario_de as 'id'"
                    ." FROM lieisoft_mensajeria WHERE id_mensaje LIKE $id";
        
        //resultado
        $result =   parent::RawQuery($query);
        $result =   $result[0]['id'];
        
        //parametros cambian si envio el mensaje 
        if($result == $me){
            $msj       = "lieisoft_mensajeria.id_usuario_para";
            $to        = "lieisoft_mensajeria.id_usuario_de";
        }
        
        //resultado de la consulta ya con parametros cambiados
        $query =   "SELECT lieisoft_mensajeria.asunto as 'asunto' ,
                    $msj as 'id_user',
                    lieisoft_mensajeria.fecha as 'fecha' ,
                    lieisoft_mensajeria.hora as 'hora' ,
                    concat(usuario.nombre ,  ' ' , usuario.apellido) as 'to_name',
                    usuario.imagen as 'avatar' , login.rol as 'to_rol' ,
                    privilegios.padre as 'parent_rol'  FROM lieisoft_mensajeria
                    INNER JOIN usuario ON usuario.id_usuario=$msj
                    INNER JOIN login ON login.id_usuario = $msj
                    INNER JOIN privilegios ON privilegios.nombre = login.rol    
                    WHERE $to LIKE '$me' AND lieisoft_mensajeria.id_mensaje LIKE $id;";
 
        $request = parent::RawQuery($query);
        
        /*echo "<pre>";
        print_r($request[0]);
        echo "</pre>";
        
        return;**/
        
        return $request[0];
    }

    public function SetReadChat($id) {
        
        $id_user = Session::GetSession("login" , "id");
        
        $query = "SELECT id_submensajeria as 'id_sub' FROM lieisoft_submensajeria 
                    WHERE lieisoft_submensajeria.id_usuario 
                    NOT LIKE  '$id_user' 
                    AND id_mensajeria LIKE $id
                    AND lieisoft_submensajeria.leido LIKE 0
                    ORDER BY fecha DESC , hora ASC";
        
        $result = parent::RawQuery($query);
        
        foreach ($result as $value){
            $id_sub = $value['id_sub'];
            $query  = "UPDATE lieisoft_submensajeria"
                    . " SET lieisoft_submensajeria.leido = 1"
                    . " WHERE id_submensajeria LIKE $id_sub ";
            parent::beginTransaction();
            parent::exec($query);
            parent::commit();
        }
        
        
    }

    public function SetReadInbox($id) {
        
        
        $id_user = Session::GetSession("login", "id");
        parent::Update(
             "lieisoft_mensajeria", array(
              "leido"   => "1"
         ) , " id_mensaje LIKE $id AND id_usuario_para LIKE '$id_user'");
         
        
    }

    public function GetMessageById($id) {
         $query = "SELECT mensaje FROM lieisoft_mensajeria WHERE id_mensaje LIKE $id ";
         return parent::RawQuery($query);
    }

}
