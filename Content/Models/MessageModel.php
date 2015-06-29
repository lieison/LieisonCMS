<?php

defined("MESSAGE_FROM") or define("MESSAGE_FROM", 0);
defined("MESSAGE_FROM") or define("MESSAGE_TO", 0);

abstract class MessageModel extends MysqlConection {
    
    public abstract function SetMessage($id_u_para , $id_u_de  , $mensaje ,  $asunto = null);
    public abstract function SetSubmessage($id_message , $id_usuario , $mensaje);
    public abstract function  GetMessageFrom($id_u_para , $limit = null ,$not_read = 0 , $trash = false);
    public abstract function  GetMessageTrash($id_u_para  , $state = MESSAGE_FROM);
    public abstract  function GetMessageTo($id_u_de , $limit = null) ;
    public abstract  function GetMessageById($id) ;
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
