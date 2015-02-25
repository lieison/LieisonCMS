

function load_message()
{
       var route = document.getElementById("route_value").value;
        $.ajax({
                    type: "POST",
                    url: route  + "admin/messages/ajax_message.php",
                    success: function(value){
                          $("#load_message").html(value);
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
   
   
   var iniciargraficos_visita = function () {
            if (!jQuery.plot) {
                return;
            }

            function showChartTooltip(x, y, xValue, yValue) {
                $('<div id="tooltip" class="chart-tooltip">' + yValue + '<\/div>').css({
                    position: 'absolute',
                    display: 'none',
                    top: y - 40,
                    left: x - 40,
                    border: '0px solid #ccc',
                    padding: '2px 6px',
                    'background-color': '#fff'
                }).appendTo("body").fadeIn(200);
            }
            
            
            function getresponsivedata()
            {
                
                 var fecha = new Date();
                 var mes = fecha.getMonth();
                 var anio = fecha.getYear();
                
                 var parametros = {
                       "mes" : mes,
                       "anio": anio
                 };

                $.ajax({
                      type: "POST",
                      url: "ControlPage/GetVisits.php",
                      data: parametros,
                      success: function(json){
                      var visitors = [];    
                      console.log(json);
                      var valores = $.parseJSON(json || "null");
                      for(var i in valores)
                      {
                        visitors.push(valores[i]);
                        console.log(valores[i]);
                      }
                           if ($('#site_statistics').size() != 0) {

                $('#site_statistics_loading').hide();
                $('#site_statistics_content').show();

                var plot_statistics = $.plot($("#site_statistics"),
                    [{
                        data: visitors,
                        lines: {
                            fill: 0.6,
                            lineWidth: 0
                        },
                        color: ['#f89f9f']
                    }, {
                        data: visitors,
                        points: {
                            show: true,
                            fill: true,
                            radius: 5,
                            fillColor: "#f89f9f",
                            lineWidth: 3
                        },
                        color: '#fff',
                        shadowSize: 0
                    }],

                    {
                        xaxis: {
                            tickLength: 0,
                            tickDecimals: 0,
                            mode: "categories",
                            min: 0,
                            font: {
                                lineHeight: 14,
                                style: "normal",
                                variant: "small-caps",
                                color: "#6F7B8A"
                            }
                        },
                        yaxis: {
                            ticks: 5,
                            tickDecimals: 0,
                            tickColor: "#eee",
                            font: {
                                lineHeight: 14,
                                style: "normal",
                                variant: "small-caps",
                                color: "#6F7B8A"
                            }
                        },
                        grid: {
                            hoverable: true,
                            clickable: true,
                            tickColor: "#eee",
                            borderColor: "#eee",
                            borderWidth: 1
                        }
                    });

                var previousPoint = null;
                $("#site_statistics").bind("plothover", function (event, pos, item) {
                    $("#x").text(pos.x.toFixed(2));
                    $("#y").text(pos.y.toFixed(2));
                    if (item) {
                        if (previousPoint != item.dataIndex) {
                            previousPoint = item.dataIndex;

                            $("#tooltip").remove();
                            var x = item.datapoint[0].toFixed(2),
                                y = item.datapoint[1].toFixed(2);

                            showChartTooltip(item.pageX, item.pageY, item.datapoint[0], item.datapoint[1] + ' visitas');
                        }
                    } else {
                        $("#tooltip").remove();
                        previousPoint = null;
                    }
                });
            }
                      }
                 });
            }
            
                getresponsivedata();
        }
  
  