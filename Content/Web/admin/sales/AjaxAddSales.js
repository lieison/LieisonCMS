
 /**
 *@author Rolando Antonio Arriaza <rmarroquin@lieison.com>
 *@copyright (c) 2015, Lieison
 *
 *  Permission is hereby granted, free of charge, to any person obtaining a copy
    of this software and associated documentation files (the "Software"), to deal
    in the Software without restriction, including without limitation the rights
    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the Software is
    furnished to do so, subject to the following conditions:

    The above copyright notice and this permission notice shall be included in
    all copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
    SOFTWARE. 
 * 
 *@version 1.0
 *@todo Lieison S.A de C.V 
 * 
 * 
 * 
 */

function verificar_prospecto(nombre)
  {
         
         var parametros = {
                    "nombre" : nombre
                 };

                $.ajax({
                      type: "POST",
                      url: "getexist_prospect.php",
                      data: parametros,
                      beforeSend: function()
                      {
                          $("#verificar_prospecto").html("<span class='fa fa-spinner'>Verificando</span>");
                      },
                      success: function(value){
                             if(value == 0){
                                 if(nombre == '' || nombre == null)
                                 {
                                      $("#verificar_prospecto").html("Prospecto vacio ..");
                                      $("#cmd_enviar").hide();
                                       $("#txt_error").text("Nombre del Prospecto esta vacio ...");
                                 }
                                 else{
                                    $("#verificar_prospecto").html("Prospecto Disponible");
                                     $("#cmd_enviar").show();
                                      $("#txt_error").text("");
                                }
                            }
                             else{
                                 $("#verificar_prospecto").text("Nombre ya Utilizado "); 
                                 $("#cmd_enviar").hide();
                                 $("#txt_error").text("No se puede guardar este prospecto ya existe , cambie el nombre");
                             }
                      }
              });
    }
    
  function verificar_facebook(fb)
  {
      
      document.getElementById("verificar_facebook").innerHTML='<iframe src="//www.facebook.com/plugins/likebox.php?href=' + fb + ';width&amp;height=62&amp;colorscheme=light&amp;show_faces=false&amp;header=false&amp;stream=false&amp;show_border=false&amp;appId=644055289044788" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:62px;" allowTransparency="true"></iframe>';
  }
  
  function verificar_twitter(tw)
  {
      
      document.getElementById("verificar_twitter").innerHTML='<iframe src="//platform.twitter.com/widgets/follow_button.html?screen_name=' + tw + '" style="width: 300px; height: 20px;" allowtransparency="true" frameborder="0" scrolling="no"></iframe>';
  }
  
  function initialize() {

  var markers = [];
  var map = new google.maps.Map( {
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });

  var defaultBounds = new google.maps.LatLngBounds(
      new google.maps.LatLng( 13.9336532,-89.2157002),
      new google.maps.LatLng( 13.9336532,-89.2157002));
  map.fitBounds(defaultBounds);

 
  var input = /** @type {HTMLInputElement} */(
      document.getElementById('txt_direccion1'));
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

  var searchBox = new google.maps.places.SearchBox(
   (input));

 
  google.maps.event.addListener(searchBox, 'places_changed', function() {
    var places = searchBox.getPlaces();

    if (places.length == 0) {
      return;
    }
    for (var i = 0, marker; marker = markers[i]; i++) {
      marker.setMap(null);
    }

  
    markers = [];
    var bounds = new google.maps.LatLngBounds();
    for (var i = 0, place; place = places[i]; i++) {
      var image = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25)
      };

    
      var marker = new google.maps.Marker({
        map: map,
        icon: image,
        title: place.name,
        position: place.geometry.location
      });

      markers.push(marker);

      bounds.extend(place.geometry.location);
    }

    map.fitBounds(bounds);
  });

  google.maps.event.addListener(map, 'bounds_changed', function() {
    var bounds = map.getBounds();
    searchBox.setBounds(bounds);
  });
}

google.maps.event.addDomListener(window, 'load', initialize);