


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
 

   
   
  
  