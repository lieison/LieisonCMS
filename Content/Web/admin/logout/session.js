

function exit_session(){
      $.ajax({
                      type: "POST",
                      url: "LogoutPage.php",
                      success: function(value){
                            var url = $.trim(value);
                            alert(url);
                           // window.location.href = url ;
                      }
       });
}