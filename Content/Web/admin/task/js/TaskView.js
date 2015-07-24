var call_task = function(load){
    var tarea = new LieisoftTask();
    tarea.ShowTask(1,0,0 , load);
};


var call_thetask = function(type , style , order , load) 
{ 
    var tarea = new LieisoftTask();
    tarea.ShowTask(type,style, order, load);
};

var change_state_task = function(task){
    
     var tarea      = new LieisoftTask();
     var select_    = $("#task_state_" + task);
     
     if(select_.val() != 4){
            var wait = function(){};
            var success = function(callback){
            var d = $.trim(callback);
            if(d != 1){
                var data = '<div class="alert alert-danger">';
                data += '<strong>opps!</strong> No se pudo completar Favor avisar a su superior !!';
                $("#task_type_change").prepend(data);
            }};
         tarea.State(task , select_.val() , wait , success);
    }else{
         
     
           var render ="RENDERIZAR ";
          
           bootbox.dialog({
            title: "Formulario de reasignación",
            message:render,
            buttons: {
                    success: {
                        label: " Enviar Solicitud",
                        className: "btn-success fa fa-paper-plane",
                        callback: function () {
                            
                             var to     = $("#cmd_asing").val();
                             var m      = $("#text_area_data").val();
                             var asunto = $("#txt_asunto").val();
                             
                             if(to == "-1" ||  to === -1){
                                 $("#cmd_compose").notify(
                                        "No se pudo enviar el mensaje, Causa(No se selecciono un remitente)", 
                                    { position:"right"   },
                                        "warn"
                                 );
                                 return;
                             }else if(m === '' || m === 'undefinded'){
                                 $("#cmd_compose").notify(
                                        "No se pudo enviar el mensaje, Causa( No hay mensaje )", 
                                    { position:"right"   },
                                        "warn"
                                 );
                                 return;
                             }
                             
                             var msj = new  messages_();
                             msj.send_messaje(to , asunto , m);
                        }
                    },
                    close: {
                            label: " Cerrar",
                            className: "btn-danger fa fa-times",
                            callback: function() {
                             
                            }
                    }
              }
        }); 
    }
     
     
    
};


var LieisoftTask = function(){
    
        this.ShowTask = function(type , style , order , load)
        {
          
            var task = new jtask();
            task.url = "includes/taskview.php";
            task.data = {
                "type": type,
                "style": style,
                "order": order
            };
            
            if(load)
                task.beforesend = true;
            
            task.config_before(function(){
                 
                var loading = "<div clas='col-md-12'>";
                              loading += '<div class="portlet light">';
                              loading += '<div class="portlet-title tabbable-line"></div>';
                              loading += '<div class="portlet-body">';
                              loading += '<div class="portlet-body" align="center">';
                              loading += '<img src="' +  $("#route_value").val() + "admin/img/assert/loading.gif" + '" width="200" height="200" />';
                              loading += '</div></div></div>';
                              $("#task_view").html(loading);
                        
            });
            
            task.success_callback(function(value){
                    $("#task_view").html(value);
                   /* $("#task_view").sortable({
                                connectWith: ".portlet",
                                items: ".portlet", 
                                opacity: 0.8,
                                coneHelperSize: true,
                                placeholder: 'portlet-sortable-placeholder',
                                forcePlaceholderSize: true,
                                tolerance: "pointer",
                                helper: "clone",
                                tolerance: "pointer",
                                forcePlaceholderSize: !0,
                                helper: "clone",
                                cancel: ".portlet-sortable-empty, .portlet-fullscreen", 
                                revert: 250, 
                                update: function(b, c) {
                                if (c.item.prev().hasClass("portlet-sortable-empty")) {
                                    c.item.prev().before(c.item);
                                }                    
                     }});*/
            });
            
            task.do_task();
    
        };
        
        this.State = function(task , type , wait , success){
             var task_ = new jtask();
             task_.url = "includes/actions/state_action.php";
             task_.async = true;
             task_.beforesend = true;
             task_.data = {
                "id"    :  task,
                "type"  :  type
             };
             task_.config_before(wait);
             task_.success_callback(success);
             task_.do_task();
        };
    
};





