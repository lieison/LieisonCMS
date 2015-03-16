<?php

 include   '../../../Conf/Include.php';
 $sales = new ProspectController();//constructor nuevo sales en el controlador
 
 if(isset($_REQUEST['new_notes'])){
     $html = $_REQUEST['new_notes'];
     $id_p = $_REQUEST['id_prospect'];
     echo $sales->Set_NewNotes($html , $id_p);
     unset($html);
     unset($id_p);
     exit();
 }
