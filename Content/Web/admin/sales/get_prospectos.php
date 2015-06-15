<?php


 /**
 *@author Rolando Antonio Arriaza <rmarroquin@lieison.com>
 *@copyright (c) 2015, Lieison
 *
 *  Permission is hereby granted, free of charge, to any person obtaining a copy
    of this software and associated documentation files (the "Software"), to deal
    in the Software without restriction, including without limitation the rights
    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the Software is
    furnished to do so, subject to the following conditions:

    The above copyright notice and this permission notice shall be included in
    all copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
    SOFTWARE. 
 * 
 *@version 1.0
 *@todo Lieison S.A de C.V 
 */
 session_start();

 include   '../../../Conf/Include.php';
 
  set_dependencies(array(
      "ProspectController",
      "AdminController"
    ));
 
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
                $id_bitacora = $sales->GetIdBitacora($id_p);
                $id_type = 0;
                $id_user = UserController::GetIDUser();
                $title = "Inicio del proceso";
                $description = "Este prospecto ha iniciado el proceso de verificacion";
                $sales->InsertBitacora($id_bitacora, $id_user, $id_type, $title, $description);
                $print_status .=  " En Proceso  &nbsp&nbsp&nbsp"
                        . " <input class='btn green' type='button' onclick='ProspectInitProcess(1 ,$id_p);' "
                        . "value='Terminar Proceso' id='cmdmeta_estado' />&nbsp<a class='btn btn-primary' href='" . 
                        FunctionsController::GetUrl("dashboard_admin_prospecto.php?id=$id_p") . "'>"
                        . "<i class='fa fa-refresh'></i></a>";
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
     
     //REGISTRA LA ENTRADA DEL USUARIO HACIA EL PROSPECTO
        session_start();
        $id_user = $_SESSION['login']['id'];
        $date = FunctionsController::get_date();
        $time = FunctionsController::get_time();
        $id_p =$_REQUEST['id'];
        
        $sales->NewEntrance($id_user, $id_p, $date, $time);
       
     //TERMINA EL REGISTRO DE ENTRADA
       $prospect_data = $sales->Get_Prospect_ById($id_p);//obtener los datos por medio del id
    
     //CREACION DE LA BITACORA ...
       $sales->InitBitacora($id_p);
       
   

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
     
    
    
     
     $title_dir = "Direccion " ;
     $action_button = '' ;
     $pais = $sales->Get_Country($prospect_data['id_pais']); //obtiene el pais
     $prospect_body_dir .= '<div class="form-body"><i class="fa fa-globe"></i> <b>Provincia : </b>' . 
             $prospect_data['provincia']  . 
             '<b>&nbsp&nbsp&nbsp&nbsp  <i class="fa fa-globe"></i> Ciudad: </b>' . $prospect_data['ciudad'] . 
              '<b>&nbsp&nbsp&nbsp&nbsp  <i class="fa fa-globe"></i> Pais: </b>' . $pais .'</div>';//agrega los datos de la direccion
     

     //perfil o progreso del prospecto completado
     $propect_progress = $sales->Get_ProspectProgress($prospect_data['id_prospect']);
     $complete_profile = "(Perfil Completado:  " . $propect_progress . "%)";
     if($propect_progress >= 100){
         $complete_profile = "";
     }//si esta al 100% el progreso desaparece
     
     //cambia el titulo del dashboard por el nombre del prospecto , agrega el perfil completado
     $action_edit = "";
     if($prospect_data['meta_estado'] <= 1){
        $action_edit =  '<a class="btn blue"  href="' . FunctionsController::GetUrl('sales/dashboard_edit_prospecto.php?id=' . $prospect_data['id_prospect'] )   . '"' . '><i class="fa fa-pencil"></i></a>' ;
     }
     
     $script_title = "<script>$('#id_title').html('<p><b>" . strtoupper($prospect_data['nombre']) . "</b>"
             . "&nbsp&nbsp " . $action_edit . " <small>" . $complete_profile . "</small>" . "</p>');</script>";

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
     
    //INICIO DE NOTAS
    
    $notes_title = "Notas";
    $notes_info = '<div id="id_notes" class="form-body">';
    $notes_info .= $prospect_data['notas'] ?: "<b>No Existen notas</b>";
    $notes_info .= '</div>';
    $notes_info .= '<div class="form-actions"><div class="row">';
    $notes_info .= '<div id="id_notes_actions" class="col-md-offset-4 col-md-8">';
    $notes_info .= '<button type="button" onclick="ProspectEditNotes(' . $prospect_data['id_prospect'] . ');" class="btn blue">Agregar Notas </button>';
    $notes_info .= '</div></div>';
    $notes_info .= '</div>';
    
    //FIN DE NOTAS
    
    //INICIANDO EL FORMULARIO DE TODAS LAS ACCIONES BITACORA
    
    //OBTENEMOS LOS TIPOS DE DE DATOS QUE SE MANEJAN EN LA BITACORA
     $meta_bitacora_type = $sales->GetTypeOfBitacora();
     
     
    //CODIFICAMOS LOS TIPOS A JSON
     $json_encode = new \SivarApi\Tools\Services_JSON();
     $meta_type_json = $json_encode->encode($meta_bitacora_type);
    //LO ENVIAMOS A UN INPUT DE TIPO HIDDEN PARA LUEGO MANIPULARLO DENTRO DEL SCRIPT AjaxAdminSales.js
     $action_form = "<input type='hidden' id='BitacoraTypes' value='" . $meta_type_json . "' />";
     //CONTADOR DE LA BITACORA ¿CUANTOS LOGS EXISTEN?     
     $bitacora_counter = $sales->GetBitacorLogCount($prospect_data['id_prospect']);
     //VERIFICAMOS SI EXISTEN O NO LOGS 
    
     
     if($bitacora_counter == 0){
         
        $action_form .= '<div class="form-body">';  
        $action_form .= '<div class="alert alert-danger" role="alert">';
        $action_form .= '<i class="fa fa-exclamation-triangle"></i>';
        $action_form .= '<span>&nbsp&nbsp<b>NO SE HA INICIADO LA BITACORA</b>'
                . '&nbsp&nbsp<img src="../img/assert/flechaderecha_naranja.png" width="50" height="20" />'
                . '&nbsp&nbsp&nbsp<b>INICIE EL PROCESO</b> </span>';
        $action_form .= "</div>";
        $action_form .= '</div>';
     }
     else{ //IMPRIMIMOS LOS LOGS
         $action_form_button = "<button class='btn green' onclick='InsertBitacora(" .
                 $sales->GetIdBitacora($prospect_data['id_prospect']) . 
                 ',"' . UserController::GetIDUser() . '"' .
                 ");'><i class='fa fa-plus'></i></button>";
       
         //OBTENEMOS LOS VALORES DE LA BITACORA ANTES DE IMPRIMIRLOS 'POR LOGICA'
         $result_bitacora = $sales->GetBitacora($prospect_data['id_prospect']);
        
     
         
         $action_form .= '<div class="scroller" style="height: 430px;" '
                 . 'data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">'
                 . '<div class="general-item-list class_tbody_bitacora" id="bitacora_seccion">';
         foreach($result_bitacora as $kb=>$vb){
            $action_form .= '<div class="item class_tr_bitacora">';
            $action_form .= '<div class="item-head">';
            $action_form .= '<div class="item-details">';
            $action_form .= '<img class="item-pic" src="../img/users/' . $vb['avatar'] . '">';
            $action_form .= '<a href="" class="item-name primary-link">' .$vb['name'] .'</a>';
            $action_form .= '<span class="item-label">' .
                                FunctionsController::Get_TimeAgo($vb['date'] . " " . $vb['hour']) .
                            '</span>';
            $action_form .= '</div>';
            $action_form .= '<span class="item-status">'
                    . '<span class="badge badge-empty badge-success"></span>&nbsp&nbsp&nbsp&nbspTipo: ' .$vb['title_type']. '</span>';
            $action_form .= '</div>';
            $action_form .= '<div class="item-body">';
            $action_form .= '<b>' . $vb['title']. ':</b>';
            $action_form .= '&nbsp&nbsp' . $vb['description'];
            $action_form .= '</div>';
            $action_form .= '</div>';
         }
        /* $action_form .= '<div class="item">
		<div class="item-head">
		<div class="item-details">
		</div>
		</div>
		<div class="item-body">
		</div>
		</div>';*/
         $action_form .= '</div></div>';
         //FIN DE LA IMPRESION
     }
         
     //TITULO DE LA BITACORA ...
     $action_title = "Bitacora <span class='badge' id='bitacora_counter'>$bitacora_counter</span>";
    //FIN DE TODAS LAS ACCIONES BITACORA
     
     
     
     
    //INICIO DEL SISTEMA AGENDA
     
     $title_contact = "Contactos ";
     $action_contact ='<button type="button" onclick="NewContact(' . "'" . $prospect_data['id_prospect'] . "'" . ');" class="btn blue"><i class="fa fa-plus"></i></button>';    
     $body_contact .= '<br><table id="tabla_agenda" class="table table-striped  table-hover">';
     $nav = null;
     $contact = $sales->Get_ContactProspect($prospect_data['id_prospect']);
     if($sales->Get_ContactCount() == 0){
        $button_contact = "";
        $body_contact = '<div class="form-body">';  
        $body_contact .= '<div class="alert alert-danger" role="alert">';
        $body_contact .= '<i class="fa fa-exclamation-triangle"></i>';
        $body_contact .= '<span>&nbsp&nbsp<b>NO EXISTEN CONTACTOS </b>'
                . '&nbsp&nbsp<img src="../img/assert/flechaderecha_naranja.png" width="50" height="20" />'
                . '&nbsp&nbsp&nbsp' . $action_contact . '</span>';
        $body_contact .= "</div>";
        $body_contact .= '</div>';
     }
     else{
         $body_contact .= '<thead><th>Nombres</th>';
         $body_contact .= '<th>Titulo</th>';
         $body_contact .= '<th>E-mail</th>';
         $body_contact .= '<th>Notas</th>';
         $body_contact .= '<th></th>';
         $body_contact .= '</tr></thead>';
         $body_contact .= "<tbody id='table_contacts' name='table_contacts'>";
         
         $paginacion  = new BasePagination();
         $paginacion->porPagina(1);
         $paginacion->SetPagArrayData($contact);
         $contact = $paginacion->GetPagination();
         $nav = $paginacion->Getnavigate();        
         foreach ($contact as $c_k=>$c_v){
             
              $id_contact = $c_v['id_prospect_contact'];
              $phone_contact = $sales->Get_PhonesContact($id_contact);
              $json_phone_contact = null;
              
              $json_class = new SivarApi\Tools\Services_JSON();
              if(count($phone_contact) != 0){
                 $json_phone_contact  =$json_class->encode($phone_contact);
              }
              
              $val_id = "Ctl" . (string) $id_contact;
              $json_contact = $json_class->encode($c_v);
              $body_contact .= "<input type='hidden' name='" . $val_id . "' id='" . $val_id. "' value='" . $json_contact . "' />";
              $body_contact .= "<input type='hidden' name='" . $id_contact . "' id='" . $id_contact . "' value='" . $json_phone_contact . "' />";
              $body_contact .= '<tr id="child' . (string) $c_v['id_prospect_contact']  . '" class="odd gradeX">';
              $body_contact .= "<td>" . $c_v['nombres'] . " " . $c_v['apellidos'] . "</td>";
              $body_contact .= "<td>" . $c_v['titulo'] .  "</td>";
              $body_contact .= "<td>" . '<button type="button" onclick="EmailContact(' . "'" .  $c_v['email'] . "'"  .');" class=" btn btn-info"><i class="fa fa-envelope-o"></i></i></i></button>'  . "</td>";
              $body_contact .= "<td><button type='button' class='btn btn-success' " .  'onclick="ShowNotes('   . "'" . htmlspecialchars($c_v['notas'])  . "'" . ');"' . ">" . '<i class="fa fa-comment"></i>' ."</button></td>";
              $body_contact .= "<td>" . '<button type="button" onclick="ProspectPhones(' .  $id_contact  .');" class=" btn btn-info"><i class="fa fa-phone"></i></i></button>'  .  "";
              $body_contact .= "" . '<button type="button" onclick="NewPhoneContact(' . $c_v['id_prospect_contact'] . ')" class="btn orange"><i class="fa fa-plus"></i></button>'  .  "";
              $body_contact .= "" . '<button type="button" onclick="EditContact(' . "'" . $val_id . "'" . ');" class="btn btn-primary"><i class="fa fa-pencil"></i></button>'  .  "";
              $body_contact .= "" . '<button type="button" onclick="DeleteContact(' . "'" . $c_v['id_prospect_contact'] . "'" . ');" class="btn red"><i class="fa fa-trash-o"></i></button>'  .  "</td>";
              $body_contact .= '</tr>'; 
         }
              $body_contact .= "</tbody>";
     }
     $nav = null; //ahorita la navegacion estara desactivada
     $body_contact .= '</table><div class="form-actions">' . $nav ?: "" . '</div>';
    
    //FIN SISTEMA DE AGENDA
    
     //SCRIPT FORM 
     //SE LE AGREGAR EL SISTEMA PARA VERIFICAR SI SE AGREGARON MAS NOTIFICACIONES
    // $script_title .= " <script>setInterval('notify_bitacora($id_p)', 10000);</script>";    
    
   
     //este arreglo agrega todos los patrones a sustituir dentro del view "ViewAdmin.phtml.bak"
     $patterns = array(
         "%{script_form}%"=>$script_title,
         "%{title_dir_prospecto}%" => $title_dir,
         "%{action_button}%" => $action_button,
         "%{dir_prospecto}%" => $prospect_body_dir,
         "%{title_info}%" => $title_info,
         "%{prospect_info}%" => $prospect_info,
         "%{social_title}%" => $social_title,
         "%{social_info}%"=>$social_info,
         "%{notes_title}%" => $notes_title,
         "%{notes_info}%"=>$notes_info,
         "%{title_action_form}%" => $action_title,
         "%{action_form}%"=> $action_form, 
         "%{action_form_button}%"=>$action_form_button,
         "%{title_contact}%"=> $title_contact,
         "%{body_contact}%"=> $body_contact,
         "%{actions_contact}%" => $action_contact
     );
     
     
     
     ViewClass::PrepareView("ViewAdmin.phtml", "Admin/Sales");
     $params = ViewClass::SetPatternString($patterns);
     ViewClass::SetView($params);
   
}
else{
    
    //CARGA TODOS LOS PROSPECTOS EN EL PRINCIPAL
    $inactivos = trim($_REQUEST['inactivo']);
    $terminados = trim($_REQUEST['terminados']);
    
    if($inactivos == "false"){ $inactivos= false;}
    else { $inactivos= true;}
    
    if($terminados == "false"){ $terminados= false;}
    else { $terminados= true;}
    
    $result = $sales->Get_All_Prospect($inactivos , $terminados );
    $val = '';

    foreach($result as $k=>$v)
    {
        $id = $v['id_prospect'];
        $name = $v['nombre'];
        $val .= "<option value='$id'><b>$name</b></option>";
    }
  
    echo $val;
}

unset($sales);









 
 