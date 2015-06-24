<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MessageModel
 *
 * @author rolandoantonio
 */
abstract class MessageModel extends MysqlConection {
    
    public abstract function SetMessage($id_u_para , $id_u_de  , $mensaje ,  $asunto = null);
    public abstract function SetSubmessage($id_message , $id_usuario , $mensaje);
    public abstract function  GetMessageFrom($id_u_para , $limit = null ,$not_read = false , $trash = false);
    public abstract  function GetMessageTo($id_u_de , $limit = null) ;
    public abstract  function GetMessageCountFrom($id_u_para , $no_read = true);
    public abstract  function DeleteMessage($id_message);
    public abstract  function DeleteSubMessage($id_submesage);
    public abstract  function GetSubMessage($id_mensaje);
    public abstract  function GetCountSubMessage($id_mensaje  , $id_user, $not_read = true);
    
    public abstract  function GetChatById($id);
    public abstract  function GetActiveUserChat($id);
    public abstract  function SetReadChat($id);
    public abstract  function SetReadInbox($id);
    
  
    
}
