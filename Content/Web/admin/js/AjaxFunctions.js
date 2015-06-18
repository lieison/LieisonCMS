

function load_message()
{
       var route = document.getElementById("route_value").value;
        $.ajax({
                    type: "POST",
                    url: route  + "admin/messages/front_inbox.php",
                    success: function(value){
                          $("#load_message").html(value);
                     }
          });
        
          var chat_ = new chat();
          chat_.count_chat();
          chat_.load();
 }
 
 
 function load_count_message()
{
       var route = document.getElementById("route_value").value;

        $.ajax({
                    type: "POST",
                    url: route  + "admin/messages/count_inbox.php",
                    success: function(value){
                          var title =  $("#title").html();
                          value = $.trim(value);
                          title = title.replace('(' , "" , title);
                          title = title.replace(')' , "" , title);
                          title = title.replace(/[0-9]+/gi, "");
                          if(value == 0){
                               $("#title").html( title );
                          }else{
                               $("#title").html( "(" + value + ")" + " " + title );
                          }
                     }
          });
 }
 
 
 
 function load_notify()
 {
       var route = document.getElementById("route_value").value;
        $.ajax({
                    type: "POST",
                    url: route  + "admin/notifications/ajax_notification.php",
                    success: function(value){
                          $("#load_notify").html(value);
                     }
             });
 }
 
 function load_task(){
       
       var route = document.getElementById("route_value").value;
        $.ajax({
                    type: "POST",
                    url: route  + "admin/task/front/",
                    success: function(value){
                          $("#load_task").html(value);
                     }
             });
 }
 
 var load_dashboard_sidebar = function()
   {
     
       var rol = document.getElementById("rol_value").value;
       var page = document.getElementById("page_value").value;
       var route = document.getElementById("route_value").value;
       
       var d_params = {
                       "rol" : rol,
                       "page": page
         };

          $.ajax({
                    type: "POST",
                    url: route  + "admin/ControlPage/GetDashboardSidebar.php",
                    data: d_params,
                    beforeSend: function()
                    {
                         $("#dashboard_sidebar_load").html("<br><br><br><br><li><img src='" + route + "/admin/img/assert/loading.gif' width='40' height='40' /></li>");
                    },
                    success: function(value){
                          $("#dashboard_sidebar_load").html(value);
                          
                     }
             });
   }
   
   
   
  
  