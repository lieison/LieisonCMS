<?php
  if(!isset($_REQUEST['id']))
  {
      $header = new \Http\Header();
      $header->redirect("index.php");
      exit();
  }

  $prospect = new ProspectController();
  $result = $prospect->Get_Prospect_ById($_REQUEST['id']);
  
  /*echo "<pre>";
  print_r($result);
  echo "</pre>";*/
  
 
?>
<div class="page-bar"><div class="col-md-12 ">
                            <div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-user"></i> <?php echo $result['nombre']; ?>
							</div>
							<div class="tools">
								<a href="" class="collapse">
								</a>
							</div>
						</div>
						<div class="portlet-body form">
                                                    <form class="form-horizontal" role="form" action="get_edit_prospect.php" method="post">
								<div class="form-body">
									<div class="form-group">
										<label class="col-md-3 control-label">Nombre del Prospecto *</label>
										<div class="col-md-9">
                                                                                    <input type="text" class="form-control input-inline medium_text" id="txt_nombre" name="txt_nombre" value="<?php echo $result['nombre']; ?>" placeholder="Nombre o Empresa" onkeyup="verificar_prospecto(this.value);">
                                                                                        <span class="help-block" id="verificar_prospecto">
                                                                                            
											</span>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Direccion *</label>
										<div class="col-md-9">
                                                                                    <input type="text" required name="txt_direccion1" id="txt_direccion1" class="form-control" value="<?php echo $result['direccion']; ?>" placeholder="Introduzca la direccion">
											<span class="help-inline">
											</span>
										</div>
                                                                                <div id="map-canvas"></div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Direccion Alternativa </label>
										<div class="col-md-9">
                                                                                    <input type="text" name="txt_direccion2" id="txt_direccion2" class="form-control" value="<?php echo $result['direccion2']; ?>" placeholder="(Opcional) Introduzca alguna direccion alternativa">
					
										</div>
	
									</div>
                                                                        <div class="form-group">
										<label class="col-md-3 control-label">Provincia</label>
										<div class="col-md-9">
                                                                                    <input type="text" name="txt_provincia" class="form-control input-inline medium_text" id="txt_nombre" name="txt_nombre" placeholder="Ej: (San salvador) " value="<?php echo $result['provincia']; ?>" >
                                           
										</div>
									</div>
                                                                        <div class="form-group">
										<label class="col-md-3 control-label">Ciudad</label>
										<div class="col-md-9">
                                                                                    <input type="text" name="txt_ciudad" class="form-control input-inline medium_text" id="txt_nombre" name="txt_nombre" placeholder="Ej: (San salvador)" value="<?php echo $result['ciudad']; ?>" >
                                           
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
                                                                                             <input type="text" value="503" name="txt_zip" class="form-control" placeholder="+503" value="<?php echo $result['zip']; ?>">
				
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
                                                                                              <input required type="tel" name="txt_telefono" class="form-control" placeholder="" value="<?php echo $result['telefono']; ?>">
				
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
                                                                                             <input type="tel" name="txt_fax" class="form-control" placeholder="" value="<?php echo $result['fax']; ?>">
				
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
												<input type="email" name="txt_email" class="form-control" placeholder="Correo electronico ..." value="<?php echo $result['email']; ?>">
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
                                                                                            <input type="url" name="txt_web" class="form-control" placeholder="http://" value="<?php echo $result['pagina_web']; ?>">
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
                                                                                            <input type="text"  class="form-control" name="txt_facebook" placeholder="https://"  onkeyup="verificar_facebook(this.value);" value="<?php echo $result['facebook']; ?>" >
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
                                                                                            <input type="tex"  name="txt_twitter" class="form-control" placeholder="ejemplo: lieison (sin arroba '@')" onkeyup="verificar_twitter(this.value);" value="<?php echo $tw = str_replace("@" , "" ,$result['twitter']); ?>">
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
                                                                                           <textarea class="ckeditor form-control" name="txt_notas" id="txt_notas" rows="6" data-error-container="#editor2_error"><?php echo $result['notas']; ?>"</textarea>
											</div>
										</div>
									</div>
									
								</div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">
                                                                                    <button type="submit" name="cmd_enviar" id="cmd_enviar" value="<?php echo $_REQUEST['id']; ?>" class="btn green">Editar Prospecto</button>
                                                                                    <label class=" control-label alert-warning" id="txt_error"></label>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
                            
      </div></div>

