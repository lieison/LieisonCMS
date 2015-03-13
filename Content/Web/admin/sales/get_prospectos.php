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
     
     
     $prospect_body = "";
     
     if(SivarApi\Tools\Validation::Is_Empty_OrNull($prospect_data['direccion'])){
        $prospect_body .= '<div class="form-body"><b>Direccion: </b> Sin Direccion </div>';
     }else{
         $prospect_body .= '<div class="form-body"><b>Direccion: </b>' . $prospect_data['direccion']  . '</div>';
     }
     if(SivarApi\Tools\Validation::Is_Empty_OrNull($prospect_data['direccion'])){
        $prospect_body .= '<div class="form-body"><b>Direccion 2: </b> Sin Direccion </div>';
     }else{
         $prospect_body .= '<div class="form-body"><b>Direccion 2: </b>' . $prospect_data['direccion2']  . '</div>';
     }
     
     $prospect_body .= '<div class="form-body"><b>Provincia : </b>' . 
             $prospect_data['provincia']  . '<b>&nbsp&nbsp&nbsp&nbsp  Ciudad: </b>' . $prospect_data['ciudad'] . '</div>';
     

     $patterns = array(
         "%{prospecto}%" => $prospect_data['nombre'],
         "%{cuerpo_prospecto}%" => $prospect_body 
     );
     
     ViewClass::PrepareView("ViewAdmin.phtml", "Admin/Sales");
     $params = ViewClass::SetPatternString($patterns);
     ViewClass::SetView($params);
    
    // echo '<div class="row">';
     
    //echo '</div>'; 
}





 
 