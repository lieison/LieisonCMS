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
 */

include   '../../../Conf/Include.php';

$header = new Http\Header();
if(!isset($_POST['cmd_enviar'])){
    $header->redirect("index.php");
    exit();
}

$values = array(
         "nombre" => $_POST['txt_nombre'],
         "direccion" => $_POST['txt_direccion1'],
         "direccion2" => $_POST['txt_direccion2'],
         "provincia" => $_POST['txt_provincia'],
         "ciudad" => $_POST['txt_ciudad'],
         "id_pais" => $_POST['combo_pais'],
         "zip" => $_POST['txt_zip'],
         "telefono" => $_POST['txt_telefono'],
         "fax" => $_POST['txt_fax'],
         "pagina_web" => $_POST['txt_web'],
         "email" => $_POST['txt_email'],
         "facebook" => $_POST['txt_facebook'],
         "twitter" => $_POST['txt_twitter'],
         "notas" => $_POST['txt_notas']
);

$id = $_POST['cmd_enviar'];
$prospect = new ProspectController();
$prospect->EditProspect($id, $values);
$header->redirect("dashboard_admin_prospecto.php?id=$id");



