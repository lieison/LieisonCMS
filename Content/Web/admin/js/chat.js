/* 
 * 
 * 
 */



var chat_preview = function(id){
    
     var load_chat = new chat();
     load_chat.add(id);
};

var delele_chat = function(id){
    console.log("eliminando elemento {" + id + "}");
    var chat_ = new chat();
    chat_.delete_active_chat(id);
}


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

              //window.localStorage.removeItem("chat_active");
              //window.localStorage.removeItem("chat");
              if(window.localStorage.getItem("chat") === null){
                  var id_storage = [id];
                  window.localStorage.setItem("chat" , id_storage );
              }
              else{
                  
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
              
             sidebar();
             $("#quick_sidebar_tab_1")
                     .removeClass("tab-pane active page-quick-sidebar-chat")
                     .addClass("tab-pane active page-quick-sidebar-chat page-quick-sidebar-content-item-shown");

    };
    
    this.load = function(){
        
            if(window.localStorage.getItem("chat") === null){
                return;
            }
        
            var chats = window.localStorage.getItem("chat");
            var task = new jtask();
        
            task.method = "GET";
            task.url = route() + "admin/messages/loader/active_chat.php";
            task.async = true;
            task.data = {
                "id_message" : chats
            };
            task.success_callback(function(callback){
                // console.log("Chat: {" + id + "}"); //solo es para depuracion...
                $("#user_chat").html(callback);
            });
            
            task.do_task(); 
    };
    
    this.count_chat = function() {
        try{
            //window.localStorage.removeItem("chat");
            var c = window.localStorage.getItem("chat");
            var data = c.split(",");
            if(data == "" || data == null){
                 console.log("reset data");
                 window.localStorage.removeItem("chat");
            }
            console.log(data);
            $("#chat_count").html(data.length);
        }catch(ex){
            $("#chat_count").html("0");
            console.log("No hay contador..." );
        }
    };
    
    this.delete_active_chat = function(id){
        try{
            var c = window.localStorage.getItem("chat");
            var data = c.split(",");
            for(var i = 0; i < data.length ; i++){
                 if(data[i] == id){
                     data.splice(i , 1);
                     console.log("Eliminando ... metodo delete");
                 }
            }
            if($("#chat_" + id)[0]){
                console.log("removiendo nodo");
                $("#chat_" + id).remove();
            }
            console.log("compilando almacenamiento local");
            window.localStorage.removeItem("chat");
            window.localStorage.setItem("chat" , data);
            
        }catch(ex){}
    };
    
    this.chating = function(){
        
    };
   
};


