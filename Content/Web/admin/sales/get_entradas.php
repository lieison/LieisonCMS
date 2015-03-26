<?php

include   '../../../Conf/Include.php';
$prospect = new ProspectController();
$result = $prospect->GetEntrance();
$print = "";

session_start();
$id_user = $_SESSION['login']['id'];

foreach($result as $key=>$value){
    $print .= '<div class="timeline-item">';
            $print .= '<div class="timeline-badge">';
             if($value['Uid'] != $id_user){
                   $img_data = "";
                   if(\SivarApi\Tools\Validation::Is_Empty_OrNull($value['Uimg'])){
                       $img_data = "avatar.png";
                   }else{ $img_data = $value['Uimg'];}
                   $print .= '<img class="timeline-badge-userpic" src="../img/users/' . $img_data  . '">';
             }else{
                  $print .= '<div class="timeline-icon">';
                  $print .= '<i class="icon-ghost font-green-haze"></i>';
                  $print .= '</div>';
             }
            $print .= '</div>';
    $print.= '<div class="timeline-body">';
            $translate = new GoogleTranslate("en", "es");
            $time_ago = FunctionsController::Get_TimeAgo($value['date']. " " . $value['hour']);
            $print .= '<div class="timeline-body-arrow"></div>';
            $print .= '<div class="timeline-body-head">';
            $print .= '<div class="timeline-body-head-caption">';
            $print .= '<a href="#" class="timeline-body-title font-blue-madison">' . $value['Uname'] .'</a>';
            $print .= '<span class="timeline-body-time font-grey-cascade">' . $translate->translate($time_ago)  . '</span>';
            $print .= '</div>';
            $print .= '</div>';
            $print .= '<div class="timeline-body-head-actions">';
            $print .= '';
            $print .= '</div>';
            $print .= '<div class="timeline-body-content">';
            $print .= '<span class="font-grey-cascade">';
            if($value['Uid'] == $id_user){
                 $print .= '<b>Tú</b> Entrastes A <b>  ' . $value['Pname'] . 
                         '</b> Aproximadamente&nbsp&nbsp(' . $translate->translate($time_ago) . ')';
            }else{
                 $print .= 'El Usuario <b>' . $value['Uname'] 
                         . '</b> Entro A <b>' . $value['Pname'] 
                         . '</b>' . ' Aproximadamente (' . $translate->translate($time_ago)  . ')';
            }
            $print .= '</span>';
            $print .= '</div>';
    $print .= '</div>';
    $print .= '</div>';
}

echo $print;


