
<?php 


$id = $_REQUEST['id'] ? : null;
$del = $_REQUEST['del'] ? : null;

if($id == null && $del == null){
    echo '<div class="alert alert-danger" role="alert">PAGINA NO ENCONTRADA </div><br>';
    echo "<a class='btn btn-primary' href='index.php'>Regresar </a>";
    exit();
}

$page = new PageController();
$dash = $page->get_dashboard_database($id);
unset($page);

/*echo "<pre>";
print_r($dash);
echo "</pre>";*/
?>


					<div class="portlet box purple ">
						<div class="portlet-title">
							<div class="caption">
								<i class="<?php echo $dash['icono'] ?>"></i> <?php echo $dash['dash_titulo'] ?>
							</div>
						</div>
						<div class="portlet-body form">
                                                    <form class="form-horizontal" role="form" action="save_edit_paginas.php">
								<div class="form-body">
									<div class="form-group">
										<label class="col-md-3 control-label">Dashboard Titulo</label>
										<div class="col-md-9">
											<input type="text" class="form-control input-sm" placeholder="Agregue un titulo" value="<?php echo $dash['dash_titulo'] ?>">
										</div>
									</div>
									<div class="form-group">
                                                                            <label id='font_change' class="col-md-3 control-label">Font Awesome Icono &nbsp;&nbsp; <i  class="<?php echo $dash['icono'] ?>"></i></label>
                                           
										<div class="col-md-9">
                                                                                    <input type="text" onkeydown="font_change();" id="txt_icono" onchange="font_change();" class="form-control input-sm" placeholder="icono que representa " value="<?php echo $dash['icono']; ?>">
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Direccion (Link)</label>
										<div class="col-md-9">
											<input type="text" class="form-control input-sm" placeholder="Default Input" value="<?php echo $dash['link']; ?>">
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Seccion de la pagina</label>
										<div class="col-md-9">
                                                                                    <select id="cmd_seccion" class="selectpicker">
												<?php
                                                                                                    $page = new PageController();
                                                                                                    $seccion = $page->get_seccion_dashboard();
                                                                                                    foreach ($seccion as $val){
                                                                                                        $sec_title = $val['titulo'];
                                                                                                        $sec_icono = $val['icono'];
                                                                                                        $sec_id = $val['id_seccion'];
                                                                                                        if((int) $dash['id_seccion'] === (int) $sec_id){
                                                                                                            echo '<option selected value="' . $sec_id 
                                                                                                                . '" data-content="' . "<i  class='" 
                                                                                                                . $sec_icono . "'></i>&nbsp;<b>$sec_title</b>" . '"></option>';
                                                                                                        }else{
                                                                                                             echo '<option value="' . $sec_id 
                                                                                                                . '" data-content="' . "<i  class='" 
                                                                                                                . $sec_icono . "'></i>&nbsp;<b>$sec_title</b>" . '"></option>';
                                                                                                        }
                                                                                                    }
                                                                                                    unset($page);
                                                                                                ?>
                                                                                    </select>
                                                                             
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
											<input type="text" class="form-control todo-taskbody-tags" placeholder="Privilegios" value="<?php echo $priv_string; ?>">
										</div>
									</div>
									
								</div>
								<div class="form-actions right1">
									<button type="button" class="btn default">Cancelar</button>
									<button type="submit" class="btn green">Actualizar</button>
								</div>
							</form>
						</div>
					</div>


