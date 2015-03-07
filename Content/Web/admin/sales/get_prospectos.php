<?php

 include   '../../../Conf/Include.php';
 
 if(!isset($_REQUEST['id'])){

    $sales = new ProspectController();
    $result = $sales->Get_All_Prospect();
 
    $val = '';
    foreach($result as $k=>$v)
    {
        $id = $v['id_prospect'];
        $name = $v['nombre'];
        $val .= "<option value='$id'>$name</option>";
    }
    echo $val;
 }
 else if(isset($_REQUEST['id']))
{
     $sales = new ProspectController();
     $prospect_data = $sales->Get_Prospect_ById($_REQUEST['id']);
     
     if (count($prospect_data) == 0) {
        exit();
     }
     
     ViewClass::PrepareView("ViewAdmin.phtml", "Admin/Sales");
     $params = ViewClass::SetParamsString("" , "" , "" , "");
     ViewClass::SetView($params);
    
    // echo '<div class="row">';
     
    //echo '</div>'; 
}





 
 