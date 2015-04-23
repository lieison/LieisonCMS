<?php
    $page = new PageController();
?>

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
										<label class="col-md-3 control-label">Direccion (Link)</label>
										<div class="col-md-9">
                                                                                    <input type="text" id="txt_link" class="form-control input-sm" placeholder="Default Input" value="">
										</div>
									</div>
								
									<div class="form-group">
										<label class="col-md-3 control-label">Privilegios</label>
										<div class="col-md-9">
                                                                                       <?php
                                                                                            $admin = new AdminController();
                                                                                            $priv_master = $admin->Get_MasterPrivilegios();
                                                                                            $page_priv = explode(",", $dash['priv_nombre']);
                                                                                            $priv_string = "";
                                                                                            foreach ($priv_master as $values){
                                                                                                $nivel = $values['nivel'];
                                                                                                $nameP = $values['nombre'];
                                                                                                if(is_array($page_priv)){
                                                                                                    for ($i=0; $i < count($page_priv); $i++){
                                                                                                        if($page_priv[$i] === $nivel){
                                                                                                            if($i == count($page_priv)-1){
                                                                                                                 $priv_string .= $nameP . "";
                                                                                                            }else{
                                                                                                                $priv_string .= $nameP . ",";
                                               
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                }
                                                                                            }
                                                                                            unset($admin);
                                                                                       ?>
                                                                                    <input id="txt_priv" type="text" class="form-control todo-taskbody-tags" placeholder="Privilegios" value="<?php echo $priv_string; ?>">
										</div>
									</div>
									
								</div>
								<div class="form-actions right1">
                                                                        <input type="hidden" id="txt_id" value="<?php echo $id; ?>" />
                                                                        <a href="index.php" class="btn default">Cancelar</a>
                                                                        <button type="button" onclick=";" class="btn green"><b id="cmd_actualizar">Actualizar</b></button>
								</div>
							</form>
						</div>
					</div>