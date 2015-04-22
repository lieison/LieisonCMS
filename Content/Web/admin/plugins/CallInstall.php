<?php

include   '../../../Conf/Include.php';

/* @var $path type */
$path = $_REQUEST['path'];

include $path . "/install.php";

if(!class_exists('BaseInstall')){
    echo "Error, No existe la clase de instalacion ...";
    exit();
}

$install = new BaseInstall();
$install->SetPath($path);
$result = $install->Install();

if(!is_bool($result)){
    print_r($result);
}else{
    echo "true";
}





