<?php


class MessageController extends MessageModel {
    
    
    public function SetPermisssionMessage($id_usuario , $id_usuario_permission)
    {
        $this->Insert("lieisoft_mensajes_permisos", array(
            "id_usuario"=>$id_usuario,
            "id_usuario_permiso"=>$id_usuario_permission
        ));
    }
    
    public function GetUsersPermission($id_usuario)
    {
         $result = $this->RawQuery("SELECT usuario.id_usuario , concat(usuario.nombre , ' ' , usuario.apellido) as nombre"
                 . " usuario.imagen FROM usuario INNER JOIN lieisoft_mensajes_permisos ON "
                 . " usuario.id_usuario=lieisoft_mensajes_permisos.id_usuario_permiso WHERE "
                 . " usuario.id_usuario LIKE '$id_usuario'");
         return $result;
    }
    
    public function DeleteMessage($id_message) {
        
    }

    public function DeleteSubMessage($id_submesage) {
        
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

    public function GetMessageFrom($id_u_para) {
        $query = "SELECT lieisoft_mensajeria.id_mensaje ,  lieisoft_mensajeria.asunto ,"
                . " lieisoft_mensajeria.fecha , lieisoft_mensajeria.hora , lieisoft_mensajeria.mensaje ,"
                . " concat(usuario.nombre , ' ' , usuario.apellido) as nombre , usuario.imagen "
                . " FROM lieisoft_mensajeria INNER JOIN usuario ON lieisoft_mensajeria.id_usuario_de=usuario.id_usuario"
                . " WHERE lieisoft_mensajeria.id_usuario_para LIKE '$id_u_para' ORDER BY lieisoft_mensajeria.hora ASC"
                . " LIMIT 5 ";
        
        return $result = $this->RawQuery($query); 
    }

    public function GetMessageTo($id_u_de) {
        
    }

    public function SetMessage($id_u_para, $id_u_de, $mensaje ,  $asunto = null) {
         $this->Insert("lieisoft_mensajeria" , array(
             "id_usuario_para" => $id_u_para ,
             "id_usuario_de" => $id_u_de,
             "asunto"=> $asunto ,
             "mensaje"=>$mensaje,
             "fecha" => FunctionsController::get_date(),
             "hora" => FunctionsController::get_time(),
             "leido" => 0
             ));
    }

    public function SetSubmessage($id_message, $id_usuario, $mensaje) {
        $this->Insert("lieisoft_submensajeria" , array(
            "id_mensajeria"=>$id_message,
            "id_usuario"=>$id_usuario,
            "mensaje"=>$mensaje,
            "fecha"=>  FunctionsController::get_date(),
            "hora"=>  FunctionsController::get_time()
        ));
    }

}
