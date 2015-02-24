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
    public abstract function GetMessageFrom($id_u_para);
    public abstract  function GetMessageTo($id_u_de);
    public abstract  function GetMessageCountFrom($id_u_para , $no_read = true);
    public abstract  function DeleteMessage($id_message);
    public abstract  function DeleteSubMessage($id_submesage);
}
