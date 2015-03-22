<?php

include   '../../../Conf/Include.php';

if(!isset($_REQUEST['type'])){
    exit();
}

$prospect = new ProspectController();
$type = $_REQUEST['type'];
switch ($type)
{
    case "add_contact":
        $id = $_REQUEST['id'];
        $name = $_REQUEST['name'];
        $tel = $_REQUEST['tel'];
        $result = $prospect->SetContactPhone($id, $name, $tel);
        if($result){
           $contact = $prospect->Get_PhonesContact($id);
           $json = new \SivarApi\Tools\Services_JSON();
           echo $json->encode($contact);
        }
        unset($id);
        unset($name);
        unset($tel);
        break;
    case "add":
        $id = $_REQUEST['id'];
        $name = $_REQUEST['name'];
        $name2 = $_REQUEST['name2'];
        $title = $_REQUEST['title'];
        $mail = $_REQUEST['mail'];
        $notes = $_REQUEST['notes'];
        $result = $prospect->SetContact(array(
            "id_prospect"=> $id,
            "nombres"=>$name,
            "apellidos"=>$name2,
            "titulo"=>$title,
            "email"=>$mail,
            "notas"=>$notes
        ));
        if($result){ 
            $prospect->Get_ContactProspect($id);
            if($prospect->Get_ContactCount() <=1){
                echo "first";
            }else{
                echo "more";
            }
        }
        unset($id);
        unset($name);
        unset($name2);
        unset($title);
        unset($mail);
        unset($notes);
        unset($result);
        break;
    case "delete":
        $id = $_REQUEST['id'];
        $prospect->DestroyContact($id);
        break;
    case "edit":
        $id = $_REQUEST['id'];
        $name = $_REQUEST['name'];
        $name2 = $_REQUEST['name2'];
        $title = $_REQUEST['title'];
        $mail = $_REQUEST['mail'];
        $notes = $_REQUEST['notes'];
        $prospect->EditContact($id, $name, $name2, $title, $mail, $notes);
        unset($id);
        unset($name);
        unset($name2);
        unset($title);
        unset($mail);
        unset($notes);
        unset($result);
        break;
}

