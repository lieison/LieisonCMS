<?php 

 /**
  * IMPORTANTE FUNCION MIEMBRO DE CARGA POR METODO GET O POST 
  * VERIFICA SI EXISTE UN ID DEL PROSPECTO A REFLESCAR
  * ESTO SIRVE PARA OPTIMIZAR LOS TIEMPOS EN EL VIEW
  */
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
<div class="row" id="cargar_admin">
    <div class="col-md-12" >		
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
                                 <div class="alert alert-success" role="alert">CARGANDO , ESPERE POR FAVOR ...</div>
                             <?php endif; ?>
			</div> 
                        <div class="col-md-4" align="centert">
                        <div class="">
                        <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-globe"></i> Prospectos Inactivos
                        </div>
                        </div>
                            <div class="portlet-body form">
                                
                            </div>
                        </div>
                            
                        </div>
                       
                    </div>					
		</div>
    </div>
</div>
