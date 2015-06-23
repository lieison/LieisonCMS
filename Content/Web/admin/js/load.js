var load_dashboard_sidebar = function()
 {
     
       var rol = document.getElementById("rol_value").value;
       var page = document.getElementById("page_value").value;
       var route = document.getElementById("route_value").value;
       
       var task_ = new jtask();
       task_.async = true;
       task_.url = route  + "admin/ControlPage/GetDashboardSidebar.php";
       task_.data = {
              "rol" : rol,
              "page": page
       };
       task_.beforesend = true;
       task_.config_before(function(){
           $("#dashboard_sidebar_load").html(
                   "<br><br><br><br><br><br><br><br>" 
                   +"<li><p align='center'><img src='" + 
                   route + "/admin/img/assert/loading.gif' width='150' height='150' /></p></li>");
       });
       task_.success_callback(function(call){
            $("#dashboard_sidebar_load").html(call);
       });
       task_.do_task();
   
   };
   