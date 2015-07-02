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

set_dependencies(array(
    "TaskController"
 ));


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
        $request = $task->GetTask($id , $order);
        break;
    case 1:
        $request = $task->GetTask($id , $order , TO );
        break;
endswitch;

switch ($style):
    case 0:
        PorltetStyle($request , $type , $id ,  $task);
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

function PorltetStyle($request , $type , $id ){
    
    $count              =  count($request); 
    $portlet_array      = array();
    $task               = new TaskController();


    if($count == 0 ){
        $not_task = "<div align='center' class='col-md-12'>";
        $not_task .= "<h1><br><br><br><b>No Hay Tareas :)</b></h1>";
        $not_task .= "</div>";
        echo $not_task;
        exit;
    }
    
    
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
    
  
      $i = -1;
      $max = count($portlet_array)-1 ;
      //ESTADOS DE LOS TABULADORES
      $n = 1;
      $p=2;
      $q=3;


    /**
     * RECORRIDO DE LAS TAREAS PENDIENTES O ASIGNADAS DE ACUERDO
     * AL PERFIL DEL USUARIO DADO ...
     */
      
      foreach($request as $data){
        
        //GENERAL 
        $mt_id                  = $data->mt_id;
        $mt_status              = $data->status;
        $mt_description         = stripcslashes(nl2br($data->mt_description));
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

          /**INICIO : SELECCION SE COLOR TITULO MEDIANTE EL TYPO DE TAREA*/

          $title_color = NULL;

          switch($task_type_id ){

              case 1:
                  $title_color = "font-green-crusta";
                  break;
              case 2:
                  $title_color = "font-blue-crusta";
                  break;
              case 3:
                  $title_color = "font-red-crusta";
                  break;
              case 4:
                  $title_color = "font-green-crusta";
                  break;
              case 5:
                  $title_color = "font-yellow-crusta";
                  break;

          }


          $body_porlet           .= '<i class="fa fa-tasks"></i>';
          $body_porlet           .= '<span class="caption-subject  bold ' . $title_color . ' uppercase">';
          $body_porlet           .= $title . '</span>&nbsp;';

          /**FINAL SELECCION DE COLOR  TITULO */
        
        
        if($task_status == 1):
            $body_porlet           .= '<span class="caption-helper"><i class="fa fa-spinner"></i></span>';
        else:
            $body_porlet           .= '<span class="caption-helper"><i class="fa fa-check"></i></span>';
        endif;
       

        $body_porlet           .= '</div>';
        $body_porlet           .= '<ul class="nav nav-tabs">';

        if($type == 0):
            $body_porlet           .= '<li><a href="#portlet_tab' . $q . '" data-toggle="tab"><i class="fa fa-tachometer"></i></a></li>';
            $body_porlet           .= '<li><a href="#portlet_tab' . $p . '" data-toggle="tab"><i class="fa fa-user"></i></a></li>';
            $body_porlet           .= '<li class="active" ><a href="#portlet_tab' . $n . '" data-toggle="tab"><i class="fa fa-info"></i></a></li>';
        else:
            $body_porlet           .= '<li><a href="#portlet_tab' . $q . '" data-toggle="tab"><i class="fa fa-tachometer"></i></a></li>';
            $body_porlet           .= '<li><a href="#portlet_tab' . $p . '" data-toggle="tab"><i class="fa fa-user"></i></a></li>';
            $body_porlet           .= '<li class="active" ><a href="#portlet_tab' . $n . '" data-toggle="tab"><i class="fa fa-info"></i></a></li>';
        endif;

        $body_porlet           .= '</ul>';
        $body_porlet           .= '</div>';
        $body_porlet           .= '<div class="portlet-body">';
        $body_porlet           .= '<div class="tab-content">';

        //PRIMER TAB ------------------------------------------------------------------------------------------------
        $body_porlet           .= '<div class="tab-pane active" id="portlet_tab' . $n .'">';
        $body_porlet           .= '<div class="scroller">';
       
        if($type == 0):
            
            $color = "red";
            $reasign = FALSE;
            switch ($task_type_id):
                case 1:
                    break;
                case 2:
                    $color = "blue";
                    break;
                case 3:
                    $color = "green";
                    break;
                case 4:
                    $reasign = TRUE;
                    break;
            endswitch;
            
            if($reasign){
                $body_porlet           .= '<h4><label class="btn btn-circle btn-transparent grey-cascade btn-sm active"> ' 
                                           . $task_type_name 
                                           .'</label>&nbsp;&nbsp;<a title="Si desea tomar accion en este momento sobre la reasignacion haz clic" href="javascript:alert();" class="btn btn-circle btn-primary btn-sm"><i class="fa fa-refresh"></i>&nbsp;Accion</a>' 
                                           .'</label>&nbsp;<a title="muestra un poco mas acerca de esta tarea" href="show_task.php?id=' . $mt_id . '" class="btn btn-circle btn-transparent  active" ><i class="fa fa-eye"></i></a></h4>';
            }
            else{
                $body_porlet .= '<h4><label class="btn btn-circle btn-transparent ' . $color . ' btn-sm active" >' 
                                           . $task_type_name 
                                           .'</label>&nbsp;&nbsp;&nbsp;<a title="muestra un poco mas acerca de esta tarea" href="show_task.php?id=' . $mt_id . '" class="btn btn-circle btn-transparent green  btn-sm active" ><i class="fa fa-eye"></i></a></h4>';
            }
            
        else: 
            
            /****
             * Cuando Te asignan una tarea ....
             * se verifica antes el typo de estado que tiene 
             * estos se categoriza por defecto no iniciado
             */
            if($task_type_id == 4):
                $body_porlet .= '<i class="fa fa-pause"></i>&nbsp;Reasignado : <button onclick="wait_reasign('  
                    . $task_id .');" class="btn btn-sm btn-circle btn-primary">Ver Proceso</button><br><br>';
            else:
                $type_data              = $task->get_task_type($task_type_id);
                $state_form             = "<div id='task_type_change'>"
                                        . "<select onchange='change_state_task($task_id);' "
                                        . "id='task_state_$task_id' class='form-control'>";
                foreach ($type_data as $tvalue):
                    if($task_type_id == $tvalue->id_type):
                    $state_form .= "<option selected value='" 
                                . $tvalue->id_type 
                                . "' >$tvalue->name</option>";
                 else:
                    $state_form .= "<option value='" 
                                . $tvalue->id_type 
                                . "' >$tvalue->name</option>";
                endif;
            endforeach;
                $state_form            .= "</select></div><br>";
                $body_porlet           .= $state_form;
            endif;

        endif;
        
        
        
        $body_porlet           .= '<div class="blog-twitter">'; 
        $body_porlet           .= '<div class="blog-twitter-block">';
        $body_porlet           .= '<p><i class="fa fa-university "></i>&nbsp;&nbsp;<b>Cliente:</b>&nbsp;' .  $client_name . ' </p>';
        $body_porlet           .= '<i class="fa fa-envelope-o"></i>&nbsp;&nbsp;<a href="">' . $client_mail . '</a>';
        $body_porlet           .= '<span><i class="fa fa-phone"></i>&nbsp;&nbsp;' . $client_phone .  '</span>';
        $body_porlet           .= '<i class="fa fa-university blog-twiiter-icon"></i>';
        $body_porlet           .= '</div></div>';
        $body_porlet           .= '<p><b>Descripcion:</b></p>';
        $body_porlet           .= '<p class="">' . $mt_description . '</p>';
        $body_porlet           .= '</div></div>';


        //SEGUNDO TAB --------------------------------------------------------------------------
        $body_porlet           .= '<div class="tab-pane" id="portlet_tab' . $p . '">';
        $body_porlet           .= '<div class="scroller">';
        $body_porlet           .= '<div class="row">';
        $body_porlet           .= '<div class="col-md-4">';
        if($user_image == null ):
            $user_image = "avatar.png";
        endif;
        $body_porlet           .= '<img src="' . FunctionsController::GetUrl("img/users/$user_image") . '" class="img-circle" width ="60" height="60" alt="">';
        $body_porlet           .= '</div>';
        $body_porlet           .= '<div class="col-md-8">';
        $body_porlet           .= '<h4><b>' . $user . '</b></h4>';

          /**RECORDATORIO :  SE LE CAMBIARA EL MAILTO POR NUESTRO SISTEMA DE CORREOS */
        $body_porlet           .= '<p><i class="fa fa-envelope-o"></i>&nbsp;<b><a href="mailto:' . $user_mail . '">' . current(explode("@" , $user_mail )) . '</a></b></p>';

        if($type == 0):
        //$select_users           = $task->AsignTouser($id);
        $body_porlet           .= '<div align="center">'
                               . '<button  onclick="alert();" type="button" class="btn btn-circle btn-primary">'
                               . '<i class="fa fa-repeat"></i> Reasignar</button>'
                               . '</div>';
        endif;
        $body_porlet           .= '';
        $body_porlet           .= '</div>';
        $body_porlet           .= '</div>';
        $body_porlet           .= '</div></div>';

        /**TERCER TAB -----------------------------------------------------------------------------------------*/
        $body_porlet           .= '<div class="tab-pane" id="portlet_tab' . $q. '">';
        $body_porlet           .= '<div class="scroller">';
        $body_porlet           .= '<div>';
        $body_porlet           .= '<p><i class="fa fa-comment"></i>&nbsp; <b>' . $task_comment . '</b></p>';
        $body_porlet           .= '';
        $body_porlet           .= '<p><i class="fa fa-calendar"></i>&nbsp;<b>Tarea Asignada Hace (' 
                                    . FunctionsController::Get_TimeAgo($date_asign. " " . $time_asign) . ')</b></p>';
        $body_porlet           .= '<p><i class="fa fa-calendar-o"></i>&nbsp;<b>Expiracion : En ' .  FunctionsController::Get_TimeExpired($date_deadline. " " . $time_deadline) . '</b></p>';
        $body_porlet           .= '<div align="center"><a title="muestra un poco mas acerca de esta tarea" href="show_task.php?id=' 
                               . $mt_id . '" class="btn btn-circle btn-transparent green  btn-sm active" ><i class="fa fa-eye"></i>&nbsp;Ver tarea</a</div>';
        $body_porlet           .= '</div>';
        $body_porlet           .= '</div></div>';

       /* $body_porlet         .= '';
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
        
        /*
         * TABULACION PROBLEMA MATEMATICO
         * 
         * si n = primero = 1
         *      entonces n = n+q dado q = ultimo
         * si p = segundo = 2 
         *      entonces p = p+q dado q = ultimo
         * si q = ultimo 
         *      entonces q = q + q o el doble de su producto
         */
        
        $n = $n + $q;
        $p = $p+ $q;
        $q += $q;
        
        if($i >= $max):
            $i = 0;
        else:
            $i++;
        endif;
        
        $portlet_array[$i][]    = $body_porlet;
        
       }
  
    $paste_body = "";
    for($i=0 ; $i < count($portlet_array) ; $i++):
         $portlet_array[$i][] = "</div>";
         $paste_body .= implode("", $portlet_array[$i]);
    endfor;
    

    echo $paste_body;
  
}

