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
    
    $header = "";
    
    $body = "<?php include 'ViewAdminProspecto.php' ?>";
    $footer = 'FormValidation.init();';
    $footer .= 'cargar_prospectos();';
    
    $footer_end = '<script src="AjaxAdminSales.js"></script>';
    $footer_end .= '<script src="../js/bootbox.js"></script>';
    $footer_end .= '<script src="../js/bootbox.min.js"></script>';
    
   
    ViewClass::PrepareView("View.phtml", "Admin");
    ViewClass::SetView(ViewClass::SetParamsString($body , $header , $footer , $footer_end));
    
    
?>
