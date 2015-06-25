var UserTiles = function () {

    return {
        init: function () {

            if (!jQuery().sortable) {
                return;
            }

            $("#sortable_portlets").sortable({
                connectWith: ".tiles",
                items: ".tile", 
                opacity: 0.8,
                coneHelperSize: true,
                placeholder: '',
                forcePlaceholderSize: true,
                tolerance: "pointer",
                helper: "clone",
                tolerance: "pointer",
                forcePlaceholderSize: !0,
                helper: "clone",
                cancel: "", 
                revert: 250, 
                update: function(b, c) {
                    if (c.item.prev().hasClass("portlet-sortable-empty")) {
                        c.item.prev().before(c.item);
                    }                    
                }
            });
        }
    };
}();


var TablaUsuarios = function () {

    var handleTable = function () {
        
        var route = function(){
            
            return $("#route_value").val();
        };

        function restoreRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);

            for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                oTable.fnUpdate(aData[i], nRow, i, false);
            }

            oTable.fnDraw();
        }

        function editRow(oTable, nRow) {
            
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);
            jqTds[0].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[0] + '">';
            jqTds[1].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[1] + '">';
            jqTds[2].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[2] + '">';
            
            var parametros = {
                       "type" : "rols",
                       "args": aData[3]
                    };

                $.ajax({
                        type: "POST",
                        url: route() +  "admin/ControlPage/GetoRolResponsive.php",
                        data:parametros,
                        success: function(value){
                           // jqTds[3].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[3] + '">';
                           jqTds[3].innerHTML = value;
                       }
                   });
            
            jqTds[4].innerHTML = '<select class="form-control" ><option value="1">Activo</option><option value="0">Desactivado</option></select>';
            jqTds[5].innerHTML = '<a class="edit" href="">Guardar</a>';
            jqTds[6].innerHTML = '<a class="cancel" href="">Cancelar</a>';
 
            
        }
        
    
        function saveRow(oTable, nRow) {
            var jqInputs = $('input', nRow);
            var jqselect = $('select', nRow);
            var aData = oTable.fnGetData(nRow);
            
            if(aData[8] == null || aData[8]== "")
            {
                 var parametros = {
                       "usuario" : jqInputs[0].value,
                       "nombre":jqInputs[1].value,
                       "email": jqInputs[2].value,
                       "privilegios": jqselect[0].value,
                       "estado":jqselect[1].value,
                       "key": "null"
                 };

                $.ajax({
                        type: "POST",
                        url: route() +  "admin/ControlPage/GetSaveUserResponsive.php",
                        data:parametros,
                        success: function(value){
                            console.log(value);
                             var data = value.replace(/\s/g, '');
                             switch(data)
                             {
                                 case '1':
                                    oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                                    oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                                    oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
                                    oTable.fnUpdate(jqselect[0].value, nRow, 3, false);
                                    if(jqselect[1].value==1){
                                        oTable.fnUpdate("Activo", nRow, 4, false);
                                    }else{
                                        oTable.fnUpdate("Desactivado", nRow, 4, false);
                                    }
                                     break;
                                 case '0':
                                     document.getElementById("alertas_usuarios").innerHTML = "<br>Error al guardar , favor revisar los datos";
                                     break;
                                 case "mail":
                                      document.getElementById("alertas_usuarios").innerHTML = "<br>Se Necesita un correo electronico";
                                     break;
                                 case "nombre":
                                     document.getElementById("alertas_usuarios").innerHTML= "<br>Se Necesita un nombre y/o apellido";
                                     break;
                                 case "user":
                                     document.getElementById("alertas_usuarios").innerHTML = "<br>Se Necesita un usuario";
                                     break;
                                 default:
                                     document.getElementById("alertas_usuarios").innerHTML = "<br>Error al guardar , servidor ocupado.";
                                     break;
                             }
                            
                            
                         
                         }
                   });
                
            }
            else{

               var parametros = {
                       "usuario" : jqInputs[0].value,
                       "nombre":jqInputs[1].value,
                       "email": jqInputs[2].value,
                       "privilegios": jqselect[0].value,
                       "estado":jqselect[1].value,
                       "key": aData[8]
                 };

                $.ajax({
                        type: "POST",
                        url: route() +  "admin/ControlPage/GetUpdateUserResponsive.php",
                        data:parametros,
                        success: function(value){
                             console.log(value);
                             oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                             oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                             oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
                             oTable.fnUpdate(jqselect[0].value, nRow, 3, false);
                             if(jqselect[1].value==1){
                                  oTable.fnUpdate("Activo", nRow, 4, false);
                             }else{
                                  oTable.fnUpdate("Desactivado", nRow, 4, false);
                             }
                         
                         }
                   });
                
            }
            oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, 4, false);
            oTable.fnUpdate('<a class="delete" href="">Delete</a>', nRow, 5, false);
            oTable.fnDraw();
        }

        function cancelEditRow(oTable, nRow) {
            var jqInputs = $('input', nRow);
            oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
            oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
            oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
            oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, 4, false);
            oTable.fnDraw();
        }

        var table = $('#tabla_usuarios_');

        var oTable = table.dataTable({
           
            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
            // So when dropdowns used the scrollable div should be removed. 
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "Todos"] // change per page values here
            ],
            // set the initial value
            "pageLength": 10,

            "language": {
                "lengthMenu": " _MENU_ records"
            },
            "columnDefs": [{ // set default column settings
                'orderable': true,
                'targets': [0]
            }, {
                "searchable": true,
                "targets": [0]
            }],
            "order": [
                [0, "asc"]
            ] // set first column as a default sort by asc
        });

        var tableWrapper = $("#sistema_usuario");

        tableWrapper.find(".dataTables_length select").select2({
            showSearchInput: false //hide search box with special css class
        }); // initialize select2 dropdown

        var nEditing = null;
        var nNew = false;

        $('#nuevo_usuario').click(function (e) {
           
            e.preventDefault();

            if (nNew && nEditing) {
                if (confirm("Fila anterior no se ha guardado. ¿deseas guardarla?")) {
                    saveRow(oTable, nEditing); // save
                    $(nEditing).find("td:first").html("Alerta");
                    nEditing = null;
                    nNew = false;

                } else {
                    
                    oTable.fnDeleteRow(nEditing); // cancel
                    nEditing = null;
                    nNew = false;
                    
                    return;
                }
            }
           
            var aiNew = oTable.fnAddData(['', '', '', '', '', '','','','']);
            var nRow = oTable.fnGetNodes(aiNew[0]);
            editRow(oTable, nRow);
            nEditing = nRow;
            nNew = true;
        });

        table.on('click', '.delete', function (e) {
            e.preventDefault();
           
            var nRow = $(this).parents('tr')[0];
            var aData = oTable.fnGetData(nRow);
            
            if (confirm("¿Estas seguro que deseas eliminar " + aData[1] + " (" + aData[0] + ")?") == false) {
                return;
            }
              
            var parametros = {
                       "id": aData[8]
                    };

             $.ajax({
                        type: "POST",
                        url: route() +  "admin/ControlPage/GetDeleteUserResponsive.php",
                        data:parametros,
                        success: function(value){
                            console.log(value);
                           oTable.fnDeleteRow(nRow);
                            alert("Se ha eliminado " + aData[0] + " con exito !!");
                       }
               });
        });

        table.on('click', '.cancel', function (e) {
            e.preventDefault();
            if (nNew) {
                oTable.fnDeleteRow(nEditing);
                nEditing = null;
                nNew = false;
            } else {
                restoreRow(oTable, nEditing);
                nEditing = null;
            }
        });

        table.on('click', '.edit', function (e) {
            
            e.preventDefault();

            var nRow = $(this).parents('tr')[0];

            if (nEditing !== null && nEditing != nRow) {
                restoreRow(oTable, nEditing);
                editRow(oTable, nRow);
                nEditing = nRow;
            } else if (nEditing == nRow && this.innerHTML == "Guardar") {
                saveRow(oTable, nEditing);
                nEditing = null;
                
            } else {
                editRow(oTable, nRow);
                nEditing = nRow;
            }
        });
    };

    return {

        //main function to initiate the module
        init: function () {
            handleTable();
        }

    };

}();