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
            break;
        case "tray_2":
            $("#" + name).removeClass().addClass("sent active");
            $("#tray_1").removeClass().addClass("inbox");
            $("#tray_3").removeClass().addClass("trash");
            break;
        case "tray_3":
            $("#" + name).removeClass().addClass("trash active");
            $("#tray_1").removeClass().addClass("inbox");
            $("#tray_2").removeClass().addClass("sent");
            break;
    }
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


