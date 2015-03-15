
function buscar_prospecto()
{
    
    var id = document.getElementById('propecto_buscar').value;
    if(id === -1){
        alert("SELECCIONE UN PROSPECTO POR FAVOR ....");
        return null;
    }
    
    var parametros = {
          "id" : id
    };

    $.ajax({
                      type: "POST",
                      url: "get_prospectos.php",
                      data: parametros,
                      beforeSend: function()
                      {
                          $("#cargar_admin").html( '<div class="form-body">' 
                                  + '<div class="form-group"><br> <br> <br> <br> <br> <br> <br> <br>'
                                  + '<label class="control-label col-md-3"></label>'
                                  + '<div class="col-md-4" align="center">'
                                  + '<img src="../img/assert/loadingd.gif" />'
                                  + '</div></div></div>'
                            );
                      },
                      success: function(value){
                            $("#cargar_admin").html(value); 
                      }
              });
}

function cargar_prospectos()
{
                $.ajax({
                      type: "POST",
                      url: "get_prospectos.php",
                      beforeSend: function()
                      {
                          $("#propecto_buscar").html( "<option value='-1'>Seleccione Prospecto</option>");
                      },
                      success: function(value){
                          $("#propecto_buscar").html( value );
                          $("#cmd_buscar").html( ' <button type="button" class="btn default" onclick="buscar_prospecto();" value="" name="Enviar Datos">Enviar Datos</button>' );
                      }
              });
}


function ProspectInitProcess(meta_estado , id_prospect)
{
      var flag = false;
    
      var parametros = {
          "meta_estado" : meta_estado,
          "id_prospect" : id_prospect
      };
    
      if(meta_estado ===1 )
      {
         bootbox.confirm("¿Desea Terminar el Proceso ... Una vez terminado bla bla?", function(result) {
               flag = result;
        }); 
      }
      else{
          flag = true;
      }
      
      if(flag===true){
       $.ajax({
                      type: "POST",
                      url: "get_prospectos.php",
                      data: parametros,
                      beforeSend: function()
                      {
                          $("#meta_estado").html('<img src="../img/assert/loadingd.gif" width="30" height="30" />');
                      },
                      success: function(value){
                          $("#meta_estado").html(value);
                      }
              });
       }
      
}



function ProspectActivate(status , id_prospect){
     var parametros = {
          "estado" : status,
          "id_prospect" : id_prospect
      };
    
    
    $.ajax({
                      type: "POST",
                      url: "get_prospectos.php",
                      data: parametros,
                      beforeSend: function()
                      {
                          $("#prospect_estado").html('<img src="../img/assert/loadingd.gif" width="30" height="30" />');
                      },
                      success: function(value){
                          $("#prospect_estado").html(value);
                      }
              });
}



									
									
                                                                                   

