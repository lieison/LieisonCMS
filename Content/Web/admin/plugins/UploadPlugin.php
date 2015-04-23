<?php

include   '../../../Conf/Include.php';

//print_r($_FILES['']);

//DIRRECTORIO DONDE SE GUARDAN LOS MODULOS
$target_dir = "../plugins/files/";
//ARCHIVO DONDE SE ENCUENTRA EL PLUGIN
$target_file = $target_dir . basename($_FILES["plugin"]["name"]);

//VERIFICAMOS EL TIPO DE ARCHIVO DEBE SER .ZIP 
$FileType = pathinfo($target_file,PATHINFO_EXTENSION);

//VERIFICAMOS EL NOMBRE
$name = $_FILES["plugin"]["name"];

//INSTANCIAMOS EL HEADER
$header = new \Http\Header();


//VERIFICAMOS SI EXISTE EL ARCHIVO ANTERIORMENTE ANTES DE SUBIRLO
if (file_exists($target_file)) {
    unlink($target_file);
}

//VERIFICAMOS EL TIPO DE ARCHIVO
if($FileType != "zip" ){
    $header->redirect("dashboard_index.php?error=nofile");
    exit();
}

//PROCEDEREMOS A SUBIR EL ARCHIVO
$result = move_uploaded_file($_FILES["plugin"]["tmp_name"], $target_file);
echo $result . $_FILES["plugin"]["tmp_name"];

if(!$result){
    $header->redirect("dashboard_index.php?error=noupload");
    exit();
}

//DESCOMPRESION DEL ARCHIVO
$plugin = new PluginController("../" , "../plugins/files/"  . $name);
//DESCOMPRIMIMOS
$plugin->UnZipPlugin();

//REDIRECCIONAMOS AL DASHBOARD DEL MODULO
$header->redirect("dashboard_index.php");


