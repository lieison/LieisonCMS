

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
 
    session_start();
    
    include   '../../../Conf/Include.php';

    $rol = $_SESSION['login']['rol'];
    $_SESSION['page_name']  = "Admin Prospectos";
    $_SESSION['home'] = "Sales";
    $_SESSION['title'] = "Sales <b> Administrar Prospectos</b>";
    
    $adminc = new AdminController();
    $adminc->Get_Permission($rol, FunctionsController::get_actual_page());
    
   
    $header .= '<link href="../../assets/admin/pages/css/timeline.css" rel="stylesheet" type="text/css"/>';
    $header .= '<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css"/>';
    
    $body = "<?php include 'ViewAdminProspecto.php' ?>";
    $footer = 'FormValidation.init();';
    $footer .= 'cargar_prospectos();';
    $footer .= 'cargar_entradas();';

    
    $footer_end = '<script src="AjaxAdminSales.js"></script>';
    $footer_end .= '<script src="../js/bootbox.js"></script>';
    $footer_end .= '<script src="../js/bootbox.min.js"></script>';
    $footer_end .= '<script type="text/javascript" src="../../assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
                    <script type="text/javascript" src="../../assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>';
    
   
    ViewClass::PrepareView("View.phtml", "Admin");
    ViewClass::SetView(ViewClass::SetParamsString($body , $header , $footer , $footer_end));
    
    
?>
