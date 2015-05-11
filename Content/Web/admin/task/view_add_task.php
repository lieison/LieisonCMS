<?php

/**
 * NUEVA COOKIE ...
 * ESTA SESION SERVIRA PARA BOX | TIENE O NO TIENE 
 */

  $showme = null;
  if(!Session::GetSession("box")):
      Session::InsertSession("box", $_GET['box'] ? : 0);
  else:
      switch (Session::GetSession("box")){
            case 0:
                $showme = "sesion sin dropbox";
                break;
            case 1:
                $showme = "sesion con dropbox";
                break;
      }
  endif;
  
  

?>
<div class="row">
				<div class="col-md-12">
					<div class="portlet box blue" id="form_wizard_1">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gift"></i> Task Wizard - <span class="step-title">
								Paso 1 de 4 </span>
							</div>
							<div class="tools hidden-xs">
								<a href="javascript:;" class="collapse">
								</a>
								<a href="#portlet-config" data-toggle="modal" class="config">
								</a>
								<a href="javascript:;" class="reload">
								</a>
								<a href="javascript:;" class="remove">
								</a>
							</div>
						</div>
						<div class="portlet-body form">
							<form action="#" class="form-horizontal" id="submit_form" method="POST">
								<div class="form-wizard">
									<div class="form-body">
										<ul class="nav nav-pills nav-justified steps">
											<li>
												<a href="#tab1" data-toggle="tab" class="step">
												<span class="number">
												1 </span>
												<span class="desc">
												<i class="fa fa-check"></i> Informacion</span>
												</a>
											</li>
											<li>
												<a href="#tab2" data-toggle="tab" class="step">
												<span class="number">
												2 </span>
												<span class="desc">
												<i class="fa fa-check"></i> Asignación </span>
												</a>
											</li>
											<li>
												<a href="#tab3" data-toggle="tab" class="step active">
												<span class="number">
												3 </span>
												<span class="desc">
												<i class="fa fa-check"></i> Documentos  </span>
												</a>
											</li>
											<li>
												<a href="#tab4" data-toggle="tab" class="step">
												<span class="number">
												4 </span>
												<span class="desc">
												<i class="fa fa-check"></i> Confirmar</span>
												</a>
											</li>
										</ul>
										<div id="bar" class="progress progress-striped" role="progressbar">
											<div class="progress-bar progress-bar-success">
											</div>
										</div>
										<div class="tab-content">
											<div class="alert alert-danger display-none">
												<button class="close" data-dismiss="alert"></button>
												Algunos campos obligatorios estan vacios
											</div>
											<div class="alert alert-success display-none">
												<button class="close" data-dismiss="alert"></button>
												Exito sigue adelante !!
											</div>
											<div class="tab-pane active" id="tab1">
												<div class="form-group">
													<label class="control-label col-md-3">Titulo <span class="required">
													* </span>
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control"  id="txt_title" name="txt_title"/>
														<span class="help-block">
														Nombre de la tarea a crear </span>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Deadline<span class="required">
													* </span>
													</label>
													<div class="col-md-4">
														<div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d">
                                                                                                                    <input type="text" name="txt_date" id="txt_date" class="form-control" readonly>
                                                                                                                    <span class="input-group-btn">
                                                                                                                    <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                                                                                                                    </span>
                                                                                                                </div>
                                                                                                          
											<div class="input-group input-medium">
                                                                                            <input id="txt_hour" id="txt_hour" type="text" class="form-control timepicker timepicker-24">
												<span class="input-group-btn">
												<button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
												</span>
											</div>
										
														<span class="help-block">
														Hora y Fecha de finalizacion tarea </span>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Cliente <span class="required">
													* </span>
													</label>
													<div class="col-md-3">
                                                                                                            <select name="cmd_client" id="cmd_client" class="form-control select2me" data-placeholder="Cliente">
                                                                                                                
                                                                                                                </select>
														<span class="help-block">
														Selecciona el cliente</span>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Descripcion <span class="required">
													* </span>
													</label>
													<div class="col-md-6">
                                                                                                            <textarea name="txt_description"  id="txt_description" class="ckeditor form-control" name="editor1" rows="6" data-error-container="">
                                                                                                                        <?php
                                                                                                                            $nombre = Session::GetSession("login", "nombre");
                                                                                                                                
                                                                                                                        ?>
                                                                                                                        <p><?php echo $nombre; ?><strong> No agrego una descripcion</strong></p>
                                                                                                              
                                                                                                            </textarea>


														<span class="help-block">
														Breve Descripcion de la tarea </span>
													</div>
												</div>
											</div>
											<div class="tab-pane" id="tab2">

												<div class="form-group">
													<label class="control-label col-md-3">Asignar A: <span class="required">
													* </span>
													</label>
													<div class="col-md-4">
                                                                                                            <select onchange="ShowAsignInfo();" name="cmd_asignto" id="cmd_asignto" class="form-control select2me" data-placeholder="Asignar">
                                                                                                                    
                                                                                                                </select>
														<span class="help-block">
														Selecciona a quien le asignaras la tarea </span>
													</div>
                                                                                                    
                                                                                             
											</div>
                                                                                            
                                                                                            
				
                                                                                            <div class="form-group" id="info_user" name="info_user">
												
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Comentario <span class="required">
                                                                                                         </span>
													</label>
													<div class="col-md-4">
                                                                                                            <input type="text" class="form-control" name="txt_coment" id="txt_coment"/>
														<span class="help-block">
														 ¿Algun comentario sobre la tarea? </span>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Estado<span class="required">
													</span>
													</label>
													<div class="col-md-4">
                                                                                                            <select id="txt_activate" class="form-control">
                                                                                                                <option  value="1">Activa</option>
                                                                                                                <option value="0">No activa</option>
                                                                                                            </select>
														<span class="help-block">
														¿El estado de la tarea? </span>
													</div>
												</div>
												
											</div>
											<div class="tab-pane" id="tab3" >
                                                                                            
                                                                                         <?php if(isset($_REQUEST['box'])): ?>
                                                                                            <?php if($_REQUEST['box'] == 1): ?>
                                                                                           
                                                                                            <!--ACA SE GUARDARAN LOS NODOS ELEJIDOS DE BOX EN LA TAREA -->
                                                                                            <input type="hidden" value="" id="box_stack" name="box_stack" />
                                                                                            <!--CARGA DE BOX DRIVER -->
                                                                                            <div  class="form-group">
                                                                                                 <label class="control-label col-md-3"><span class="required">
													</span>
													</label>
                                                                                            <div align='center' class="col-md-6">
                                                                                            <div id="box_document" name="box_document">
                                                                                             
                                                                                            </div>
                                                                                                 </div>
                                                                                           </div>
                                                                                            <div class="form-group">
                                                                                                <label class="control-label col-md-3"><span class="required">
													</span>
													</label>
                                                                                                <div class="col-md-6">
                                                                                                    <div class="list-group" id="box_child">
                                                                                                                <div align="center">
                                                                                                        <img  src="../img/assert/logos/box_logo.jpg" />
                                                                                                        </div> 
                                                                                                    </div>
                                                                                                </div>
													
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label class="control-label col-md-3"><span class="required">
													</span>
													</label>
                                                                                                <div class="col-md-6">
                                                                                                    <div class="list-group" id="box_tree">
                                                                                                       
                                                                                                    </div>
                                                                                                </div>
													
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label class="control-label col-md-3"><span class="required">
													</span>
													</label>
                                                                                                <div class="col-md-6">
                                                                                                    <div class="list-group" id="box_documents">
                                                                                                                
                                                                                                    </div>
                                                                                                </div>
													
                                                                                            </div>
                                                
                                                                                              <div class="form-group">
                                                                                                <label class="control-label col-md-3"><span class="required">
													</span>
													</label>
                                                                                                <div class="col-md-6">
                                                                                                    <label class="control-label col-md-3">
                                                                                                        <b>Otros:</b>
                                                                                                    </label>
                                                                                                    <textarea class="form-control" id="cmd_another_doc" name="cmd_another_doc"></textarea>
                                                                                                </div>
													
                                                                                            </div>
                                                                                            <?php else: ?>
                                                                                             <div class="form-group">
                                                                                                <label class="control-label col-md-3">Puedes agregar los "links" donde se encuentra un docuemnto o imagen<span class="required">
													</span>
												</label>
                                                                                                <div class="col-md-6">
                                                                                                 
                                                                                                     <textarea name="txt_description" name="cmd_another_doc"   id="cmd_another_doc" class="ckeditor form-control" name="editor1" rows="6" data-error-container="">
                                                                                                     </textarea>
                                                                                                </div>
                                                                                            <?php endif; ?>
                                                                                            
                                                                                            
                                                                                            <?php endif; ?>
                                                        
											</div>
											<div class="tab-pane" id="tab4">
												
												<div class="form-group">
                                                                                                   <label class="control-label col-md-3"><span class="required">
												   </span>
												</label>
                                                                                                <div class="col-md-6">
                                                                                                    <div class="alert alert-info" id="taskmessage" role="alert">
                                                                                                        <b>Todo Bien !</b>&nbsp;Puedes Crear la tarea dandole <b>Click en guardar</b>
                                                                                                       
                                                                                                    </div>
                                                                                                </div>
												</div>
											</div>
										</div>
									</div>
									<div class="form-actions">
										<div class="row">
											<div class="col-md-offset-3 col-md-9">
												<a href="javascript:;" class="btn default button-previous">
												<i class="m-icon-swapleft"></i> Atras </a>
												<a href="javascript:;" class="btn blue button-next">
												Continuar <i class="m-icon-swapright m-icon-white"></i>
												</a>
                                                                                            <a id="savetask" href="javascript:SaveTask();" class="btn green button-submit">
												Guardar <i class="m-icon-swapright m-icon-white"></i>
												</a>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>