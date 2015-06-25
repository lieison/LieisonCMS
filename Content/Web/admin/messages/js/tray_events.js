var event_ = function(id){
    primary(id);
};

var primary = function(id){
    var name    = "tray_" + id;
    switch(name){
        case "tray_1":
            $("#" + name).removeClass().addClass("inbox active");
            $("#tray_2").removeClass().addClass("sent");
            $("#tray_3").removeClass().addClass("trash");
            $("#tray_4").removeClass().addClass("trash");
            load_tray();
            break;
        case "tray_2":
            $("#" + name).removeClass().addClass("sent active");
            $("#tray_1").removeClass().addClass("inbox");
            $("#tray_3").removeClass().addClass("trash");
            $("#tray_4").removeClass().addClass("trash");
            load_read();
            break;
        case "tray_3":
            $("#" + name).removeClass().addClass("trash active");
            $("#tray_1").removeClass().addClass("inbox");
            $("#tray_2").removeClass().addClass("sent");
            $("#tray_4").removeClass().addClass("trash");
            break;
       case "tray_4":
            $("#" + name).removeClass().addClass("trash active");
            $("#tray_1").removeClass().addClass("inbox");
            $("#tray_2").removeClass().addClass("sent");
            $("#tray_3").removeClass().addClass("trash");
            break;   
    }
};

var redact = function() {
    
    var route = function(){
        return $("#route_value").val();
    };
    
    var avatar = function(){
      
        return route() + "admin/img/users/" +  $("#avatar").val();
        
    };
    
    
    this.show = function (){

         var asunto = '<div class="form-group">'
                    + '<label>Asunto: </label>'
                    + '<div class="input-group">'
                    + '<span class="input-group-addon"><i class="fa fa-briefcase"></i></span>'
                    + '<input type="text" class="form-control" placeholder="...">'
                    + '</div></div>';
            
         var msj    = '<div class="form-group">'
                    + '<label>Mensaje</label>'
                    + '<div class="input-group">'
                    + '<span class="input-group-addon"><i class="fa fa-envelope"></i></span>'
                    + '<textarea rows="10" cols="100" class="form-control" placeholder=""></textarea>'
                    + '</div></div>';
            
         var para   = '<div class="form-group">'
                    + '<label>Para:</label>'
                    + '<div>'
                    + '<select class="selectpicker" id="load_to" style="display: none;" >'
                    + '<option value="-1">Seleccione un usuario</option>'
                    + '</select>'
                    + '</div></div>';
            
         var de     = '<img alt="" width="30" height="30" class="img-circle" src="' + avatar() + '" />&nbsp&nbsp<span class="username ">Redacta Un mensaje ...</span>'
                    + ''
                    + '';
        
         var render = '<div class="row"><div class="col-md-12">'
                    + '<div class="portlet">'
                    + '<div class="portlet-body form">'
                    + '<form role="form"><div class="form-body">'
                    + para
                    + asunto 
                    + msj
                    + '</div></form>'
                    + '</div>'
                    + '</div>'
                    + '</div></div>';
                    

         bootbox.dialog({
            title: de,
            message:render,
            buttons: {
                    success: {
                        label: "  Enviar",
                        className: "btn-success fa fa-paper-plane",
                        callback: function () {
                          
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
        
         var msj = new messages_();
         msj.get_asign_to($("#load_to"));
        
    };
    
    this.send = function(){
        
        this.click = function(){
            
        };
        
        this.read  = function(){
            
        };
        
    };
    
};

var messages_table = function(){
   
     var tray_table = function () {

        var table = $('#messages_table');

        // begin first table
        table.dataTable({

            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "No existen correos",
                "info": "Mostrando _START_ de _END_ en _TOTAL_ Mensajes",
                "infoEmpty": "No entries found",
                "infoFiltered": "(filtered1 from _MAX_ total entries)",
                "lengthMenu": "Mostrando _MENU_ mensajes",
                "search": "Buscando:",
                "zeroRecords": "No existen correos"
            },

            "bStateSave": false, 

            "columns": [{
                "orderable": false
            }, {
                "orderable": true
            }, {
                "orderable": true
            }, {
                "orderable": true
            }, {
                "orderable": false
            }, {
                "orderable": false
            }  ],
        
            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 5,            
            "pagingType": "bootstrap_full_number",
            "language": {
                "search": "Buscar: ",
                "lengthMenu": "  _MENU_ ",
                "paginate": {
                    "previous":"Prev",
                    "next": "Next",
                    "last": "Last",
                    "first": "First"
                }
            },
            "columnDefs": [{  
                'orderable': false,
                'targets': [0]
            }, {
                "searchable": false,
                "targets": [0]
            }]
        });
        /**,
            "order": [
                [1, "asc"]
            ] */
    };
    
     return {
     
            init: function(){
                  tray_table();
            }
 
     };
    
}();


