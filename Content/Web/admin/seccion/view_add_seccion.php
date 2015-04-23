
	<div class="portlet box purple ">
						<div class="portlet-title">
							<div class="caption">
                                                            <i class="fa fa-plus">&nbsp;&nbsp;Agrega una nueva seccion</i> 
							</div>
						</div>
						<div class="portlet-body form">
                                                    <form class="form-horizontal" role="form" >
								<div class="form-body">
									<div class="form-group">
										<label class="col-md-3 control-label">Titulo</label>
										<div class="col-md-9">
                                                                                    <input type="text" id="txt_titulo" class="form-control input-sm" placeholder="Agregue un titulo" value="">
										</div>
									</div>
									<div class="form-group">
                                                                            <label id='font_change' class="col-md-3 control-label">Font Awesome Icono &nbsp;&nbsp; <i  class=" "></i></label>
                                           
										<div class="col-md-9">
                                                                                    <input type="text" onkeydown="font_change();" id="txt_icono" onchange="font_change();" class="form-control input-sm" placeholder="icono que representa " value="">
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Inicio</label>
										<div class="col-md-9">
                                                                                    <input type="text" id="txt_inicio" class="form-control input-sm" placeholder="se asigna un numero ejemplo: 1 se inica de primero en el dashboard " value="">
										</div>
									</div>
								
									<div class="form-group">
										<label class="col-md-3 control-label">Privilegios</label>
										<div class="col-md-9">
                                                                                
                                                                                    <input id="txt_priv" type="text" class="form-control todo-taskbody-tags" placeholder="Privilegios" value="admin">
										</div>
									</div>
									
								</div>
								<div class="form-actions right1">
                                                                        <a href="index.php" class="btn default">Cancelar</a>
                                                                        <button type="button" onclick="SaveSeccion();" class="btn green"><b id="cmd_actualizar">Guardar</b></button>
								</div>
							</form>
						</div>
					</div>