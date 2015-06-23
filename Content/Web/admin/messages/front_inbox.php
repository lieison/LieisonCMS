<?php


 include   '../../../Conf/Include.php';


 //Inicia sesion 
 Session::InitSession();
 
 //agrega las dependencias
 set_dependencies(array(
     "MessageController"
 ));
 
 //controlador del mensaje 
 $messagecontroller = new MessageController();

 
 $id_user   = Session::GetSession("login", "id"); //id del usuario
 
 
 $count     = $messagecontroller->GetMessageCountFrom($id_user); //cuenta los mensajes
 $msjto     = $messagecontroller->GetMessageFrom($id_user , null); //mensaje para
 

 $count_submsj = 0; //

 
 if(count($msjto) == 0){
      $msjto = $messagecontroller->GetMessageTo($id_user , null);
 }
 
 foreach ($msjto as $k=>$v){
     $r = $messagecontroller->GetCountSubMessage($v['id_mensaje'] , $id_user);
     $count_submsj += $r;
 }


 $count += $count_submsj;
 
 $array_    = array();

 
 $array_['count'] = array(
         "counter"  => $count,
         "url"      => FunctionsController::GetUrl("messages") . '/inbox.php'   
  );
 
 $data = "";
 
 foreach ($msjto as $key=>$value)
 {
     
     
     $data .= '<li>';
     $data .= '<a href="javascript:chat_preview(' . $value['id_mensaje'] . ');">';
     $data .= '<span class="photo">';
     
     if ($value['imagen'] == null) {
        $data .= '<img src="' . FunctionsController::GetUrl("img" , false) . '/users/avatar.png" class="img-circle" alt="">';
     } else {
        $data .= '<img src="' . FunctionsController::GetUrl("img" , false) . '/users/' . $value['imagen'] . '" class="img-circle" alt="">';
     }
     
     $data .= '</span>';
     $data .= '<span class="subject">';
     
     $sub_msj = $messagecontroller->GetCountSubMessage($value['id_mensaje'] , $id_user);
     
     if($sub_msj >= 1){
        $data .= '<span class="badge badge-default">';
        $data .= $sub_msj . '</span>';
     }
     
     $data .= '<span class="from">';
     $data .=  $value['nombre'] . '</span>';
     $data .= '<span class="time">'  . FunctionsController::Get_TimeAgo($value['fecha']. " " . $value['hora']) .'</span>';
     $data .= '</span>';
     $data .= '<br><span class="message">';
     $data .= '<b>' . $value['asunto'] . "</b><br>"; 
     
     if(strlen($value['mensaje'])  >= 65)
     {
         $data .= substr($value['mensaje'], 0 , 60) . ' (...)';
     }else{
         $data .= $value['mensaje'];
     }
     
     $data .= '</span>';
     $data .= '</a>';
     $data .= '</li>';
   
     
 }
 
 $array_['inbox'] = array("data" => $data);
 $json = new SivarApi\Tools\Services_JSON();
 echo $json->encode($array_);

 unset( $messagecontroller);
 
 
