<?php

include   '../../../../Conf/Include.php';

$id = $_REQUEST['id_user'] ? : null;

if(\SivarApi\Tools\Validation::Is_Empty_OrNull($id)){
    exit();
}

$task = new TaskController();
$info = $task->Show_UserInfo($id);


if($info->imagen == null){
    $info->imagen = "avatar.png";
}

echo '<label class="control-label col-md-3"> <span class="required">';
echo '</span></label>';
echo ' <div  class="col-md-4" >';
echo '<div  class="thumbnail">';
echo '<img src="../img/users/' . $info->imagen . '" alt="" width="100" height="100">';
echo '<div class="caption">';
echo '<h3 align="center"><b>' . $info->email . '</b></h3>';
echo '<p></p>';
echo '</div></div></div>';

	
													



