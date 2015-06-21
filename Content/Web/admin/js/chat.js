/* 
 * @version 1.5
 * SISTEMA DE CHAT LIEISON 
 */


/**
 * @version 1.0
 * @author Rolando Arriaza
 * @description cuando en metronics cae un inbox le da seleccionar entonces se abre el chat
 * */
var chat_preview = function(id){
    
     var load_chat = new chat();
     load_chat.add(id);
};


/**
 * @version 1.0
 * @author Rolando Arriaza
 * @description elimina un chat activo
 * */
var delele_chat = function(id){
    console.log("eliminando elemento {" + id + "}");
    var chat_ = new chat();
    chat_.delete_active_chat(id);
};


/**
 * @version 1.0
 * @author Rolando Arriaza
 * @descriptionsistema de chateo por medio de tareas asincronas
 * */
var chat_message = function(id){
    window.localStorage.removeItem("chat_active");
    window.localStorage.setItem("chat_active" , id);
    var chat_ = new chat();
    chat_.sidebar();
    chat_.chat_messages();
};


var inbox = function(){
    var route = document.getElementById("route_value").value;
    var task = new jtask();
    task.url = route  + "admin/messages/front_inbox.php";
    task.async = true;
    task.success_callback(function(call){
         var decode     = JSON.parse(call);
         var count      = decode['count'].counter;
         
         $("#inbox_count").html(count);
        
         var c          = '';
         switch(parseInt(count)){
             case 0:
                 c += '<h3>No Hay <span class="bold">Mensajes</span> Recientes  </h3>';
                 break;
             case 1:
                  c += '<h3>1 <span class="bold">Mensaje</span> Reciente  </h3>';
                 break;
             default :
                 c += ' <h3>' + count + '  <span class="bold">Mensajes</span> Recientes </h3>';
                 break;
         }
         
         c += '<a href="' + decode['count'].url  + '">Ver Todos</a>';
        
         $("#inbox_data").html(c);
         
         $("#inbox_messages").html(decode['inbox'].data);
        
         $("#inbox_count").removeClass("badge badge-active")
                 .addClass("badge badge-primary");
         
         
        var title =  $("#title").html();
            title = title.replace('(' , "" , title);
            title = title.replace(')' , "" , title);
            title = title.replace(/[0-9]+/gi, "");
                          
         if(parseInt(count) === 0){
             $("#title").html( title );
         }else{
             $("#title").html( "(" + count + ")" + " " + title );
         }
         
         setTimeout('inbox()', 3000);
        // setInterval('inbox()',2000);
         
        // console.log("iteracion ... " );

    });
    task.do_task();
    
    var chat_ = new chat();
    chat_.count_chat();
    chat_.load();
};


/**App Chat
 * 
 * @author Rolando Arriaza
 * @class chat
 * @version 1.2
 * @requires jquery , metronics template
 * */

var chat = function(){
    
    this.sidebar = function(){
        
     $("body")
        .removeClass("page-header-fixed page-quick-sidebar-over-content page-style-square")
        .addClass("page-header-fixed page-quick-sidebar-over-content page-style-square page-quick-sidebar-open");

     $("#quick_sidebar_tab_1")
            .removeClass("tab-pane active page-quick-sidebar-chat")
            .addClass("tab-pane active page-quick-sidebar-chat page-quick-sidebar-content-item-shown");
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
                              //console.log("bandera arriba");
                              flag = true;
                          }
                      });
                      
                      if(!flag){
                          data.push(id);
                      }
                      
                      window.localStorage.removeItem("chat");
                      window.localStorage.setItem("chat" , data );
                  }
              }
              
             chat_message(id);
              
             

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
                // console.log("reset data");
                 window.localStorage.removeItem("chat");
            }
            //console.log(data);
            $("#chat_count").html(data.length);
        }catch(ex){
            
            $("#user_chat").html(
                     '<h3 class="list-heading">No hay chats...</h3>'
                    );
            
            $("#chat_count").html("0");
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
                //console.log("removiendo nodo");
                $("#chat_" + id).remove();
            }
            //console.log("compilando almacenamiento local");
            window.localStorage.removeItem("chat");
            window.localStorage.setItem("chat" , data);
            this.count_chat();
            this.load();
            
        }catch(ex){}
    };
    
    this.chat_messages = function(){
        
        if(window.localStorage.getItem("chat_active") === null){
             return ;
        }
        
        var id = window.localStorage.getItem("chat_active");
        
        alert(id);
        
    };
   
};


