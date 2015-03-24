/*FUNCIONES PROSPECTO**/

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

function CancelNotes(id_prospect){
    $('#id_notes').html( document.getElementById('update_note').value);
    $('#id_notes_actions').html('<button type="button" onclick="ProspectEditNotes(' + id_prospect + ');" class="btn blue">Agregar Notas </button>');
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


/**FUNCIONES PARA CONTACTO */

function ProspectPhones(contacts)
{
    var data_contact =$("#" + contacts).val();
    var data_message = '';
    
    if(data_contact === ""){
           NewPhoneContact(contacts); 
    }
    else{
        
            data_message += '<table class="table table-hover">';
            data_message += '<thead>';
            data_message += '<tr>';
            data_message += '<th>Contacto</th>';
            data_message += '<th>Telefono</th>';
            data_message += '<th></th>';
            data_message += '</tr></thead><tbody>';
        
        var decode_  = eval('(' + data_contact  + ')');   
        $.each(decode_, function(k,v){
            data_message += '<tr id="Phone' + v.id_phone_contact + '">';
            data_message += '<td><div id="Pname' + v.id_phone_contact + '">' + v.phone_name + '</div></td>';
            data_message += '<td><div id="Pnumber' + v.id_phone_contact + '">' + v.number + '</div></td>';
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
   
}

function ShowNotes(notes){
   bootbox.alert(notes, function() {});
}

function NewPhoneContact(id_contact)
{
       
         var data_message = '';
         data_message += '<table class="table table-hover">';
         data_message += '<thead>';
         data_message += '<tr><th></th><th></th></tr>';
         data_message += '</thead>';
         data_message += '<tbody>';
         data_message += '<tr><td><label class="col-md-4 control-label" for="name">Contacto</label>';
         data_message += '<input id="phone_name" name="phone_name" type="text" placeholder="Nombre contacto" class="form-control input-md"></td>';
         data_message += '<td><label class="col-md-4 control-label" for="name">Telefono</label>';
         data_message += '<input id="phone_number" name="phone_number" type="number" placeholder="El numero telefonico" class="form-control input-md"></td>';
         data_message += '</td></tr></tbody>';
         data_message += '</table>';
         bootbox.dialog({
            title: "Guardar Telefono ",
            message: data_message,
            buttons:{
                success: {
                    label: "Guardar Telefono",
                    className: "btn-success",
                        callback: function() {
                         
                         var params = {
                            "id" : id_contact,
                            "name": $("#phone_name").val(),
                            "tel": $("#phone_number").val(),
                            "type": "add_contact"
                         };
                         
                       $.ajax({
                                type: "POST",
                                url: "ajax_contact.php",
                                data: params,
                            success: function(value){
                                $("#" + id_contact).val(value);
                            }
                      });
                         
                    }
                }}
        }); 
}

function NewContact(id_prospect)
{
     var data_message = '';
         data_message += '<table class="table table-hover">';
         data_message += '<thead>';
         data_message += '<tr><th></th><th></th></tr>';
         data_message += '</thead>';
         data_message += '<tbody>';
         data_message += '<tr><td><label class="col-md-4 control-label" for="name">Nombre</label>';
         data_message += '<input required  id="name" name="name" type="text" placeholder="" class="form-control input-md"></td>';
         data_message += '<td><label class="col-md-4 control-label" for="name">Apellido</label>';
         data_message += '<input required id="name2" name="name2" type="text" placeholder="" class="form-control input-md"></td>';
         data_message += '</tr><tr><td><label class="col-md-4 control-label" for="name">Titulo</label>';
         data_message += '<input required id="title" name="title" type="text" placeholder="" class="form-control input-md"></td>';
         data_message += '<td><label class="col-md-4 control-label" for="name">E-Mail</label>';
         data_message += '<input required  id="mail" name="mail" type="email" placeholder="" class="form-control input-md"></td></tr>';
         data_message += '<tr><td><label class="col-md-4 control-label" for="name">Notas</label>';
         data_message += '<textarea id="notes" name="notes" placeholder="Digite alguna Nota ..." class="form-control input-md"></textarea></td>';
         data_message += '</tr></tbody>';
         data_message += '</table>';
         bootbox.dialog({
            title: "Nuevo Contacto ... ",
            message: data_message,
            buttons:{
                success: {
                    label: "Guardar Telefono",
                    className: "btn-success",
                        callback: function() {
                            
                         var name = $("#name").val();
                         var name2 = $("#name2").val();
                         var title = $("#title").val();
                         var mail = $("#mail").val();
                         var notes = $("#notes").val();
                         
                         
                         var table_add = '<tr class="odd gradeX">';
                         table_add += '<td>'  + name + " " + name2 + '</td>';
                         table_add += '<td>'  + title + '</td>';
                         table_add += '<td>'  + mail + '</td>';
                         table_add += '<td>'  + notes + '</td>';
                         table_add += '<td><a class="btn default" href="dashboard_admin_prospecto.php?id='  + id_prospect + '"><i class="fa fa-refresh"></i></a></td>';
                         table_add += '</tr>';
                         
                         var params = {
                            "id" : id_prospect,
                            "name": name,
                            "name2": name2,
                            "title": title,
                            "mail":  mail,
                            "notes": notes,
                            "type": "add"
                         };
                         
                       $.ajax({
                                type: "POST",
                                url: "ajax_contact.php",
                                data: params,
                            success: function(value){
                                var response = $.trim(value);
                                if(response === "first"){
                                    var new_table = "";
                                    new_table += '<thead><th>Nombres</th>';
                                    new_table += '<th>Titulo</th>';
                                    new_table += '<th>E-mail</th>';
                                    new_table += '<th>Notas</th>';
                                    new_table += '<th></th>';
                                    new_table += '</tr></thead>';
                                    new_table += "<tbody id='table_contacts' name='table_contacts'>";
                                    new_table += table_add;
                                    new_table += "</tbody>";
                                    $("#tabla_agenda").html(new_table);
                                }else if(response === "more")
                                {
                                     $("#table_contacts").append(table_add);
                                }
                             
                            }
                      });
                         
                    }
                }}
        }); 
}

function EditContact(id)
{
      var contact = JSON.parse($("#" + id).val());
      var data_message = '';
         data_message += '<table class="table table-hover">';
         data_message += '<thead>';
         data_message += '<tr><th></th><th></th></tr>';
         data_message += '</thead>';
         data_message += '<tbody>';
         data_message += '<tr><td><label class="col-md-4 control-label" for="name">Nombre</label>';
         data_message += '<input required  id="name" name="name" type="text" placeholder="" class="form-control input-md" value="' + contact.nombres + '" /></td>';
         data_message += '<td><label class="col-md-4 control-label" for="name">Apellido</label>';
         data_message += '<input required id="name2" name="name2" type="text" placeholder="" class="form-control input-md" value ="' + contact.apellidos + '" /></td>';
         data_message += '</tr><tr><td><label class="col-md-4 control-label" for="name">Titulo</label>';
         data_message += '<input required id="title" name="title" type="text" placeholder="" class="form-control input-md" value ="' + contact.titulo + '"/></td>';
         data_message += '<td><label class="col-md-4 control-label" for="name">E-Mail</label>';
         data_message += '<input required  id="mail" name="mail" type="email" placeholder="" class="form-control input-md"  value ="' + contact.email + '"/></td></tr>';
         data_message += '<tr><td><label class="col-md-4 control-label" for="name">Notas</label>';
         data_message += '<textarea id="notes" name="notes" placeholder="Digite alguna Nota ..." class="form-control input-md" >' + contact.notas  + '</textarea></td>';
         data_message += '</tr></tbody>';
         data_message += '</table>';
         bootbox.dialog({
            title: "Edita este contacto... ",
            message: data_message,
            buttons:{
                success: {
                    label: "Guardar Telefono",
                    className: "btn-success",
                        callback: function() {
                         
                         var id_c = contact.id_prospect_contact;
                         var id_p = contact.id_prospect;
                         var name = $("#name").val();
                         var name2 = $("#name2").val();
                         var title = $("#title").val();
                         var mail = $("#mail").val();
                         var notes = $("#notes").val();
                         
                         var params = {
                            "id" : id_c,
                            "name": name,
                            "name2": name2,
                            "title": title,
                            "mail":  mail,
                            "notes": notes,
                            "type": "edit"
                         };
                         
                       $.ajax({
                                type: "POST",
                                url: "ajax_contact.php",
                                data: params,
                            success: function(){
                               var table_add = '';
                               table_add += '<td>'  + name + " " + name2 + '</td>';
                               table_add += '<td>'  + title + '</td>';
                               table_add += '<td>'  + mail + '</td>';
                               table_add += '<td>'  + notes + '</td>';
                               table_add += '<td><a class="btn default" href="dashboard_admin_prospecto.php?id='  + id_p + '"><i class="fa fa-refresh"></i></a></td>';
                               table_add += '';
                               $("#child" + id_c  ).html(table_add);
                            }
                      });
                         
                    }
                }}
        }); 
}


function DeleteContact(id)
{
    var conf = '<div class="alert alert-danger" role="alert">';
        conf += '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>';
        conf += '<span class="sr-only">No Hay Vuelta atras ...</span>';
        conf += ' Este Contacto se eliminara permanente mente  <b>¿DESEA ELIMINARLO?</b>';
        conf += "</div>";
    bootbox.confirm(conf, function(result) {
        if(result === true){
            var params = {
          "id" : id,
          "type": "delete"
        };
                         
        $.ajax({
           type: "POST",
           url: "ajax_contact.php",
           data: params,
           success: function(){
               $("#child" + id).remove();
            }
         });
    
        }
    }); 
    
}


function EditPhone(id_phone)
{
    
    
}


function DeletePhone(id_phone)
{
    var conf = '<div class="alert alert-danger" role="alert">';
        conf += '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>';
        conf += '<span class="sr-only">No Hay Vuelta atras ...</span>';
        conf += ' Este Telefono se eliminara permanente mente  <b>¿DESEA ELIMINARLO?</b>';
        conf += "</div>";
    bootbox.confirm(conf, function(result) {
        if(result === true){
            var params = {
          "id" : id_phone,
          "type": "delete_phone"
        };
                         
        $.ajax({
           type: "POST",
           url: "ajax_contact.php",
           data: params,
           success: function(){
               $("#Phone" + id_phone).remove();
            }
         });
        }
    }); 
}


/**FUNCIONES DE LA BITACORA **/


function InitBitacora(){
    
}








									
									
                                                                                   

