
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
                            $("#cargar_admin").html(// '<div class="form-body">' 
                                 // + '<div class="form-group"><br> <br> <br> <br> <br> <br> <br> <br>'
                                 // + '<label class="control-label col-md-3"></label>'
                                //  + '<div class="col-md-4">'
                                   value
                                //  + '</div></div></div>' 
                            ); 
                          
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
                         /* $("#cargar_admin").html( '<div class="form-body">' 
                                  + '<div class="form-group"><br> <br> <br> <br> <br> <br> <br> <br>'
                                  + '<label class="control-label col-md-3"></label>'
                                  + '<div class="col-md-4" align="center">'
                                  + '<img src="../img/assert/loadingd.gif" />'
                                  + '</div></div></div>'
                            );*/
                          $("#propecto_buscar").html( "<option value='-1'>Seleccione Prospecto</option>");
                          
                      },
                      success: function(value){
                          /*  $("#cargar_admin").html( '<div class="form-body">' 
                                  + '<div class="form-group"><br> <br> <br> <br> <br> <br> <br> <br>'
                                  + '<label class="control-label col-md-3"></label>'
                                  + '<div class="col-md-4" align="center">'
                                  + '<select class="form-control select2me" name="options2" id="propecto_buscar">'
                                  + value
                                  + '</select>'
                                  + ' <br><div>'
                                  + '<button type="button" class="btn default" onclick="buscar_prospecto();" value="" name="Enviar Datos">Enviar Datos</button>'
                                  + '</div>'
                                  + '</div></div></div>' 
                                  
                            ); */
                          $("#propecto_buscar").html( value );
                          $("#cmd_buscar").html( ' <button type="button" class="btn default" onclick="buscar_prospecto();" value="" name="Enviar Datos">Enviar Datos</button>' );
                          
                      }
              });
}


									
									
									
                                                                                   

