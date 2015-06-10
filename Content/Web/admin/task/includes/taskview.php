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
        $request = $task->GetMyTask($id , $order );
        break;
    case 1:
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

          /**FINAL SELECCION */
        
        
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
                                           .'</label>&nbsp;&nbsp;<br><a href="javascript:alert();" class="btn btn-circle btn-primary btn-sm"><i class="fa fa-check-circle-o"></i>&nbsp;Tomar Accion</a></h4>';
                    break;
            endswitch;
        else:    
            $body_porlet           .= '<h4>Estado: :) FELIZ</h4>';
        endif;
        $body_porlet           .= '<div class="blog-twitter">'; 
        $body_porlet           .= '<div class="blog-twitter-block">';
        $body_porlet           .= '<p><i class="fa fa-university "></i>&nbsp;&nbsp;<b>Cliente:</b>&nbsp;' .  $client_name . ' </p>';
        $body_porlet           .= '<i class="fa fa-envelope-o"></i>&nbsp;&nbsp;<a href="">' . $client_mail . '</a>';
        $body_porlet           .= '<span><i class="fa fa-phone"></i>&nbsp;&nbsp;' . $client_phone .  '</span>';
        $body_porlet           .= '<i class="fa fa-university blog-twiiter-icon"></i>';
        $body_porlet           .= '</div></div>';
        $body_porlet           .= '<p><b>Descripcion:</b></p>';
        $body_porlet           .= '<p class="bg-danger">' . $mt_description . '</p>';
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
        $select_users           = $task->AsignTouser($id);
        $body_porlet           .= '<div align="center">'
                               . '<button  onclick="alert();" type="button" class="btn btn-circle btn-primary">'
                               . '<i class="fa fa-repeat"></i> Reasignar</button>'
                               . '</div>';
        endif;
        $body_porlet           .= '';
        $body_porlet           .= '</div>';
        $body_porlet           .= '</div>';
        $body_porlet           .= '</div></div>';
        $body_porlet           .= '<div class="tab-pane" id="portlet_tab' . $q. '">';
        $body_porlet           .= '<div class="scroller">';
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
    
    /*echo '<pre>';
    print_r($portlet_array);
    echo "</pre>";*/
    echo $paste_body;
  
}

