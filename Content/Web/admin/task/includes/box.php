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

$uri = FunctionsController::GetUrl('task/includes/box.php?init=' . $_GET['init'] ? : 1);
$box = new BaseBox($uri);
$box->ConecToBox();

if(isset($_REQUEST['init'])){
    if($_REQUEST['init'] == 0){
        $header = new \Http\Header();
        $header->redirect('../../task/dashboard_add_task.php?security=1&box=1');
        exit();
    }else{
        $uri = FunctionsController::GetUrl('task/includes/box.php?init=1');
    }
}


if(!isset($_REQUEST['folder'])){
    $folders = $box->ShowAllPrimaryFolders();
    echo '<h3>Seleccione un directorio</h3>';
    echo "<select onchange='GetBoxChild(0 , null);' class='form-control' id='box_parent' name='box_parent'  >";
    echo '<option value="-1">...</option>';
    foreach ($folders as $parent){
        if($box->Get_type($parent['type']) == 0){
            $id = $parent['id'];
            $name = $parent['name'];
            echo '<option value="' . $id . '">' . $name . '</option>';
        }
    }
    echo "</select>";
}else{
     $id_folder = $_REQUEST['folder'] ? : null;
     if($id_folder == null){
         exit();
     }
     
     $child_folder = $box->ShowFiles($id_folder);
     $html_string = "";
     $html_tree = $_REQUEST['file_tree'] ? : "" ;
     
     
     foreach ($child_folder as $childrens){
         
         $tree_chilrens =   '<input onclick="AddFile(this.value, null);" type="checkbox" autocomplete="off" value="' 
                            . $html_tree 
                            . "-->" 
                            . $childrens['name'] 
                            . '">&nbsp;';
         
         if($box->Get_type($childrens['type']) == 0){
             $html_string .= '<a class="list-group-item green" href="javascript:GetBoxChild(' 
                          . "'" 
                          .$childrens['id']  . "',"  . "'" 
                          .$html_tree . "-->" 
                          . $childrens['name'] 
                          . "'" 
                          . ');" >'
                          .$tree_chilrens;
             
             $html_string .= '<i class="fa fa-folder"></i>&nbsp;&nbsp;' . $childrens['name'] . '</a>';
         }
         else{
          if( $childrens['url'] != null){
            
           $tree_chilrens =   '<input onclick="AddFile(this.value ,' 
                            . "'" .$childrens['url']  . "'"
                            . ' );" type="checkbox" autocomplete="off" value="' 
                            . $html_tree 
                            . "-->" 
                            . $childrens['name'] 
                            . '">&nbsp;';   
              
           $html_string .= '<a target="_blank" href="' 
                        . $childrens['url'] 
                        . '" class="list-group-item" >'
                        . $tree_chilrens 
                        . '<i class="fa fa-file"></i>&nbsp;&nbsp;' 
                        . $childrens['name'] 
                        . " &nbsp;(" . $childrens['size'] . ")&nbsp;&nbsp;&nbsp; Descargado " 
                        . $childrens['download_count'] . ' Veces. </a>';
             }
             else{
                  $html_string .= '<a href="#" class="list-group-item" >'
                        . $tree_chilrens  
                        . '<i class="fa fa-file"></i>&nbsp;&nbsp;' 
                        . $childrens['name'] . " &nbsp;(" . $childrens['size'] . ")&nbsp;&nbsp; (No URL)" . ' </a>';
             }
         }
         
     }
     
     echo $html_string ? : '<div class="alert alert-warning" role="alert">Opps!! Nada por aqui , Nada por alla.</div>';
     
}





?>











