<?php 

 /**
 *@author Rolando Antonio Arriaza <rmarroquin@lieison.com>
 *@copyright (c) 2015, Lieison
 *
 *  Permission is hereby granted, free of charge, to any person obtaining a copy
    of this software and associated documentation files (the "Software"), to deal
    in the Software without restriction, including without limitation the rights
    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the Software is
    furnished to do so, subject to the following conditions:

    The above copyright notice and this permission notice shall be included in
    all copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
    SOFTWARE. 
 * 
 *@version 1.0
 *@todo Lieison S.A de C.V 
 */


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


?>

<?php if(!$del): ?>

					<div class="portlet box purple ">
						<div class="portlet-title">
							<div class="caption">
								<i class="<?php echo $dash['icono'] ?>"></i> <?php echo $dash['dash_titulo'] ?>
							</div>
						</div>
						<div class="portlet-body form">
                                                    <form class="form-horizontal" role="form" >
								<div class="form-body">
									<div class="form-group">
										<label class="col-md-3 control-label">Dashboard Titulo</label>
										<div class="col-md-9">
                                                                                    <input type="text" id="txt_titulo" class="form-control input-sm" placeholder="Agregue un titulo" value="<?php echo $dash['dash_titulo'] ?>">
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
                                                                                    <input type="text" id="txt_link" class="form-control input-sm" placeholder="Default Input" value="<?php echo $dash['link']; ?>">
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
                                                                                    <input id="txt_priv" type="text" class="form-control todo-taskbody-tags" placeholder="Privilegios" value="<?php echo $priv_string; ?>">
										</div>
									</div>
									
								</div>
								<div class="form-actions right1">
                                                                        <input type="hidden" id="txt_id" value="<?php echo $id; ?>" />
                                                                        <a href="index.php" class="btn default">Atras</a>
                                                                        <button type="button" onclick="SavePage();" class="btn green"><b id="cmd_actualizar">Actualizar</b></button>
								</div>
							</form>
						</div>
					</div>
<?php else: ?>

<div class="panel panel-default">
  <div class="panel-body">
     <?php 
                            if($_REQUEST['status'] == 1):
                                echo "¿ESTA SEGURO QUE DESEA DESHABILITAR LA PAGINA?";
                            else:
                                 echo "ESTA PAGINA ESTA DESHABILITADA ¿DESEA HABILITARLA?";
                            endif;
     ?>
  </div>
    <div class="panel-footer">
        <input type="hidden" id="txt_id" value="<?php echo $id; ?>" />
         <input type="hidden" id="txt_status" value="<?php echo $_REQUEST['status']; ?>" />
        <a href="index.php" class="btn default">Cancelar</a>
            <button type="button" onclick="EnablePage();" class="btn green">
                <b id="cmd_actualizar">
                        <?php 
                            if($_REQUEST['status'] == 1):
                                echo "Deshabilitar";
                            else:
                                 echo "Habilitar";
                            endif;
                        ?>
                </b>
            </button>
    </div>
</div>

<?php endif; 


