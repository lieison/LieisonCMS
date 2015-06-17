/* 
 * 
 * 
 */

var chat_preview = function(id){
    
     var load_chat = new chat();
     load_chat.add(id);
};


var chat = function(){
    
   var sidebar = function(){
        
     $("body")
        .removeClass("page-header-fixed page-quick-sidebar-over-content page-style-square")
        .addClass("page-header-fixed page-quick-sidebar-over-content page-style-square page-quick-sidebar-open");
    };
    
    var route = function(){
        return document.getElementById("route_value").value;
    };
    
    this.add = function(id){
        
          var task = new jtask();
          task.url = route() + "admin/messages/loader/chat_loader.php";
          task.data = {
              "id_message" : id
          };
          task.beforesend = true;
          task.config_before(function(){
               /**
                * Ponemos en loading para que cargue los complementos
                * */
               sidebar(); //cargamos el sidebar
               $("#chat_count").html("..."); //loading ...
          });
          task.success_callback(function(callback){
              
              /**
               * En este caso aplicaremos un almacenamiento de tipo cache
               * en js
               * */
              if(window.localStorage.getItem("chat") === null){
                  
              }else{
                  
                  var old_ = window.localStorage.getItem("chat");
                  
                  window.localStorage.setItem("chat" , "");
              }
              
              $("#chat_count").html("");
          });
          task.do_task();
         
    };
    
    
   
};


