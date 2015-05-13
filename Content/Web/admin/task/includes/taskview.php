<?php

include   '../../../../Conf/Include.php';

/**
 * type : 0 = mis tareas
 *        1 = tareas que he asignado
 * 
 * style: 0 = estilo portlet
 *        1 = estilo tabla
 * 
 * order : 0 = por fecha de asignacion
 *         1 = deadline
 *         2 = en proceso
 *         3 = espera
 *         4 = termianda
 */ 

Session::InitSession();
 
$type       = $_REQUEST['type'] ? : 0;  //verifica el tipo de tarea a mostrar 0 y 1
$style      = $_REQUEST['style'] ? : 0; //como se vera la tarea dos estilos 0 y 1
$order      = $_REQUEST['order'] ? : 0; //orden de la tarea 0 por defecto 

$task       = new TaskController(); //controlador 
$request    = null;
$id         = Session::GetSession("login", "id");

switch ($order):
    case 0:
        $order = FECHA;
        break;
    case 1:
        $order = DEADLINE;
        break;
    case 2:
        $order = PROCESO;
        break;
    case 3:
        $order = ESPERA;
        break;
    case 4:
        $order = TERMINADA;
        break;
endswitch;

switch ($type):
    case 0:
        $request = $task->GetMyTask($id , $order);
        break;
    case 1:
        break;
endswitch;

switch ($style):
    case 0:
        PorltetStyle($request , $type);
        break;
    case 1:
        break;
endswitch;



/**
 * INTERFAZ GRAFICO PORTLERT HELP
 * var data = '<div class="col-md-4 column sortable"><div class="portlet portlet-sortable light bordered"><div class="portlet-title"><div class="caption font-green-sharp"><i class="fa fa-tasks"></i><span class="caption-subject bold uppercase">Aplicaciones</span>	<span class="caption-helper"></span>';
                data += '</div><div class="actions"><a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#"></a></div></div><div class="portlet-body"><div class="scroller" style="height:200px" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">';
                data += '</div></div></div>';
                
                data += '<div class="portlet portlet-sortable light bordered"><div class="portlet-title"><div class="caption font-green-sharp"><i class="fa fa-tasks"></i><span class="caption-subject bold uppercase">Aplicaciones</span>	<span class="caption-helper"></span>';
                data += '</div><div class="actions"><a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#"></a></div></div><div class="portlet-body"><div class="scroller" style="height:200px" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">';
                data += '</div></div></div>';
                
                data += '<div class="portlet portlet-sortable light bordered"><div class="portlet-title"><div class="caption font-green-sharp"><i class="fa fa-tasks"></i><span class="caption-subject bold uppercase">Aplicaciones</span>	<span class="caption-helper"></span>';
                data += '</div><div class="actions"><a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#"></a></div></div><div class="portlet-body"><div class="scroller" style="height:200px" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">';
                data += '</div></div></div></div>';
 * 
 * 
 */

function PorltetStyle($request , $type){
    
    $count              =  count($request); 
    $portlet_array      = array();
    
    
    if($count == 1):
        $portlet_array[] = array( '<div class="col-md-4 column sortable">');
    elseif($count == 2):
        $portlet_array[] = array( '<div class="col-md-4 column sortable">');
        $portlet_array[] = array( '<div class="col-md-4 column sortable">');
    elseif($count >= 3):
        $portlet_array[] = array( '<div class="col-md-4 column sortable">');
        $portlet_array[] = array( '<div class="col-md-4 column sortable">');
        $portlet_array[] = array( '<div class="col-md-4 column sortable">');
    endif;
    
    //for($i=0 ; $i < count($portlet_array) ; $i++){
      $i = -1;
      foreach($request as $data){
        
        //GENERAL 
        $mt_id                  = $data->mt_id;
        $mt_status              = $data->status;
        $mt_description         = $data->mt_description;
        $title                  = $data->title;
        //CLIENTE
        $client_name            = $data->client_name;
        $client_phone           = $data->client_phone;
        $client_mail            = $data->client_email;
        //USUARIO
        $user                   = $data->user_name;
        $user_image             = $data->user_image;
        $user_mail              = $data->user_email;
        //TAREA TIEMPOS
        $date_asign             = $data->td_asign;
        $time_asign             = $data->tt_asign;
        $date_deadline          = $data->t_deadline;
        $time_deadline          = $data->t_timedeadline;
        
        //TAREA OTROS
        $task_status            = $data->t_status;
        $task_id                = $data->t_id;
        $task_type_id           = $data->t_idtype;
        $task_type_name         = $data->t_nametype;
        $task_type_status       = $data->t_typestatus;
        
        //FILES
        $task_box               = $data->t_boxfiles;
        $task_files             = $data->t_files;
        
        //TASK COMMENT
        $task_comment           = $data->t_comment;
        
        $body_porlet            = "";
        $body_porlet            = '<div class="portlet portlet-sortable light bordered">';
        $body_porlet           .= '<div class="portlet-title tabbable-line">';
        $body_porlet           .= '<div class="caption">';
        $body_porlet           .= '<i class="fa fa-tasks"></i>';
        $body_porlet           .= '<span class="caption-subject bold font-yellow-crusta uppercase">';
        $body_porlet           .= $title . '</span>&nbsp;';
        
        if($task_status == 1):
            $body_porlet           .= '<span class="caption-helper">Tarea Activa</span>';    
        else:
            $body_porlet           .= '<span class="caption-helper">Tarea Terminada</span>';        
        endif;
        
        $body_porlet           .= '</div>';
        $body_porlet           .= '<ul class="nav nav-tabs">';
        $body_porlet           .= '<li><a href="#portlet_tab3" data-toggle="tab">HOLA</a></li>';
        $body_porlet           .= '<li><a href="#portlet_tab2" data-toggle="tab">DATA</a></li>';
        $body_porlet           .= '<li class="active" ><a href="#portlet_tab1" data-toggle="tab">INFO</a></li>';
        $body_porlet           .= '</ul>';
        $body_porlet           .= '</div>';
        $body_porlet           .= '<div class="portlet-body">';
        $body_porlet           .= '<div class="tab-content">';
        $body_porlet           .= '<div class="tab-pane active" id="portlet_tab1">';
        $body_porlet           .= '<div class="scroller" style="height: 200px;">';
       
        if($type == 0):
            switch ($task_type_id):
                case 1:
                    $body_porlet           .= '<h4><label class="btn btn-circle btn-transparent red btn-sm active">Estado de la Tarea: ' 
                                           . $task_type_name 
                                           .'</label></h4>';
                    break;
                case 2:
                    $body_porlet           .= '<h4><label class="btn btn-circle btn-transparent blue btn-sm active">Estado de la Tarea: ' 
                                           . $task_type_name 
                                           .'</label></h4>';
                    break;
                case 3:
                    $body_porlet           .= '<h4><label class="btn btn-circle btn-transparent green btn-sm active">Estado de la Tarea: ' 
                                           . $task_type_name 
                                           .'</label></h4>';
                    break;
                case 4:
                    //FALTA PROGRAMAR LA REASIGNACION
                    $body_porlet           .= '<h4><label class="btn btn-circle btn-transparent grey-cascade btn-sm active">Estado de la Tarea: ' 
                                           . $task_type_name 
                                           .'</label>&nbsp;&nbsp;<a href="javascript:alert();" class="btn btn-circle btn-primary btn-sm"><i class="fa fa-check-circle-o"></i>&nbsp;Tomar Accion</a></h4>';
                    break;
            endswitch;
        else:    
            $body_porlet           .= '<h4>Estado: :) FELIZ</h4>';
        endif;
        
        $body_porlet           .= '</div></div>';
        $body_porlet           .= '<div class="tab-pane" id="portlet_tab2">';
        $body_porlet           .= '<div class="scroller" style="height: 200px;">';
        $body_porlet           .= '</div></div>';
        $body_porlet           .= '<div class="tab-pane" id="portlet_tab3">';
        $body_porlet           .= '<div class="scroller" style="height: 200px;">';
        $body_porlet           .= '</div></div>';
       /* $body_porlet           .= '';
        $body_porlet           .= '';
        $body_porlet           .= '';
        $body_porlet           .= '';
        $body_porlet           .= '';
        $body_porlet           .= '';
        $body_porlet           .= '';
        $body_porlet           .= '';
        $body_porlet           .= '';
        $body_porlet           .= '';
        $body_porlet           .= '';
        $body_porlet           .= '';
        $body_porlet           .= '';
        $body_porlet           .= '';*/
        $body_porlet           .= '</div></div></div>';
        
        
        //SISTEMA PARA REORDENAMIENTO DE NX3 EN LA MATRIZ
        $max = count($portlet_array) ;
        
        if($i >= $max):
            $i = 0;
        else:
            $i++;
        endif;
        
      
        $portlet_array[$i][]    = $body_porlet;
        
       }
       
       

   // }
    
    $paste_body = "";
    for($i=0 ; $i < count($portlet_array) ; $i++):
         $portlet_array[$i][] = "</div>";
         $paste_body .= implode("", $portlet_array[$i]);
    endfor;
    
    //print_r($portlet_array);
    echo $paste_body;
  
}

