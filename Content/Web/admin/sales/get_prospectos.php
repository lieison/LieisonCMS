<?php

 include   '../../../Conf/Include.php';
 
 $sales = new ProspectController();//constructor nuevo sales en el controlador
 
 //CAMBIAR PROCESO DEL PROSPECTO
 if(isset($_REQUEST['meta_estado'])){
    
    $id_p = $_REQUEST['id_prospect'];
    $print_status = '<div id="meta_estado"><i class="fa fa-building-o"></i>&nbsp&nbsp <b>Arranque Del Prospecto:</b>';
    if($sales->Set_MetaStatus($_REQUEST['meta_estado']+1, $id_p) == true)
    {
        switch($_REQUEST['meta_estado'])
        {
            case 0:
                $print_status .=  " En Proceso  &nbsp&nbsp&nbsp <input class='btn green' type='button' onclick='ProspectInitProcess(1 ,$id_p);' value='Terminar Proceso' id='cmdmeta_estado' />";
                break;
            case 1:
                 $print_status .=  " Proceso Terminado ";
                break;
        }
    }
    else{
        $print_status .= "Opps!! Hubo algun error , Intente Luego";
    }
    $print_status .= "</div>";
    echo $print_status;
 }
 else if(isset ($_REQUEST['estado'])){ //CAMBIAR ESTADO DEL PROSPECTO
    
     
    $id_p = $_REQUEST['id_prospect'];
    $print_status = '<div id="prospect_estado"><i class="fa fa-building-o"></i>&nbsp&nbsp <b>Estado: </b>';
    if($sales->Set_Estatus($_REQUEST['estado'], $id_p) == true)
    {
        switch($_REQUEST['estado'])
        {
            case 0:
                $print_status .=  " No Activo  &nbsp&nbsp&nbsp <input class='btn green' type='button' onclick='ProspectActivate(1 ,$id_p);' value='Activar' id='cmd_estado' />";
                break;
            case 1:
                 $print_status .= " Activo  &nbsp&nbsp&nbsp <input class='btn green' type='button' onclick='ProspectActivate(0 ,$id_p);' value='Desactivar' id='cmd_estado' />";
                break;
        }
    }
    else{
        $print_status .= "Opps!! Hubo algun error , Intente Luego";
    }
    $print_status .= "</div>";
    echo $print_status;
 }
 else if(isset($_REQUEST['id']))
{
     //INICIAR PROSPECTO ... IMPRIMIR TODOS LOS DATOS

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
             . "&nbsp&nbsp <small>" . $complete_profile . "</small></p>');</script>";

     /*INICIO DE LA INFORMACION DEL PROSPECTO */
     $title_info = "Informacion Del Prospecto";
     $prospect_info = '<div class="form-body">';
     $prospect_info .= '<i class="fa fa-building-o"></i>&nbsp&nbsp <b>Nombre:</b> '
             . $prospect_data['nombre'] . '<br><br>' ;
     $prospect_info .= '<i class="fa fa-building-o"></i>&nbsp&nbsp <b>Telefono:</b> '
             . "(" . $prospect_data['zip'] . ") " . $prospect_data['telefono'] . '<br><br>' ;
     $prospect_info .= '<i class="fa fa-building-o"></i>&nbsp&nbsp <b>Fax:</b> '
             . $prospect_data['fax'] . '<br><br>' ;
     $prospect_info .= '<i class="fa fa-building-o"></i>&nbsp&nbsp <b>Fecha de Entrada:</b> '
             . $prospect_data['fecha'] . '<br><br>' ;
     $prospect_info .= '<div id="prospect_estado"><i class="fa fa-building-o"></i>&nbsp&nbsp <b>Estado:</b> ';
            if($prospect_data['estado'] == 1){
                $prospect_info .= "Activo &nbsp&nbsp&nbsp <input class='btn green' type='button' onclick='ProspectActivate(0 ," 
                 . $prospect_data['id_prospect']  . ");' value='Desactivar' id='cmd_estado' />";
            }else{
                $prospect_info .= "No Activo &nbsp&nbsp&nbsp <input class='btn green' type='button' onclick='ProspectActivate(1 ," 
                 . $prospect_data['id_prospect']  . ");' value='Activar' id='cmd_estado' />";
            }
     $prospect_info .= "</div><br><br>";
     $prospect_info .= '<div id="meta_estado"><i class="fa fa-building-o"></i>&nbsp&nbsp <b>Arranque Del Prospecto:</b> ';
     switch ($prospect_data['meta_estado']){
         case 0:
             $prospect_info .= "No iniciado &nbsp&nbsp&nbsp <input class='btn green' type='button' onclick='ProspectInitProcess(0 ," 
                 . $prospect_data['id_prospect']  . ");' value='Iniciar Proceso' id='cmdmeta_estado' />";
             break;
         case 1:
             $prospect_info .= " En Proceso  &nbsp&nbsp&nbsp <input class='btn green' type='button' onclick='ProspectInitProcess(1 , " 
                 . $prospect_data['id_prospect']  . ");' value='Terminar Proceso' id='cmdmeta_estado' />";
             break;
         case 2:
             $prospect_info .= "Terminado";
             break;
     }
     $prospect_info .= '</div>';
     $prospect_info .= '</div>';
     //FIN DE LA INFORMACION DEL PROSPECTO 
     
     //INICIO DE LAS REDES SOCIALES DEL PROSPECTO ...
    $social_title = " Redes Sociales";
    $social_info = '<div class="form-body">';
    $social_info .= '<i  class="fa fa-globe"></i>&nbsp&nbsp<b>Pagina Web: </b>'
            . '<a target="_blank" href="' . $prospect_data['pagina_web'] . '">' 
            . $prospect_data['pagina_web'] . '</a>' ;
    $social_info .= "<br><br>";
    $social_info .= '<i class="fa fa-facebook"></i>&nbsp&nbsp<b>Facebook: </b>';
    $social_info .= '<a target="_blank" href="' . $prospect_data['facebook'] . '">' 
            . $prospect_data['facebook'] . '</a>' ;
    $social_info .= "<br><br>";
    $social_info .= '<i class="fa fa-twitter"></i>&nbsp&nbsp<b>Twitter: </b>';
    $social_info .= '<a target="_blank" href="https://twitter.com/' . $prospect_data['twitter'] . '">@' 
            . $prospect_data['twitter'] . '</a>' ;
    $social_info .= "<br>";
    $social_info .= "</div>";
     //FIN DE LAS REDES SOCIALES
     
    
     
     //este arreglo agrega todos los patrones a sustituir dentro del view "ViewAdmin.phtml"
     $patterns = array(
         "%{script_form}%"=>$script_title,
         "%{title_dir_prospecto}%" => "Direccion " ,
         "%{dir_prospecto}%" => $prospect_body_dir,
         "%{title_info}%" => $title_info,
         "%{prospect_info}%" => $prospect_info,
         "%{social_title}%" => $social_title,
         "%{social_info}%"=>$social_info,
         "%{title_right_form}%" => "",
         "%{right_form}%"=> ""
     );
     
     
     ViewClass::PrepareView("ViewAdmin.phtml", "Admin/Sales");
     $params = ViewClass::SetPatternString($patterns);
     ViewClass::SetView($params);
   
}
else{
    
    //CARGA TODOS LOS PROSPECTOS EN EL PRINCIPAL

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

?>







 
 