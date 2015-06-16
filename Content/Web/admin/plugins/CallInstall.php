<?php

include   '../../../Conf/Include.php';



/* @var $path type */
$path = $_REQUEST['path'];

//DIRECCION DEL ARCHIVO INSTALACION
include $path . "/install.php";

//VERIFICAMOS IS LA CLASE DE INSTALACION EXISTE
if(!class_exists('BaseInstall')){
    echo "Error, No existe la clase de instalacion ...";
    exit();
}

//INSTALAMOS
$install = new BaseInstall();
//CONFIGURAMOS EL PATH
$install->SetPath($path);

//VERIFICAMOS LA INTALACION
$result = $install->Install();

//FINALIZANDO PROCESO SE ESPERA EXITOSO
if(!is_bool($result)){
    print_r($result);
}else{
    echo "true";
}





