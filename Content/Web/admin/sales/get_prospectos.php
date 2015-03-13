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
        $prospect_body .= '<div class="form-body"><i class="fa fa-map-marker"></i>  <b>Direccion: </b> Sin Direccion </div>';
     }else{
         $prospect_body .= '<div class="form-body"><i class="fa fa-map-marker"></i><b>Direccion: </b>' . $prospect_data['direccion']  . '</div>';
     }
     if(SivarApi\Tools\Validation::Is_Empty_OrNull($prospect_data['direccion'])){
        $prospect_body .= '<div class="form-body"><i class="fa fa-map-marker"></i> <b>Direccion 2: </b> Sin Direccion </div>';
     }else{
         $prospect_body .= '<div class="form-body"><i class="fa fa-map-marker"></i> <b>Direccion 2: </b>' . $prospect_data['direccion2']  . '</div>';
     }
     
     
     $pais = $sales->Get_Country($prospect_data['id_pais']);
     $prospect_body .= '<div class="form-body"><i class="fa fa-globe"></i> <b>Provincia : </b>' . 
             $prospect_data['provincia']  . 
             '<b>&nbsp&nbsp&nbsp&nbsp  <i class="fa fa-globe"></i> Ciudad: </b>' . $prospect_data['ciudad'] . 
              '<b>&nbsp&nbsp&nbsp&nbsp  <i class="fa fa-globe"></i> Pais: </b>' . $pais .'</div>';
     
     
     
     $field_count = count($prospect_data) - 4;
     $field_empty = 0;
     $right_form = null;
     $right_title_form = null;
     
     foreach($prospect_data as $k)
     {
         if(SivarApi\Tools\Validation::Is_Empty_OrNull($k)){
             $field_empty += 1;
         }
     }
     
     if($field_empty != 0)
     {
         //$right_form = get_chart($field_count, $field_empty);
        // $right_form .= ' <div  class="form-body"><div id="chartdiv" style="width: 100%; height: 400px; background-color: #FFFFFF;" ></div></div>';
        // $right_title_form = "Perfil Completado:  " . ($field_empty/ $field_count)* 100 . "%";
         $right_title_form = "Perfil Completado:  " . round((($field_empty/$field_count) * 100), 2) . "%";
     }else
     {
         
     }
     
   
     
     $patterns = array(
         "%{prospecto}%" => "Direccion ",
         "%{cuerpo_prospecto}%" => $prospect_body,
         "%{title_right_form}%" => $right_title_form,
         "%{right_form}%"=>$right_form
     );
     
     ViewClass::PrepareView("ViewAdmin.phtml", "Admin/Sales");
     $params = ViewClass::SetPatternString($patterns);
     ViewClass::SetView($params);
    
    // echo '<div class="row">';
     
    //echo '</div>'; 
}

?>




<?php

function get_chart($total , $empty)
{
    $progress = $total - $empty;
    $rest = $empty;
    return '<script type="text/javascript"> 
			AmCharts.makeChart("chartdiv",
				{
					"type": "pie",
					"pathToImages": "http://cdn.amcharts.com/lib/3/images/",
					"angle": 12,
					"balloonText": "[[title]]<br><span style="font-size:14px"><b>[[value]]</b> ([[percents]]%)</span>",
					"depth3D": 15,
					"titleField": "category",
					"valueField": "column-1",
					"allLabels": [],
					"balloon": {},
					"legend": {
						"align": "center",
						"markerType": "circle"
					},
					"titles": [],
					"dataProvider": [
						{
							"category": "Progreso",
							"column-1": "' . $progress . '"
						},
						{
							"category": "Faltante",
							"column-1": "' . $rest . '"
						}
					]
				}
		);
		</script>';
}


?>



 
 