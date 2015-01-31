<?php

include '../../../Conf/Include.php';



if(!isset($_REQUEST['type'])){
    exit();
}

$type = $_REQUEST['type'];
$args = $_REQUEST['args'];

$admin = new AdminController();

switch ($type)
{
    case "rols":
        $result = $admin->Get_MasterPrivilegios();
        echo "<select id='privilegios_id' class='form-control' >";
        foreach ($result as $key=>$value)
        {
             $n = $value['nombre'];
             if(strcmp($n, $args)== 0):
                  echo "<option selected value='$n'>$n</option>";
             else:
                  echo "<option value='$n'>$n</option>";
             endif;
            
        }
        echo "</select>";
        break;
    case "subrols":
        break;
}

?>


