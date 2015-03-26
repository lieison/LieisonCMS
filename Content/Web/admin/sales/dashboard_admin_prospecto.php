<!DOCTYPE html>

<?php 
   
 
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
