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

set_dependencies(array('ProspectController'));

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
    case "delete_phone":
        $id = $_REQUEST['id'];
        $id_c = $prospect->GetIdContactByPhoneContact($id);
        if($prospect->DestroyPhoneContact($id)){
            echo $id_c["id"];
        }
        break;
    case "edit_phone":
        $id = $_REQUEST['id'];
        $name = $_REQUEST['name'];
        $phone = $_REQUEST['phone'];
        if($prospect->EditPhoneContact($id, $name, $phone)){
            $id_c = $prospect->GetIdContactByPhoneContact($id);
            echo $id_c["id"];
        }
        break;
}

