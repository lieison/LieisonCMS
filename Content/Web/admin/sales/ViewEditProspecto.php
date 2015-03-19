<?php 
  if(isset($_REQUEST['id']))
  {
      
  }else{
      $header = new \Http\Header();
      $header->redirect("index.php");
      exit();
  }
?>
<div class="page-bar"><div class="col-md-12 ">
                            <div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-user"></i> HOLA MUNDO
							</div>
							<div class="tools">
								<a href="" class="collapse">
								</a>
							</div>
						</div>
						<div class="portlet-body form">
                                                    <form class="form-horizontal" role="form" action="get_add_prospect.php" method="get">
								<div class="form-body">
									<div class="form-group">
										<label class="col-md-3 control-label">Nombre del Prospecto *</label>
										<div class="col-md-9">
                                                                                    <input type="text" class="form-control input-inline medium_text" id="txt_nombre" name="txt_nombre" placeholder="Nombre o Empresa" onkeyup="verificar_prospecto(this.value);">
                                                                                        <span class="help-block" id="verificar_prospecto">
                                                                                            
											</span>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Direccion *</label>
										<div class="col-md-9">
                                                                                    <input type="text" required name="txt_direccion1" id="txt_direccion1" class="form-control" placeholder="Introduzca la direccion">
											<span class="help-inline">
											</span>
										</div>
                                                                                <div id="map-canvas"></div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Direccion Alternativa </label>
										<div class="col-md-9">
                                                                                    <input type="text" name="txt_direccion2" id="txt_direccion2" class="form-control" placeholder="(Opcional) Introduzca alguna direccion alternativa">
					
										</div>
	
									</div>
                                                                        <div class="form-group">
										<label class="col-md-3 control-label">Provincia</label>
										<div class="col-md-9">
                                                                                    <input type="text" name="txt_provincia" class="form-control input-inline medium_text" id="txt_nombre" name="txt_nombre" placeholder="Ej: (San salvador)" >
                                           
										</div>
									</div>
                                                                        <div class="form-group">
										<label class="col-md-3 control-label">Ciudad</label>
										<div class="col-md-9">
                                                                                    <input type="text" name="txt_ciudad" class="form-control input-inline medium_text" id="txt_nombre" name="txt_nombre" placeholder="Ej: (San salvador)" >
                                           
										</div>
									</div>
                                                                        <div class="form-group">
										<label class="col-md-3 control-label">Pais *</label>
                                                                                <div class="col-md-9" id="drown_pais">
                                                                                    <!--AJAX DROPDOWN PAIS -->
										</div>
									</div>
                                                                        <div class="form-group">
										<label class="col-md-3 control-label">Codigo Zip</label>
										<div class="col-md-3">
											<div class="input-group">
												<span class="input-group-addon">
												<i class="fa fa-inbox"></i>
												</span>
                                                                                             <input type="text" value="503" name="txt_zip" class="form-control" placeholder="+503">
				
                                                                                        </div>
                                                                                        
										</div>
                                                                               
									</div>
                                                                    
                                                                     <div class="form-group">
										 <label class="col-md-3 control-label">Telefono *</label>
										<div class="col-md-3">
											<div class="input-group">
												<span class="input-group-addon">
												<i class="fa fa-phone"></i>
												</span>
                                                                                              <input required type="tel" name="txt_telefono" class="form-control" placeholder="">
				
                                                                                        </div>
                                                                                        
										</div>
									</div>
                                                                    
                                                                     <div class="form-group">
										 <label class="col-md-3 control-label">Fax</label>
										<div class="col-md-3">
											<div class="input-group">
												<span class="input-group-addon">
												<i class="fa fa-fax"></i>
												</span>
                                                                                             <input type="tel" name="txt_fax" class="form-control" placeholder="">
				
                                                                                        </div>
                                                                                        
										</div>
									</div>
                                                                        
									<div class="form-group">
										<label class="col-md-3 control-label">Email</label>
										<div class="col-md-9">
											<div class="input-group">
												<span class="input-group-addon">
												<i class="fa fa-envelope"></i>
												</span>
												<input type="email" name="txt_email" class="form-control" placeholder="Correo electronico ...">
											</div>
										</div>
									</div>
                                                                    
                                                                        <div class="form-group">
										<label class="col-md-3 control-label">Pagina Web</label>
										<div class="col-md-9">
											<div class="input-group">
												<span class="input-group-addon">
												<i class="fa fa-dashboard"></i>
												</span>
                                                                                            <input type="url" name="txt_web" class="form-control" placeholder="http://">
											</div>
										</div>
									</div>
                                                                    
                                                                        <div class="form-group">
										<label class="col-md-3 control-label">Facebook</label>
										<div class="col-md-9">
											<div class="input-group">
												<span class="input-group-addon">
												<i class="fa fa-facebook"></i>
												</span>
                                                                                            <input type="text" value="" class="form-control" name="txt_facebook" placeholder="https://"  onkeyup="verificar_facebook(this.value);">
                                                                                            <span class="help-block" id="verificar_facebook">
                                                                                            
                                                                                            </span>
											</div>
										</div>
									</div>
                                                                        <div class="form-group">
										<label class="col-md-3 control-label">Twitter</label>
										<div class="col-md-9">
											<div class="input-group">
												<span class="input-group-addon">
												<i class="fa fa-twitter"></i>
												</span>
                                                                                            <input type="tex" value="" name="txt_twitter" class="form-control" placeholder="ejemplo: lieison (sin arroba '@')" onkeyup="verificar_twitter(this.value);">
                                                                                            <span class="help-block" id="verificar_twitter">
                                                                                            
                                                                                            </span>
											</div>
										</div>
									</div>
                                                                        <div class="form-group">
										<label class="col-md-3 control-label">Notas</label>
										<div class="col-md-9">
											<div class="input-group">
												<span class="input-group-addon">
												
												</span>
                                                                                           <textarea class="ckeditor form-control" name="txt_notas" id="txt_notas" rows="6" data-error-container="#editor2_error"></textarea>
											</div>
										</div>
									</div>
									
								</div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">
                                                                                    <button type="submit" name="cmd_enviar" id="cmd_enviar" class="btn green">Guardar Prospecto</button>
                                                                                    <label class=" control-label alert-warning" id="txt_error"></label>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
                            
      </div></div>