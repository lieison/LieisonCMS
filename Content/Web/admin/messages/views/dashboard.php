<?php



echo Session::GetSession("login" , "id");

//$message = new MessageController();
$bandeja =  null;//$message->GetMessageCountFrom();


Session::InsertSession("title", "<b>No leidos ($bandeja)</b>");


?>