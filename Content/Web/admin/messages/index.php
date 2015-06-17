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


//INCLUIMOS LIBRERIA PRINCIPAL DONDE SE CARGAN TODAS LAS DEMAS LIBRERIAS O SCRIPTS
include   '../../../Conf/Include.php';


set_dependencies(array(
    "MessageController"
));



//INICIA UNA NUEVA SESION...CLASE DEL CORE Tools/Session
Session::InitSession();
Session::InsertSession("page_name", "Inbox");
Session::InsertSession("home", "Inbox");
Session::InsertSession("title", "<b>Bandeja</b>");


//CARGARA LOS SCRIPTS NECESARIOS EN EL HEADER
//<link href="../../assets/global/plugins/pace/themes/lieison-loading.css" rel="stylesheet" type="text/css"/>
$header = ''
    . '<script src="../../assets/global/plugins/pace/pace.min.js" type="text/javascript"></script>'
    . '<link href="../../assets/admin/pages/css/blog.css" rel="stylesheet" type="text/css"/>'
    . '<link href="../css/loading-lieison-cms.css" rel="stylesheet" type="text/css"/>'
    . '';

//CARGARA EL BODY
$body = "<?php include 'views/dashboard.php' ?>";

//CARGARA EL FOOTER O LOS SCRIPTS JS
$footer = "";

//CUIDADO SOLO CARGA LOS INITS DE JS ejemplo Load();
$end_footer = "";


//PREPARANDO LA VISTA ...
ViewClass::PrepareView("View.phtml", "Admin");

//LLAMANDO LA VISTA
ViewClass::SetView(ViewClass::SetParamsString($body ,$header , $end_footer , $footer));



 
    

