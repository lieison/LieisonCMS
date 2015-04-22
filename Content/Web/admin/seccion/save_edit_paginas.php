<?php

 include   '../../../Conf/Include.php';
 
 
 $id = $_REQUEST['id'];
 $titulo = $_REQUEST['titulo'];
 $icono = $_REQUEST['icono'];
 $link = $_REQUEST['link'];
 $seccion = $_REQUEST['seccion'];
 $priv = $_REQUEST['priv'];
 
 
 //COMENZAMOS A VERIFICAR LOS IDS DE LOS PRIVILEGIOS OTORGADOS
 $pieces_priv = explode(",", $priv);
 $admin = new AdminController();
 $admin_priv = $admin->Get_MasterPrivilegios();
 unset($admin);
 
 $priv_ids = array();
 foreach ($pieces_priv as $pieces){
     foreach ($admin_priv as $val){
         if($pieces === $val['nombre']){
             array_push($priv_ids, $val['nivel']);
         }
     }
 }
 //TERMINAMOS DE OBTENER LOS IDS DE LOS PRIVILEGIOS O NIVELES DE ELLOS
 $priv_ids = implode(",", $priv_ids); //pegamos los ids en texto plano separado por coma
 
 $page = new PageController();
 
 $array_data = array(
     "id_seccion" => $seccion,
     "icono" => $icono,
     "link" => $link,
     "titulo"=> $titulo , 
     "privilegios" => $priv_ids
 );
 
 $result = $page->Set_UpdateDashboard($id, $array_data);
 echo $result;
 
 
 
 
 
 
 
 
 
