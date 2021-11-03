<?php
session_start();
$admin = true;

if (!isset($_SESSION['name']) || !isset($_SESSION['authorization'])) {
  header("Location: index.php");
}

include $_SERVER['DOCUMENT_ROOT']."/rucas.co/conn.php";

if (isset($_SESSION['name']) && $_SESSION['authorization'] == "Customer") {

  $sql = "SELECT * FROM `customer` WHERE id = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$_SESSION['cust_id']]);
  $row = $stmt->fetch();
  $admin = false;

} else if (isset($_SESSION['name']) && $_SESSION['authorization'] == "Admin") {

  $sql = "SELECT * FROM `admin` WHERE id = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$_SESSION['admin_id']]);
  $row = $stmt->fetch();
  $admin = true;

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Your Credentials - PETRA DENIM</title>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/png" href="image/icon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <?php if ($admin == true): ?>
      <link rel="stylesheet" href="/rucas.co/css/admin_nav.css">
    <?php endif; ?>

</head>
  <body>

    <?php if ($admin == true): ?>
      <nav style="z-index: 999; position: relative;">
        <input type="checkbox" id="check">
          <label for="check" class="checkbtn">
              <i class="fas fa-bars"></i>
            </label>
            <label class="logo">PETRADENIM ADMIN</label>
            <ul>
              <li><a href="/rucas.co/admin_page.php">Home</a></li>
              <li><a href="/rucas.co/transaction_list.php">Transaction List</a></li>
              <li><a href="/rucas.co/stock_list.php">Product List</a></li>
              <li><a href="/rucas.co/liat_stock.php">Product Stocks</a></li>
              <li><a class="active" href="/rucas.co/my_account">Account</a></li>
            </ul>
      </nav>
    <?php else: ?>

      <nav class="navibar">
      	<div class="content">
        		<div class="logo">
          		<a href="index.php">PETRA DENIM</a>
        		</div>
        		<ul class="menu-list">
          		<div class="icon cancel-btn">
            			<i class="fas fa-times"></i>
          		</div>
          		<li><a href="/rucas.co/shop.php">Shop</a></li>
          		<li><a href="/rucas.co/about_us.html">About Us</a></li>
          		<li><a href="/rucas.co/my_account.php" id="username"></a></li>
          		<li><a href="/rucas.co/cart.php"><i class="fas fa-shopping-cart"></i></a></li>
        		</ul>
        		<div class="icon menu-btn">
          		<i class="fas fa-bars"></i>
        		</div>
      	</div>
    	</nav>

    <?php endif; ?>

  <!-- FORM REGISTER -->
  <div class="container">
    <div class="row justify-content-center col-12">
      <section class="col-md-8 formulir" style="<?php if($admin == true) {echo 'padding-top: 3vh!important;'; } else { echo 'padding-top: 20vh!important;'; } ?>">
        <!-- Tambahan willson -->
        <div id="messages"></div>

        <!-- Default form login -->
        <form class="text-center border border-light p-5" action="#!" id="boxform">
          <p class="h4 mb-4">MY ACCOUNT</p>
          <input type="text" id= "authorization" name="authorization" value="<?= $_SESSION['authorization']; ?>" hidden>
          <!-- Nama -->
          <input type="text" id="changename" class="form-control mb-4" placeholder="Name*" required value="<?= $row['nama']; ?>">
          <!-- Email -->
          <input type="email" id="changeemail" class="form-control mb-4" placeholder="E-mail*" required value=<?= $row['email']; ?>>
          <!-- Phone Number -->

          <input type="text" id="changephonenum" class="form-control mb-4" placeholder="Phone Number*" required value="<?= $row['no_telp']; ?>">

          <!-- Date Of Birth -->
          <?php if ($admin == true): ?>
            <input type="date" id="changedob" class="form-control mb-4" placeholder="Date of Birth*" value="<?= $row['tanggal_lahir']; ?>">
          <?php else: ?>
            <input type="date" id="changedob" class="form-control mb-4" placeholder="Date of Birth*" value="2020-10-07" hidden>
          <?php endif; ?>

          <!-- Address -->
          <input type="text" id="changeaddress" class="form-control mb-4" placeholder="Address*" required value="<?= $row['alamat']; ?>">
          <!-- Password -->
          <input type="password" id="changepassword" class="form-control mb-2" placeholder="Create New Password">
          <div class="progress mb-3">
            <div class="progress-bar" role ="progressbar" id ="progress"></div>
            <p id="percent" class="float-right mt-2">0%</p>
          </div>

          <?php if ($admin == true): ?>
            <?php if (password_verify($row['tanggal_lahir'], $row['password'])): ?>
              <small style="color: red" id="password-warn">You have to change your password immediately.</small>
            <?php endif; ?>
          <?php endif; ?>

          <div class="additional-msg"></div>

          <!-- Register button -->
          <button class="btn btn-dark btn-block my-4" id="register-btn">Change your credentials</button>
          <?php if ($admin == true): ?>
            <a href="/rucas.co/enroll_new_admin.php">Enroll New Admin</a> &nbsp; | &nbsp;
            <a href="/rucas.co/deactivate_admin.php" id="deactivate-btn">Deactivate My Account</a> &nbsp; | &nbsp;
            <a href="/rucas.co/services/global/logout.php">Logout</a>
          <?php else: ?>
            <a href="/rucas.co/services/global/logout.php">Log Out</a> &nbsp; | &nbsp;
            <a href="/rucas.co/customer_transaction_history.php">Your Transaction History</a>
          <?php endif; ?>
        </form>
      </section>
    </div>
  </div>

  	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.complexify@0.5.2/jquery.complexify.banlist.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.complexify@0.5.2/jquery.complexify.min.js"></script>

    <script type="text/javascript">

    function loadName() {
      $.ajax({
        url: '/rucas.co/services/customer/load-name.php',
        method: 'GET',
        dataType: 'json',
        success: function(data){
          if (data.status == 1) {
            $("#username").html("Welcome " + data.message);
          } else {
            $("#username").html("Unknown");
          }
        },
        error: function(request, status, error) {
          $("#messages").html("<div class='alert alert-danger' role='alert'>"+ request.responseText +"</div>");
        }
      });
    }

    $(document).ready(function() {

      loadName();

      $("#changepassword").complexify({}, function(valid, complex) {
        var progress = $("#progress");
        progress.toggleClass("bg-success", valid);
        progress.toggleClass("bg-danger", valid);
        progress.css({'width': complex+ '%'});
        $("#percent").text(Math.round(complex) + '%');
      });

      $("#deactivate-btn").click(function(e) {
        e.preventDefault();
        var c = confirm("Are You Sure?");
        if (c == true) {
          window.location.replace("http://127.0.0.1/rucas.co/deactivate_admin.php");
        }
      });

      $("#register-btn").click(function(e) {
        e.preventDefault();
        var authorization = $("#authorization").val();
        var name = $("#changename").val();
        var email = $("#changeemail").val();
        var address = $("#changeaddress").val();
        var phonenum = $("#changephonenum").val();
        var date_of_birth = $("#changedob").val();
        var password = $("#changepassword").val();

        if (name == '' || email == '' || address == '' || phonenum == '' || date_of_birth == '') {
          $("#messages").html("<div class='alert alert-danger' role='alert'> You must fill all data </div>");
        } else if (parseInt($('#percent').html()) < 50 && parseInt($('#percent').html()) != 0) {
          $("#messages").html("<div class='alert alert-danger' role='alert'> Your password is weak. Fill until 50%. </div>");
        } else {

          $.ajax({
            url: '/rucas.co/services/global/change_credentials.php',
            method: 'POST',
            dataType: 'json',
            data: {
              authorization: authorization,
              name: name,
              email: email,
              address: address,
              phonenum: phonenum,
              date_of_birth: date_of_birth,
              password: password
            },
            success: function(data){
              if (data.status == 1) {
                $("#messages").html("<div class='alert alert-success' role='alert'>"+ data.message + "</div>");
              } else {
                $("#messages").html("<div class='alert alert-danger' role='alert'>"+ data.message +"</div>");
              }
            },
            error: function(request, status, error) {
              console.log('error');
              $("#messages").html("<div class='alert alert-danger' role='alert'>"+ request.responseText +"</div>");
            }
          });

          $("#password-warn").html("");
          loadName();
        }


      });
    });
    </script>
</body>
</html>
