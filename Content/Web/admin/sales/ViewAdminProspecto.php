<style>
  .class_tr {
        width: 100%;
        display: inline-table;
  }
  .class_tbody
  {
    overflow-y: scroll;
    overflow-wrap: scroll;
    height: 320px;
    width: 100%;
    position: absolute;
  }
</style>

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
 }

?>

<div class="row" id="cargar_admin">
<?php if(!isset($_REQUEST['id'])): ?>        
<div class="col-md-4 ">
<div class="portlet">
<div class="portlet-title">
		<div class="caption" >
                       <i class="fa fa-users"></i>Busca Un Prospecto
		</div>
</div>
<div class="portlet-body form" align="center">
    <br>
     <div class="form-body">
        <label class="control-label col-md-4"></label>
        <select class="form-control select2me" name="options2" id="propecto_buscar">
            <!-- ACA CARGA EL COMBO BOX DE LOS PROSPECTOS -->
        </select>
        <br><br>
	<div class="input-group">
	<div class="icheck-inline">
             <!-- INPUTS ESTABLECIDOS TIPO FILTRO -->
	<label><input type="checkbox" id="check_inactivos" onclick="cargar_prospectos();" class="icheck"> Inactivos </label>
	<label><input type="checkbox" id="check_terminado" onclick="cargar_prospectos();" class="icheck"> Terminados </label>
	</div>
	</div>
	</div>
        <br>                                                  
        <div id="cmd_buscar">
             <!-- ACA CARGA EL BOTON DE ENVIO HABIENDO TERMINADO LA CARGA DEL COMBO -->
        </div>
       <br><br>
    </div>
</div>
</div>

<div class="col-md-8 ">
<div class="portlet ">
	<div class="portlet-title">
		<div class="caption" >
                        <i class="fa fa-eye"></i> Ultimas Visitas
		</div>
        </div>
    <table >
     <thead><tr class="tr_d"><th></th></thead>   
     <tbody class="class_tbody">
         <tr class="class_tr">
         <td> 
            <div class="portlet-body form">
                <div class="timeline" id="carga_entradas">
                        
		</div>
             </div>
           </td>
         </tr>
    </tbody>
    </table>
</div>
</div>
</div>
   <?php else: ?>
    <div class="col-md-12 " align="center">
        <br><br><br><br><br><br><br>
               <p><img src="../img/assert/logos/LogoA.png" /></p>
                <div class="alert alert-success" role="alert">CARGANDO , ESPERE POR FAVOR ...</div>
    </div>            
    <?php endif; ?>   


