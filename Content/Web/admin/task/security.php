<?php


    /**
     * ESTE FRAGMENTO DE CODIGO LO QUE HACE ES REDIRECCIONAR SI EXISTE 
     * EL TOKEN DE BOX , ESTO QUIERE DECIR QUE SE HA LOGADO ANTES A UNA CUENTA
     */

     if(Session::ExistSession("box")):
         echo "<script> "
        . " window.location.href='includes/box.php?init=0&box=" . Session::GetSession("box") . "';"
        . "</script>";
     elseif(file_exists("includes/token.box")):
        echo "<script> "
        . " window.location.href='includes/box.php?init=0';"
        . "</script>";
     endif;

     
   

?>
<div class="portlet box purple">
    
				<div class="portlet-title">
							<div class="caption">
                                                                 Security Box
							</div>
							
						</div>
						<div class="portlet-body form">
							<form role="form" class="form-horizontal">
								<div align="center" class="form-body">
                                                                    <H2><b>¿TIENES CUENTA DE BOX?</b></H2>
									<div class="form-group">

										<div align="center" class="col-md-12">
                                                                                    <a href="includes/box.php?init=0" class="btn btn-primary">SI</a>
                                                                                    <a href="dashboard_add_task.php?security=1&box=0" class="btn green">NO</a>
										</div>
									</div>
				
								</div>
								
							</form>
						</div>
					</div>
				</div>
</div>

