 /**
 *@author Rolando Antonio Arriaza <rmarroquin@lieison.com>
 *@copyright (c) 2015, Lieison
 *
 *  Permission is hereby granted, free of charge, to any person obtaining a copy
    of this software and associated documentation files (the "Software"), to deal
    in the Software without restriction, including without limitation the rights
    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the Software is
    furnished to do so, subject to the following conditions:

    The above copyright notice and this permission notice shall be included in
    all copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
    SOFTWARE. 
 * 
 *@version 1.0
 *@todo Lieison S.A de C.V 
 */
    
    function nueva_seccion()
    {
         $.ajax({
                    type: "POST",
                    url: "controlpagina/LoadAddseccion.php",
                    beforeSend:function(){
                         $('#seccion_standar').html('<img src="../admin/img/assert/loadingd.gif" width="50" height="50" />');
                    },
                    success: function(valor){
                        $('#seccion_standar').html(valor);
                     }
           });    
    }
    
  
    function buscar_log(logtype)
    { 
        
        var loading = "<p><span>Cargando ...</span></p>";
        
        var datalog = "default";
        var valor = "";
        var div_data = "";
        var div_select = ["div_monitoring"];
        
        switch(logtype)
        {
            case 1:
                datalog = "io";
                valor = $("#logdefault").val();
                div_data = div_select[0];
                break;
            case 2:
                datalog = "";
               
                break;
        }
        
      
        var parametros = {
                       "date" : valor,
                       "input": datalog
                    };

          $.ajax({
                    type: "POST",
                    url: "ResponsiveControlPaginas.php",
                    data: parametros,
                    beforeSend:function(){
                            $("#" + div_data).html(loading);
                       },
                      success: function(valor){
                           $("#" + div_data).html(valor);
                       },
                      error: function()
                       {
                           $("#" + div_data).html("<p>Ha ocurrido un error , favor refrescar pantalla.</p>");
                       },
                      complete: function() {
                         initMonitoring_dataio();
                      }
                   });
    }
    
    
 
    function font_change(){
        var font = $("#txt_icono").val();
        $("#font_change").html('Font Awesome Icono &nbsp;&nbsp; <i  class="'  + font +'"></i>'); 
    }
    
    
    var PrivF = function () {


    var _initComponents = function() {
        
         $.ajax({
                      type: "POST",
                      url: "get_seccion_privs.php",
                      success: function(value){
                             var result =  JSON.parse(value);
                             var count = result.length;
                             var array = [];
                             for(var i =0; i<count;i++){
                                 array[i] = result[i].nombre;
                             }
                             $(".todo-taskbody-tags").select2({
                                 tags: array
                             });
                      }
         });

    }

    var _handleProjectListMenu = function() {
        if (Metronic.getViewPort().width <= 992) {
            $('.todo-project-list-content').addClass("collapse");
        } else {
            $('.todo-project-list-content').removeClass("collapse").css("height", "auto");
        }
    }

    // public functions
    return {

        //main function
        init: function () {
            _initComponents();     
            _handleProjectListMenu();

            Metronic.addResizeHandler(function(){
                _handleProjectListMenu();    
            });       
        }

    };

}();


    function SavePage(){
        
        var id = $("#txt_id").val();
        var titulo = $("#txt_titulo").val();
        var icono = $("#txt_icono").val();
        var link = $("#txt_link").val();
        var seccion = $("#cmd_seccion").val();
        var priv = $("#txt_priv").val();
        
        var parametros = {
            "id": id,
            "titulo": titulo,
            "icono": icono,
            "link": link,
            "seccion": seccion,
            "priv": priv
        };
        
       $.ajax({
                      type: "POST",
                      url: "save_edit_paginas.php",
                      data: parametros,
                      beforeSend: function()
                      {
                          $("#cmd_actualizar").html('Actualizando espere ...');
                      },
                      success: function(value){
                            var result = $.trim(value);
                            if(result == 1){
                                $("#cmd_actualizar").html('Actualizado');
                            }else{
                                 $("#cmd_actualizar").html('No Actualizado');
                            }
                            
                      }
        });
        
    }