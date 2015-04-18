

function deletemodule(root){
    alert(root);
}

function unistall(root){
     alert(root);
}

function install(root){
    
    var params = {
        "path" : root
    };
    $.ajax({
                      type: "POST",
                      url: "CallInstall.php",
                      data: params,
                      beforeSend: function()
                      {
                          $("#action_plugins").html(
                                  "<img src='../img/assert/loading.gif' width='40' height='40' />" +
                                   "Instalando molulo "
                                  );
                      },
                      success: function(value){
                         var result = $.trim(value);
                         if(result === "true"){
                                $("#action_plugins").html(
                                  "<a class='btn btn-primary' href='index.php'>Click para terminar la instalacion</a>"   
                                  );
                          }
                          else{
                              $("#action_plugins").html(
                                  '<div class="alert alert-success" role="alert">' + result + '</div>'
                                  );
                          }
                      }
    });
    
  
    
     
}
