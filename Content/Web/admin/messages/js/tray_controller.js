
var messages_ = function(){
  
    var route = function(){
        return document.getElementById("route_value").value;
    };
  
    this.count_from = function(count){
          var t = $("#count_tray_1");
          t.html("Entrada (" +count + ")");
    };
    
    this.count_read = function(count , data_enable){
        if(data_enable){
            var task = new jtask();
        
            task.method = "POST";
            task.async  = true;
            task.url = route() + "admin/messages/loader/tray_read.php";
            
            task.success_callback(function(call){
            
            var message     = JSON.parse(call);
            var count       = message.count;
            var t = $("#count_tray_2");
            t.html("Leidos (" +count + ")");
            
            });
            task.do_task();
            
        }else{
              var t = $("#count_tray_2");
              t.html("Leidos (" +count + ")");
        }
        
    };
    
    this.count_send = function(count , data_enable){
        
        if(data_enable){
            
            var task = new jtask();
        
            task.method = "POST";
            task.async  = true;
            task.url = route() + "admin/messages/loader/tray_from_to.php";
            
            task.success_callback(function(call){
            
                var message     = JSON.parse(call);
                var count       = message.count;
                 var t = $("#count_tray_3");
                 t.html("Enviados (" +count + ")");
            
            });
            task.do_task();
            
        }else{
              var t = $("#count_tray_3");
              t.html("Enviados (" +count + ")");
        }

    };
    
    this.count_trash = function(count , data_enable){
        
     
           if(data_enable){
            
            var task = new jtask();
        
            task.method = "POST";
            task.async  = true;
            task.url = route() + "admin/messages/loader/tray_trash.php";
            
            task.success_callback(function(call){
             
                var message     = JSON.parse(call);
                var count       = message.count;
                
                var t = $("#count_tray_4");
                t.html("Papelera (" +count + ")");
            
            });
            task.do_task();
            
        }else{
             
            var t = $("#count_tray_4");
            t.html("Papelera (" +count + ")");
        }
        
        
        
    };
    
    this.load_from = function(before){
        
        var task = new jtask();
        
        task.method = "POST";
        task.async  = true;
        task.url = route() + "admin/messages/loader/tray_from.php";
        
        var body = $("#messages_body");
        var head = $("#messages_head");

        if(before){
            task.beforesend = true;
            task.config_before(function(){
                 var data = '<tr id="after_load" class="odd gradeX"><td>\n\
                            </td><td><br><br><p align="center">Cargando mensajes ...</p></td><td>' + '<img class="" alt="" src="' 
                            + route() + 'admin/img/assert/loading.gif" width="80" height="80"/>' + '</td><td class="center">\n\
                            </td><td></td><td></td></tr>';
                 body.append(data);
            });
        }
        
 
        task.success_callback(function(call){
            
            var message     = JSON.parse(call);
            var count       = message.count;
            var data        = message.data;
            var m           = new messages_();
            m.count_from(count);
            

            var head_        = "";
                head_       +='<th class="table-checkbox">'
                            + '<input type="checkbox" class="group-checkable" />'
                            + '</th>'
                            + '<th>'
                            + 'De'
                            + '</th>'
                            + '<th>'
                            + 'Asunto'
                            + '</th>'
                            + '<th>'
                            + '</th>'
                            + '<th>'
                            + ''
                            + '</th>'
                            + '<th>'
                            + '<button class="btn btn-circle default dark-stripe" onclick="load_tray();"><i class="fa fa-refresh"></i></button>'
                            + '</th>'
                            + '';
            head.html(head_);
            
            try{
                $("#after_load").remove();
            }catch(ex){}
            
            body.html('');
            
            $.each(data , function(k,v){
                //console.log(v.fecha + " ->" + v.hora);
                var body_ = '<tr onclick="show_message(' + v.id_mensaje + ');" class="odd gradeX">'
                          + '<td><input type="checkbox" class="checkboxes" value="' + v.id_mensaje + '"/></td>'
                          + '<td>' + '<img alt="" width="30" height="30" class="img-circle" src="' + route() + 'admin/img/users/' + v.imagen + '" />&nbsp&nbsp<span class="username ">' + v.nombre + '</span></td>'
                          + '<td>' + v.asunto + '</td>'
                          + '<td>' + v.fecha + '</td>'
                          + '<td>' + v.hora + '</td>'
                          + '<td></td>'
                          + '</tr>';

                body.append(body_);
            });
            
            from_table.init();
        
 
        });
        task.do_task();
    };
    
    this.load_from_read = function( before){
        
        var task = new jtask();
        
        task.method = "POST";
        task.async  = true;
        task.url = route() + "admin/messages/loader/tray_read.php";
        
        var body = $("#messages_body_read");
        var head = $("#messages_head_read");
        
        if(before){
            task.beforesend = true;
            task.config_before(function(){
                 var data = '<tr id="after_load" class="odd gradeX"><td>\n\
                            </td><td><br><br><p align="center">Cargando mensajes ...</p></td><td>' + '<img class="" alt="" src="' 
                            + route() + 'admin/img/assert/loading.gif" width="80" height="80"/>' + '</td><td class="center">\n\
                            </td><td></td><td></td></tr>';
                 body.append(data);
            });
        }
        
 
        task.success_callback(function(call){
            
            var message     = JSON.parse(call);
            var count       = message.count;
            var data        = message.data;
            var m           = new messages_();
            m.count_read(count , false);
            
            var head_        = "";
                head_       +='<th class="table-checkbox">'
                            + '<input type="checkbox" class="group-checkable" />'
                            + '</th>'
                            + '<th>'
                            + 'De'
                            + '</th>'
                            + '<th>'
                            + 'Asunto'
                            + '</th>'
                            + '<th>'
                            + '</th>'
                            + '<th>'
                            + ''
                            + '</th>'
                            + '<th>'
                            + '<button class="btn btn-circle default dark-stripe" onclick="load_tray();"><i class="fa fa-refresh"></i></button>'
                            + '</th>'
                            + '';
            head.html(head_);
            
            try{
                $("#after_load").remove();
                
            }catch(ex){}
            
            body.html('');
            
            $.each(data , function(k,v){
               
                //console.log(v.fecha + " ->" + v.hora);
                var body_ = '<tr onclick="show_message(' + v.id_mensaje + ');" class="odd gradeX">'
                          + '<td><input type="checkbox" class="checkboxes" value="' + v.id_mensaje + '"/></td>'
                          + '<td>' + '<img alt="" width="30" height="30" class="img-circle" src="' + route() + 'admin/img/users/' + v.imagen + '" />&nbsp&nbsp<span class="username ">' + v.nombre + '</span></td>'
                          + '<td>' + v.asunto + '</td>'
                          + '<td>' + v.fecha + '</td>'
                          + '<td>' + v.hora + '</td>'
                          + '<td></td>'
                          + '</tr>';

                body.append(body_);
            });
          
            read_table.init();
           
        });
        task.do_task();
    };
    
    this.load_from_send = function (before){
        var task = new jtask();
        
        task.method = "POST";
        task.async  = true;
        task.url = route() + "admin/messages/loader/tray_from_to.php";
        
        var body = $("#messages_body_send");
        var head = $("#messages_head_send");
        
        if(before){
            task.beforesend = true;
            task.config_before(function(){
                 var data = '<tr id="after_load" class="odd gradeX"><td>\n\
                            </td><td><br><br><p align="center">Cargando mensajes ...</p></td><td>' + '<img class="" alt="" src="' 
                            + route() + 'admin/img/assert/loading.gif" width="80" height="80"/>' + '</td><td class="center">\n\
                            </td><td></td><td></td></tr>';
                 body.append(data);
            });
        }
        
 
        task.success_callback(function(call){
            
            var message     = JSON.parse(call);
            var count       = message.count;
            var data        = message.data;
            var m           = new messages_();
            m.count_send(count , false);
            
            var head_        = "";
                head_       +='<th class="table-checkbox">'
                            + '<input type="checkbox" class="group-checkable" />'
                            + '</th>'
                            + '<th>'
                            + 'De'
                            + '</th>'
                            + '<th>'
                            + 'Asunto'
                            + '</th>'
                            + '<th>'
                            + '</th>'
                            + '<th>'
                            + ''
                            + '</th>'
                            + '<th>'
                            + '<button class="btn btn-circle default dark-stripe" onclick="load_tray();"><i class="fa fa-refresh"></i></button>'
                            + '</th>'
                            + '';
            head.html(head_);
            
            try{
                $("#after_load").remove();
                
            }catch(ex){}
            
            body.html('');
            
            $.each(data , function(k,v){
               
                //console.log(v.fecha + " ->" + v.hora);
                var body_ = '<tr onclick="show_message(' + v.id_mensaje + ');" class="odd gradeX">'
                          + '<td><input type="checkbox" class="checkboxes" value="' + v.id_mensaje + '"/></td>'
                          + '<td>' + '<img alt="" width="30" height="30" class="img-circle" src="' + route() + 'admin/img/users/' + v.imagen + '" />&nbsp&nbsp<span class="username ">' + v.nombre + '</span></td>'
                          + '<td>' + v.asunto + '</td>'
                          + '<td>' + v.fecha + '</td>'
                          + '<td>' + v.hora + '</td>'
                          + '<td></td>'
                          + '</tr>';

                body.append(body_);
            });
          
            send_table.init();
           
        });
        task.do_task();  
    };
    
    this.get_asign_to = function(request , type){
        
        var task = new jtask();
        task.url = route()  + "admin/messages/loader/tray_to.php";
        task.async = true;
        task.success_callback(function(callback){
            if(type === 1){
                 request.val(callback);
            }else{
                var data      = JSON.parse(callback);
                $.each(data , function(k,v){
                        request.append("<option value='" + v.id + "'>" + v.name + "</option>");
                });
            }
        });
        task.do_task();
        
    };
    
    this.send_messaje = function(to , bussiness , msj){
        
        var task = new jtask();
        task.method = "GET";
        task.data = {
            "msj" : msj,
            "msj_to" : to,
            "msj_bussines" : bussiness
        };
        task.url = route()  + "admin/messages/loader/tray_send.php";
        task.async = true;
        task.beforesend = true;
        task.config_before(function(){
             $("#load_compose").html("Enviando ...");
        });
        task.success_callback(function(callback){
                var result = $.trim(callback);
            if(result){
                $("#cmd_compose").notify(
                                    "Tu mensaje ha sido enviado ...", 
                                    "success"        
                );
            }
            else{
                    $("#cmd_compose").notify(
                                        "No se pudo enviar el mensaje, Causa(Error interno ...)", 
                                    { position:"right"   },
                                        "warn"
                                 );
                }
               $("#load_compose").html('<i class="fa fa-edit"></i> Redactar');
        });
        task.do_task();
 
        
    };
    
    
};
