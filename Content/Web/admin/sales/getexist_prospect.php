<?php

 include   '../../../Conf/Include.php';
 if(!isset($_REQUEST['nombre'])):
     exit();
 endif;
 $prospecto = new ProspectController();
 $resultado = $prospecto->Find_Prospect($_REQUEST['nombre']);
 unset($prospecto);
 echo $resultado[0]['contador'];

