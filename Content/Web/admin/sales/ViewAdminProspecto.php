<?php 

 if(isset($_REQUEST['id']))
 {
     sleep(2);
     echo "<script type='text/javascript'>"
     . "function initprospect(){"
     . "setTimeout('buscar_prospecto(" .$_REQUEST['id'] . ");', 3000);"
     . "}initprospect();"
     . "</script>";
     //exit();
 }

?>
<div  class="row">
				<div class="col-md-12">
					<!-- BEGIN VALIDATION STATES-->
					
                                        <div  style="alignment-adjust: central;" class="portlet-body form" id="cargar_admin">
							
								<div class="form-body">
									<div class="form-group">
                                                                            <br> <br> <br> <br> <br> <br> <br> <br>
										<label class="control-label col-md-3">
										</label>
										<div class="col-md-4" align="center">
                                                                                <?php if(!isset($_REQUEST['id'])): ?>    
                                                                                 <select class="form-control select2me" name="options2" id="propecto_buscar">
												
                                                                                   </select>
                                                                                    <br>
                                                                                    
                                                                                    <div id="cmd_buscar">
                                                                                            <button type="button" class="btn default"  onclick="buscar_prospecto(null);" value="" name="Enviar Datos">Enviar Datos</button>
                       
                                                                                    </div>
                                                                                       <?php else: ?>
                                                                                        <p><img src="../img/assert/logos/LogoA.png" /></p>
                                                                                        <div class="alert alert-success" role="alert">Computando .. Espere por favor</div>
                                                                                     <?php endif; ?>
										</div>
                                                                                
									</div>
								
								</div>
		
							
							<!-- END FORM-->
						</div>

						<!-- END VALIDATION STATES-->
				
				</div>
</div>
