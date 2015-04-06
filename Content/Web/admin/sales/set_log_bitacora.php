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

/** 
 *  "id_bitacora" : id_bitacora,
     "id_user": id_user,
      "id_type": $("#Btype").val(),
      "title": $("#Btitle").val(),
      "description": $("#Bdescription").val()
 * 
 * funcion javascript donde lo llama
 * InsertBitacora(id_bitacora , id_user);
 */

include   '../../../Conf/Include.php';


if(!isset($_REQUEST['id_bitacora'])){
    exit();
}

$sales = new ProspectController();

$date = FunctionsController::get_date();
$time = FunctionsController::get_time();
$id_bitacora = $_REQUEST['id_bitacora'];
$id_user = $_REQUEST['id_user'];
$id_type =$_REQUEST['id_type'];
$title = $_REQUEST['title'];
$description = $_REQUEST['description'];

$is_insert = $sales->InsertBitacora($id_bitacora, 
        $id_user, $id_type, $title,
        $description, $date, $time);

if($is_insert){
    $id_prospect = $sales->GetPropspectoByBitacora($id_bitacora);
    $result_bitacora = $sales->GetBitacora($id_prospect, $time);
    
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
       /*  $action_form .= '<div class="item">
		<div class="item-head">
		<div class="item-details">
		</div>
		</div>
		<div class="item-body">
		</div>
		</div>';*/
         $action_form .= '</div></div>';
         //FIN DE LA IMPRESION 
          echo $action_form;
}
