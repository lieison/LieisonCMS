<!DOCTYPE html>

<?php 
   
 
    session_start();
    
    include   '../../../Conf/Include.php';

 
    $rol = $_SESSION['login']['rol'];
    
    $adminc = new AdminController();
    $adminc->Get_Permission($rol, FunctionsController::get_actual_page());
    
    
    $body = "<?php include 'ViewAdminProspecto.php' ?>";
    
    $footer = 'FormValidation.init();';
    $footer .= 'cargar_prospectos();';
    $footer_end = '<script src="AjaxAdminSales.js"></script>';
    
    ViewClass::PrepareView("View.phtml", "Admin");
    ViewClass::SetView(ViewClass::SetParamsString($body , '' , $footer , $footer_end));
    
    
?>
