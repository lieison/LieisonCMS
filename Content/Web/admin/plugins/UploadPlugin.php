<?php

include   '../../../Conf/Include.php';

print_r($_FILES['']);

$target_dir = "../plugins/files/";
$target_file = $target_dir . basename($_FILES["plugin"]["name"]);
$uploadOk = 1;
$FileType = pathinfo($target_file,PATHINFO_EXTENSION);
$name = $_FILES["plugin"]["name"];
$header = new \Http\Header();


if (file_exists($target_file)) {
    unlink($target_file);
}

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
$plugin->UnZipPlugin();
$header->redirect("dashboard_index.php");


