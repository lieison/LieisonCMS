<?php


 include   '../../../Conf/Include.php';
 
 $prospecto = new ProspectController();
 $arrayp= array(
     
     "nombre" => $_REQUEST['nombre'],
     "direccion" => $_REQUEST['direccion1'],
     "direccion2" => $_REQUEST['direccion2'],
     "provincia" => $_REQUEST['provincia'],
     "ciudad" => $_REQUEST['ciudad'],
     "id_pais" => $_REQUEST['pais'],
     "zip" => $_REQUEST['zip'],
     "telefono" => $_REQUEST['telefono'],
     "fax" => $_REQUEST['fax'],
     "pagina_web" => $_REQUEST['nombre'],
     "email" => $_REQUEST['mail'],
     "facebook" => $_REQUEST['facebook'],
     "twitter" => $_REQUEST['twitter'],
     "notas" => $_REQUEST['notas'],
     "fecha" =>  FunctionsController::get_date(),
     "estado" => 1,
 );
 
 echo $prospecto->Add_Prospect($arrayp);
 

