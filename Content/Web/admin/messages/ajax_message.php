<?php

 session_start();
 include   '../../../Conf/Include.php';
 
 $messagecontroller = new MessageController();
 
 $id_user = $_SESSION['login']['id'];
 print_r($messagecontroller->GetMessageCountFrom($id_user));
