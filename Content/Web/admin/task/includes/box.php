<?php


/**
 *ESTE SCRIPT VERIFICA LA INSTANCIA DE BOX ASI TAMBIEN GENERA LA DATA DE BOX 
 *QUE QUIERE DECIR , PUES GRACIAS A LA API TODO DEBE SERIALIZARCE
 * 
 * ?init=0 , SE LOGUE A LA CUENTA DE BOX PARA TENER ACCESO
 * ?init=1 , SI YA ESTA LOGADO OBTENEMOS LA INFORMACION
 * 
 */


include   '../../../../Conf/Include.php';
include   '../../box/BaseBox.php';

$uri = 'http://localhost/LieisonCMS/Content/Web/admin/task/includes/box.php?init=' . $_GET['init'] ? : 1;
$box = new BaseBox($uri);
$box->ConecToBox();

if(isset($_REQUEST['init'])){
    if($_REQUEST['init'] == 0){
        $header = new \Http\Header();
        $header->redirect('../../task/dashboard_add_task.php?security=1&box=1');
        exit();
    }else{
        $uri = 'http://localhost/LieisonCMS/Content/Web/admin/task/includes/box.php?init=1';
    }
}


$folders = $box->ShowAllPrimaryFolders();
   
$parent_folder = $box->ShowFiles($folders[2]['id']);
$child_folder =  $box->ShowFiles($parent_folder[1]['id']);


echo "<pre>";
print_r($parent_folder);
echo "<pre>";

echo "<pre>";
print_r($child_folder);
echo "<pre>";

