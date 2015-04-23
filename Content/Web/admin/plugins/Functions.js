

function install(path){
    
    
     var params = { "path": path };
    
     $.ajax({
                    type: "POST",
                    url: "CallInstall.php",
                    data: params,
                    beforeSend:function(){
                         $('#action_plugins').html('Instalando Modulo Espere...');
                    },
                    success: function(valor){
                        var data = $.trim(valor);
                        if(data == "true"){
                            $('#action_plugins').html("<b>Modulo Instalado con exito</b>");
                        }else{
                              $('#action_plugins').html(valor);
                              //window.href = "index.php";
                        }
                     }
          });    
    
}
