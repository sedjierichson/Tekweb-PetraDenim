$(document).ready(function() {
  $("#registerpassword").complexify({}, function(valid, complex) {
    var progress = $("#progress");
    progress.toggleClass("bg-success", valid);
    progress.toggleClass("bg-danger", valid);
    progress.css({'width': complex+ '%'});
    $("#percent").text(Math.round(complex) + '%');
  });

  $("#register-btn").click(function(e) {
    e.preventDefault();

    var name = $("#registername").val();
    var email = $("#registeremail").val();
    var address = $("#registeraddress").val();
    var password = $("#registerpassword").val();
    var phonenum = $("#registerphonenum").val();

    if (name == '' || email == '' || address == '' || password == '' || phonenum == '') {
      $("#messages").html("<div class='alert alert-danger' role='alert'> You must fill all data </div>");
    } else if (parseInt($('#percent').html()) < 50) {
      $("#messages").html("<div class='alert alert-danger' role='alert'> Your password is weak. Fill until 50%. </div>");
    } else if ($("#agreeterms").is(":checked") == false) {
      $("#messages").html("<div class='alert alert-danger' role='alert'> You have to agree with our terms and conditions. </div>");
    }else {
      $.ajax({
        url: '/rucas.co/services/global/perform_register.php',
        method: 'POST',
        dataType: 'json',
        data: {
          name: name,
          email: email,
          address: address,
          phonenum: phonenum,
          password: password
        },
        success: function(data){
          if (data.status == 1) {
            $("#messages").html("<div class='alert alert-success' role='alert'>"+ data.message +" <a href='login.php'>Login here</a></div>");
            $("#registername").val('');
            $("#registeremail").val('');
            $("#registeraddress").val('');
            $("#registerpassword").val('');
            $("#registerphonenum").val('');

          } else {
            $("#messages").html("<div class='alert alert-danger' role='alert'>"+ data.message +"</div>");
          }
        },
        error: function(request, status, error) {
          console.log('error');
          $("#messages").html("<div class='alert alert-danger' role='alert'>"+ request.responseText +"</div>");
        }
      });

    }



  });
});
