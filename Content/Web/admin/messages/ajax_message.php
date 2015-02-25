<?php

 session_start();
 include   '../../../Conf/Include.php';
 
 $messagecontroller = new MessageController();
 
 $id_user = $_SESSION['login']['id'];
 $count = $messagecontroller->GetMessageCountFrom($id_user);
 
 $msjto = $messagecontroller->GetMessageFrom($id_user , null);
 
 $count_submsj = 0;
 
 if(count($msjto) == 0)
 {
      $msjto = $messagecontroller->GetMessageTo($id_user , null);
 }
 
 foreach ($msjto as $k=>$v)
 {
     $r = $messagecontroller->GetCountSubMessage($v['id_mensaje'] , $id_user);
     $count_submsj += count($r);
 }
 
 $count = $count + $count_submsj;
 
 echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">';
 echo '<i class="icon-envelope-open"></i>';
 echo '<span class="badge badge-default">';
 
 if($count == 0){
     echo '0</span>';
     echo '</a><ul class="dropdown-menu">';
     echo '<li class="external">
            <h3>No Hay <span class="bold">Mensajes</span> Recientes  </h3>
		<a href="' . FunctionsController::GetUrl("messages") . '/inbox.php">Ver Todos</a>
	    </li>';
 }
 else{
     echo $count .'</span>';
     echo '</a><ul class="dropdown-menu">';
     if($count == 1){
        echo '<li class="external">
            <h3>' . $count . ' <span class="bold">Mensaje</span> Reciente  </h3>
		<a href="' . FunctionsController::GetUrl("messages") . '/inbox.php">Ver Todos</a>
	    </li>';
     }else{
           echo '<li class="external">
            <h3>' . $count . ' <span class="bold">Mensajes</span> Recientes </h3>
		<a href="' . FunctionsController::GetUrl("messages") . '/inbox.php">Ver Todos</a>
	    </li>';
     }
 }
 
 echo '<li>';
 foreach ($msjto as $key=>$value)
 {
     echo '<ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">';
     echo '<li>';
     echo '<a href="' . FunctionsController::GetUrl("messages") . '/inbox.php?id_mensaje=' . $value['id_mensaje'] . '">';
     echo '<span class="photo">';
     if ($value['imagen'] == null) {
        echo '<img src="' . FunctionsController::GetUrl("img") . '/users/avatar.png" class="img-circle" alt="">';
     } else {
        echo '<img src="' . FunctionsController::GetUrl("img") . '/users/' . $value['imagen'] . '" class="img-circle" alt="">';
     }
     echo '</span>';
     echo '<span class="subject">';
     $sub_msj = $messagecontroller->GetCountSubMessage($value['id_mensaje'] , $id_user);
     if($sub_msj >= 1){
        echo '<span class="badge badge-default">';
        echo $sub_msj . '</span>';
     }
     echo '<span class="from">';
     echo  $value['nombre'] . '</span>';
     if($value['fecha'] == FunctionsController::get_date()){
        echo '<span class="time">' .$value['hora'] . '</span>';
     }else{
          echo '<span class="time">' . $value['fecha'] . " a las " . $value['hora'] . '</span>';
     }
     echo '</span>';
     echo '<br><span class="message">';
     echo '<b>' . $value['asunto'] . "</b><br>"; 
     if(strlen($value['mensaje'])  >= 65)
     {
         echo substr($value['mensaje'], 0 , 60) . ' (...)';
     }else{
         echo $value['mensaje'];
     }
     echo '</span>';
     echo '</a>';
     echo '</li>';
   
 }
  echo '</li>';
 echo '</ul>';
 
 