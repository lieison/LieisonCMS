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
          task.url = route() + "admin/messages/loader/message_chat.php";
          task.data = {
              "id_message" : id
          };
          task.beforesend = true;
          task.config_before(function(){
             
               sidebar(); //cargamos el sidebar
               $("#user_chat").html(' <h3 class="list-heading"><br><b>Cargando Chat...</b></h3>');
          });
          task.success_callback(function(callback){
              
              //window.localStorage.removeItem("chat_active");
              //window.localStorage.removeItem("chat");
              if(window.localStorage.getItem("chat") === null){
                  var id_storage = [id];
                  window.localStorage.setItem("chat" , id_storage );
              }else{
                  var current_storage =  window.localStorage.getItem("chat");
                  var data = current_storage.split(",");
                  if(Array.isArray(data)){
                     
                      var flag = false;
                      
                      $.map(data , function(call){
                          if(call == id){
                              console.log("bandera arriba");
                              flag = true;
                          }
                      });
                      
                      if(!flag){
                          data.push(id);
                      }
                      
                      window.localStorage.removeItem("chat_active");
                      window.localStorage.removeItem("chat");
                      window.localStorage.setItem("chat_active" , id);
                      window.localStorage.setItem("chat" , data );
                      
                  }
              }
              
             $("#user_chat").html("");

             $("#quick_sidebar_tab_1")
                     .removeClass("tab-pane active page-quick-sidebar-chat")
                     .addClass("tab-pane active page-quick-sidebar-chat page-quick-sidebar-content-item-shown");
         
          });
          task.do_task();
         
    };
    
    
    this.load = function(){
        
        if(window.localStorage.getItem("chat") === null){
            return;
        }
        
        
        var chats = window.localStorage.getItem("chat");
        var data = chats.split(",");

        //agregamos a la lista
        $.map(data, function(id){
            
            var task = new jtask();
           
            task.method = "GET";
            task.url = route() + "admin/messages/loader/active_chat.php";
            task.async = true;
            task.data = {
                "id_message" : id
            };
            task.success_callback(function(callback){
                // console.log("Chat: {" + id + "}"); //solo es para depuracion...
                 if($("#chat_" + id)[0]){
                     $("#chat_" + id).remove();
                     $("#user_chat").prepend(callback);
                 }else{
                     $("#user_chat").prepend(callback);
                 }
            });
            
            task.do_task(); 
        });
        
       
        
    };
    
    this.count_chat = function() {
        var c = window.localStorage.getItem("chat");
        var data = c.split(",");
        $("#chat_count").html(data.length);
    };
   
};


