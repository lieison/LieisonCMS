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
    
     
    $header = '<div id="fb-root"></div>
            <script>(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&appId=271330856288382&version=v2.0";
                fjs.parentNode.insertBefore(js, fjs);
      }(document, "script", "facebook-jssdk"));</script>';
    
    
    $body = "<?php include 'ViewAdminProspecto.php' ?>";
    $footer = 'FormValidation.init();';
    $footer .= 'cargar_prospectos();';
    
    $footer_end = '<script src="AjaxAdminSales.js"></script>';

    
    ViewClass::PrepareView("View.phtml", "Admin");
    ViewClass::SetView(ViewClass::SetParamsString($body , $header , $footer , $footer_end));
    
    
?>
