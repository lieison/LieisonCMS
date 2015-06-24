
var messages_ = function(){
  
    var route = function(){
        return document.getElementById("route_value").value;
    };
  
    var count_from = function(count){
          var t = $("#count_tray_1");
          t.html("Entrada (" +count + ")");
    };
    
    var count_to = function(count){
          var t = $("#count_tray_2");
          t.html("Enviados (" +count + ")");
    };
    
    var count_trash = function(count){
          var t = $("count_tray_3");
          t.html("Papelera (" +count + ")");
    };
    
    this.load_from = function( before , load){
        
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
            count_from(count);
            
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
            
           if(load)
            messages_table.init();
        
 
        });
        task.do_task();
    };
    
    
};
