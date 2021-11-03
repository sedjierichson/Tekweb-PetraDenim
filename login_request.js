$(document).ready(function() {


  $("#sign-in-btn").click(function(e) {
    e.preventDefault();
    var email = $("#defaultLoginFormEmail").val();
    var password = $("#defaultLoginFormPassword").val();
    var remember_me = $("#defaultLoginFormRemember").is(':checked');
    var remember_me_php = 0;
    if (remember_me == true) {
      remember_me_php = 1;
    } else {
      remember_me_php = 0;
    }

    $.ajax({
      url: '/rucas.co/services/global/check_login.php',
      method: 'POST',
      dataType: 'json',
      data: {
        email: email,
        password: password,
        remember_me: remember_me_php
      },
      success: function(data){

        if (data.status == 1) {
          window.location.href = data.message;

        } else {
          $("#messages").html("<div class='alert alert-danger' role='alert'>"+ data.message +"</div>");
        }
      },
      error: function(request, status, error) {
        console.log('error');
        $("#messages").html("<div class='alert alert-danger' role='alert'>"+ request.responseText +"</div>");
      }
    });
  });
});
