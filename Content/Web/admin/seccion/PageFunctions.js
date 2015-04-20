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
    
   
    /*FUNCION PARA BUSCAR EN CUALQUIER LOG DESARROLLADO 
     * POR MEDIO DE UN PARAMETRO NUMERICO**/
    
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
    
    
