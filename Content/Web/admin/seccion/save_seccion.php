<?php

 include   '../../../Conf/Include.php';
 
 $titulo = $_REQUEST['titulo'] ? : null;
 $icono = $_REQUEST['icono'] ? : null;
 $inicio = $_REQUEST['inicio'] ? : null;
 $priv = $_REQUEST['priv'] ? : null;
 
 if($titulo == null ){
     exit();
 }
 
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
 
 $priv_ids = implode(",", $priv_ids);
 
 $page = new PageController();
 $page->Set_NewSeccion($titulo, $icono, $inicio, $priv_ids);