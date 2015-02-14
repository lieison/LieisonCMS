<!DOCTYPE html>
<?php

    session_start();
    include   '../../Conf/Include.php';
    
    $http = new Http\Header();
    if(!isset($_SESSION['login'])):
        $http->redirect("index.php");
    endif;
    
    $nombre = $_SESSION['login']['nombre'];
    $imagen = $_SESSION['login']['imagen'];
    $password = \SivarApi\Tools\Encriptacion\Encriptacion::decrypt($_SESSION['login']['password']);
    
    if(isset($_REQUEST['password'])):
         if(strcmp($password,$_REQUEST['password']) ==0):
             $http->redirect("index.php");
         endif;
    endif;
?>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<?php 

    
    AdminHeader::$relative_route = "../";
    AdminHeader::GetTitle("Pantalla bloqueada");
    AdminHeader::GetMeta();
    AdminHeader::GetCss();
    AdminHeader::GetIcon();
?>
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="../assets/admin/pages/css/lock.css" rel="stylesheet" type="text/css"/>
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
                    <?php AdminHeader::GetLogo("250" , "100"); ?>
                   
		</a>
	</div>
	<div class="page-body">
		<div class="lock-head">
                    <h4>Pantalla Bloqueada<br><br><?php echo $nombre; ?></h4>
		</div>
		<div class="lock-body">
                    <div class="pull-left lock-avatar-block" >
                            <img src="../admin/img/users/<?php echo $imagen; ?>" class="lock-avatar">
			</div>
			<form class="lock-form pull-left" action="lock.php" method="post">
				<div class="form-group">
					<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" id="password" name="password"/>
				</div>
				<div class="form-actions">
					<button type="submit" class="btn btn-success uppercase">Login</button>
				</div>
			</form>
		</div>
		<div class="lock-bottom">
			<!-- EN CASO DESEAMOS UN NUEVO LOCK -->
		</div>
	</div>
	<div class="page-footer-custom">
		<?php AdminHeader::GetCopyRight(); ?>
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
<script src="../assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script>
jQuery(document).ready(function() {    
	Metronic.init(); // init metronic core components
	Layout.init(); // init current layout
	Demo.init();
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>