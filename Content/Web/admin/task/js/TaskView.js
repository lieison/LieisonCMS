
var TaskInit = function () {

    return {
        init: function () {
            

            if (!jQuery().sortable) {
                return;
            }
            
             ShowTask(0,0,0 , true);
            
           
          
        }
    };
}();



var SelectTask = function(){
     return {
          init: function(){
             
          /*    $.ajax({
                      type: "POST",
                      url: "includes/taskview_select.php",
                      beforeSend : function(){
                         
                      },
                      success: function(value){
                            
                      }
               });*/
              
          }
     };
}();

function ShowTask(type , style , order , load){
    
       
      
       var data = {
           "type": type,
           "style": style,
           "order": order
       };
    
       $.ajax({
                      type: "POST",
                      url: "includes/taskview.php",
                      beforeSend : function(){
                          if(load){
                          var loading = "<div clas='col-md-12'>";
                              loading += '<div class="portlet light">';
                              loading += '<div class="portlet-title tabbable-line"></div>';
                              loading += '<div class="portlet-body">';
                              loading += '<div class="portlet-body" align="center">';
                              loading += '<img src="' +  $("#route_value").val() + "admin/img/assert/loading.gif" + '" width="200" height="200" />';
                              loading += '</div></div></div>';
                              $("#task_view").html(loading);
                        }
                      },
                      data: data,
                      success: function(value){

                             $("#task_view").html(value);
                             $("#task_view").sortable({
                                connectWith: ".portlet",
                                items: ".portlet", 
                                opacity: 0.8,
                                coneHelperSize: true,
                                placeholder: 'portlet-sortable-placeholder',
                                forcePlaceholderSize: true,
                                tolerance: "pointer",
                                helper: "clone",
                                tolerance: "pointer",
                                forcePlaceholderSize: !0,
                                helper: "clone",
                                cancel: ".portlet-sortable-empty, .portlet-fullscreen", 
                                revert: 250, 
                                update: function(b, c) {
                                if (c.item.prev().hasClass("portlet-sortable-empty")) {
                                    c.item.prev().before(c.item);
                                }                    
                            }});
                      }
        });

}

