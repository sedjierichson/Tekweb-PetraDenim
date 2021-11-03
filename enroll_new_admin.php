<?php
session_start();
if (!isset($_SESSION['name']) || $_SESSION['authorization'] == "Customer") {
  header("Location: shop.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Enroll New Admin - R U C A S</title>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/png" href="image/icon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="/rucas.co/css/admin_nav.css">

</head>
  <body>

    <nav style="z-index: 999; position: relative;">
      <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
          </label>
          <label class="logo">RUCAS ADMIN</label>
          <ul>
            <li><a href="/rucas.co/admin_page.php">Home</a></li>
            <li><a href="/rucas.co/transaction_list.php">Transaction List</a></li>
            <li><a href="/rucas.co/stock_list.php">Product List</a></li>
            <li><a href="/rucas.co/liat_stock.php">Product Stocks</a></li>
            <li><a class="active" href="/rucas.co/my_account.php">Account</a></li>
          </ul>
    </nav>

  <!-- FORM REGISTER -->
  <div class="container">
    <div class="row justify-content-center col-12">
      <section class="col-md-8 formulir" style="padding-top: 3vh!important;">

        <!-- Tambahan willson -->
        <div id="messages"></div>

        <!-- Default form login -->
        <form class="text-center border border-light p-5" action="#!" id="boxform">
          <p class="h4 mb-4">ENROLL NEW ADMIN</p>
          <!-- Nama -->
          <input type="text" id="registername" class="form-control mb-4" placeholder="Name*" required>
          <!-- Email -->
          <input type="email" id="registeremail" class="form-control mb-4" placeholder="E-mail*" required>
          <!-- Phone Number -->

          <input type="text" id="registerphonenum" class="form-control mb-4" placeholder="Phone Number*" required>

          <!-- Date Of Birth -->
          <input type="date" id="registerdob" class="form-control mb-4" placeholder="Date of Birth*" required>

          <!-- Address -->
          <input type="text" id="registeraddress" class="form-control mb-4" placeholder="Address*" required>
          <!-- Password -->
          <input type="password" id="registerpassword" class="form-control mb-4" placeholder="Default Password" disabled>
          <small>Default Password: Date of Birth. Let user change it manually if account already set.</small>

          <!-- Register button -->
          <button class="btn btn-dark btn-block my-4" id="register-btn">Enroll Now</button>
          <a href="/rucas.co/my_account.php">Cancel</a>
        </form>
      </section>
    </div>
  </div>

  	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

    <script type="text/javascript">

    $(document).ready(function() {
      $("#register-btn").click(function() {

        var name = $("#registername").val();
        var email = $("#registeremail").val();
        var address = $("#registeraddress").val();
        var phonenum = $("#registerphonenum").val();
        var date_of_birth = $("#registerdob").val();

        $.ajax({
          url: '/rucas.co/services/admin/enroll_new_admin.php',
          method: 'POST',
          dataType: 'json',
          data: {
            name: name,
            email: email,
            address: address,
            phonenum: phonenum,
            date_of_birth: date_of_birth
          },
          success: function(data){
            if (data.status == 1) {
              $("#messages").html("<div class='alert alert-success' role='alert'>"+ data.message +" <a href='login.php'>Login here</a></div>");
              $("#registername").val('');
              $("#registeremail").val('');
              $("#registeraddress").val('');
              $("#registerphonenum").val('');
              $('#registerdob').val('');

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
    </script>
</body>
</html>
