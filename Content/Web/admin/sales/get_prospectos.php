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
     
     
     $sales = new ProspectController();//constructor nuevo sales en el controlador
     $prospect_data = $sales->Get_Prospect_ById($_REQUEST['id']);//obtener los datos por medio del id

     //verifica si los datos del prospecto existe
     if (count($prospect_data) == 0) {
        exit();
     }

     //Prospect body , este caso no
     $prospect_body_dir = "";
     
     if(SivarApi\Tools\Validation::Is_Empty_OrNull($prospect_data['direccion'])){
        $prospect_body_dir .= '<div class="form-body"><i class="fa fa-map-marker"></i>  <b>Direccion: </b> Sin Direccion </div>';
     }else{
         $prospect_body_dir .= '<div class="form-body"><i class="fa fa-map-marker"></i><b>Direccion: </b>' . $prospect_data['direccion']  . '</div>';
     }
     if(SivarApi\Tools\Validation::Is_Empty_OrNull($prospect_data['direccion'])){
        $prospect_body_dir .= '<div class="form-body"><i class="fa fa-map-marker"></i> <b>Direccion 2: </b> Sin Direccion </div>';
     }else{
         $prospect_body_dir .= '<div class="form-body"><i class="fa fa-map-marker"></i> <b>Direccion 2: </b>' . $prospect_data['direccion2']  . '</div>';
     }
     
    
     $pais = $sales->Get_Country($prospect_data['id_pais']); //obtiene el pais
     $prospect_body_dir .= '<div class="form-body"><i class="fa fa-globe"></i> <b>Provincia : </b>' . 
             $prospect_data['provincia']  . 
             '<b>&nbsp&nbsp&nbsp&nbsp  <i class="fa fa-globe"></i> Ciudad: </b>' . $prospect_data['ciudad'] . 
              '<b>&nbsp&nbsp&nbsp&nbsp  <i class="fa fa-globe"></i> Pais: </b>' . $pais .'</div>';//agrega los datos de la direccion
     
     
     
     $field_count = count($prospect_data) - 4; //cuenta los campos necesarios para completar el perfil
     $field_empty = 0;//campos vacios
    
     
     foreach($prospect_data as $k)
     {
         if(SivarApi\Tools\Validation::Is_Empty_OrNull($k)){
             $field_empty += 1;
         }
     }//verifica cuantos campos vacios hay 
      
     //si existen campos vacios dara un procentaje de progreso
     $complete_profile = "(Perfil Completado:  " . round((($field_empty/$field_count) * 100), 2) . "%)";
     if($complete_profile >= 100){
         $complete_profile = "";
     }//si esta al 100% el progreso desaparece
     
     //cambia el titulo del dashboard por el nombre del prospecto , agrega el perfil completado
     $script_title = "<script>$('#id_title').html('<p><b>" . strtoupper($prospect_data['nombre']) . "</b>"
             . "&nbsp&nbsp <small>" . $complete_profile . "</small></p>')</script>";

     
     
     //este arreglo agrega todos los patrones a sustituir dentro del view "ViewAdmin.phtml"
     $patterns = array(
         "%{script_form}%"=>$script_title,
         "%{title_dir_prospecto}%" => "Direccion ",
         "%{dir_prospecto}%" => $prospect_body_dir,
         "%{title_right_form}%" => "",
         "%{right_form}%"=> ""
     );
     
     
     ViewClass::PrepareView("ViewAdmin.phtml", "Admin/Sales");
     $params = ViewClass::SetPatternString($patterns);
     ViewClass::SetView($params);
   
}

?>







 
 