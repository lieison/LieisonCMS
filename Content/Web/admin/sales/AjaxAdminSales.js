
function buscar_prospecto()
{
    document.getElementById('propecto_buscar').value;
}

function cargar_prospectos()
{
                $.ajax({
                      type: "POST",
                      url: "get_prospectos.php",
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
                            
                      }
              });
}


