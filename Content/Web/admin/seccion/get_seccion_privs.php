<?php

  include   '../../../Conf/Include.php';
  
  $admin = new AdminController();
  $result = $admin->Get_MasterPrivilegios();
  $json = new \SivarApi\Tools\Services_JSON();
  
  echo $json->encode($result);

