

function buscar_prospecto(id_prospect)
{
    var id = "";
    
    if(id_prospect != null )
    {
        id = id_prospect;
    }
    else{
       id = document.getElementById('propecto_buscar').value;
       if(id === -1){
        alert("SELECCIONE UN PROSPECTO POR FAVOR ....");
            return null;
        }
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

function ProspectEditNotes(id_prospect)
{
    var notes_html = $('#id_notes').html();
    if(notes_html === '<b>No Existen notas</b>')
             notes_html = "";
   $('#id_notes').html('<textarea class="ckeditor form-control" name="update_note" id="update_note" rows="6" >'
           +  notes_html + '</textarea>');
   var actions = "<button type='button' class='btn blue' onclick='SaveNotes(" + id_prospect + ");' value='Guardar'>Guardar Notas</button>";
   actions += "&nbsp&nbsp&nbsp<button type='button' class='btn red' value='Cancelar' onclick='CancelNotes(" + id_prospect + ");'>Cancelar Notas</button>";
   $('#id_notes_actions').html(actions);
}


function SaveNotes(id_prospect)
{
    var new_html =  document.getElementById('update_note').value;
    if(new_html !== null || new_html !== "undefined"){
       
        var parametros = {
            "new_notes" : new_html,
            "id_prospect" : id_prospect
        };
    
        $.ajax({
                      type: "POST",
                      url: "edit_prospect.php",
                      data: parametros,
                      beforeSend: function()
                      {
                           $('#id_notes').html('<div align="center"><img src="../img/assert/loadingd.gif" width="60" height="60" /></div>');
                      },
                      success: function(value){
                           $('#id_notes').html(new_html);
                      }
              });
    }
    $('#id_notes_actions').html('<button type="button" onclick="ProspectEditNotes(' + id_prospect + ');" class="btn blue">Agregar Notas </button>');
}


function CancelNotes(id_prospect){
    $('#id_notes').html( document.getElementById('update_note').value);
    $('#id_notes_actions').html('<button type="button" onclick="ProspectEditNotes(' + id_prospect + ');" class="btn blue">Agregar Notas </button>');
}


function ProspectPhones(contacts)
{
    var data_contact =$("#" + contacts).val();

    var data_message = '';
        data_message += '<table class="table table-hover">';
        data_message += '<thead>';
        data_message += '<tr>';
        data_message += '<th>Contacto</th>';
        data_message += '<th>Telefono</th>';
        data_message += '<th></th>';
        data_message += '</tr></thead><tbody>';
        
   var decode_  = eval('(' + data_contact  + ')');   
   $.each(decode_, function(k,v){
        data_message += '<tr>';
        data_message += '<td>' + v.phone_name + '</td>';
        data_message += '<td>' + v.number + '</td>';
        data_message += '<td><button onclick="EditPhone( ' + v.id_phone_contact + ')" class="btn default"><i class="fa fa-pencil"></i></button>';
         data_message += '<button onclick="DeletePhone( ' + v.id_phone_contact + ')" class="btn default"><i class="fa fa-trash-o"></i></button></td>';
        data_message += '</tr>';
    });     

    data_message += '</tbody></table>';
    bootbox.dialog({
        title: "Agenda",
        message: data_message
    });
    
}

function EditPhone(id_phone)
{
    alert();
}


function DeletePhone(id_phone)
{
    alert();
}








									
									
                                                                                   

