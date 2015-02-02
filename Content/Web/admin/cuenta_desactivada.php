<!DOCTYPE html>

<?php

 session_start();
 
    $usuario = $_SESSION['login']['user'];
    $rol = $_SESSION['login']['rol'];
    $nombre = $_SESSION['login']['nombre'];
    $mail = $_SESSION['login']['email'];
    $activo = $_SESSION['login']['activo'];
    $id_user = $_SESSION['login']['id'];
    $imagen = $_SESSION['login']['imagen'];
    if($imagen == "" || $imagen == null):
        $imagen = "avatar.png";
    endif;
    
  
?>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Cuenta desactivada</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="../assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="../assets/admin/pages/css/lock2.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="../assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="../assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="../assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link href="../assets/admin/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="../assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body>
<div class="page-lock">
	<div class="page-logo">
		<a class="brand" href="index.html">
                    <img src="../img/logo/ls_logo_white.png" width="150" height="100" alt="logo"/>
		</a>
	</div>
	<div class="page-body">
            <img class="page-lock-img" src="img/users/<?php echo $imagen; ?>" alt="">
		<div class="page-lock-info">
			<h1><?php echo $nombre; ?></h1>
			<span class="email">
			<?php echo $mail; ?></span>
			<span class="locked">
			Estado Inactivo</span>
			<form class="form-inline" action="index.html">
                                <div>Su Cuenta ha sido desactivada ...</div>
				<!-- /input-group -->
				<div class="relogin">
                                    <a href="#">
                                        El usuario <?php echo $usuario; ?>
                                        se le desactivo la cuenta por medio 
                                        del administrador o CEO de la empresa
                                    </a> 
                                    <br>
                                    <a href="ControlPage/LogoutPage.php">Cerrar Sesion</a>
				</div>
			</form>
		</div>
	</div>
	<div class="page-footer-custom">
		 2015 &copy; Lieison.
	</div>
</div>
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="../../assets/global/plugins/respond.min.js"></script>
<script src="../../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="../assets/global/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script src="../assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="../assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="../assets/admin/pages/scripts/lock.js"></script>
<script>
jQuery(document).ready(function() {    
    Metronic.init(); // init metronic core components
	Layout.init(); // init current layout
    Lock.init();
    Demo.init();
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>