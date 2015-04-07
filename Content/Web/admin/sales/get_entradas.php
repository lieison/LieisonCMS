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
 * 
 * 
 * 
 */

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


