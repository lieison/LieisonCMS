<?php

include   '../../../../Conf/Include.php';

Session::InitSession();

set_dependencies(array(
    "AdminController"
 ));

$adm = new AdminController();
$search  = $adm->GetuserByParent(session::GetSession("login" , "id"));
echo json_encode($search);