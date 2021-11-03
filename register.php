<?php
session_start();
if(isset($_SESSION['authorization']) && $_SESSION['authorization'] == 'Admin') {
  echo "<script> alert('You must log out from admin account first'); </script>";
  echo "<script> window.location.replace('http://127.0.0.1/rucas.co/index.php'); </script>";
  exit;
} else if (isset($_SESSION['authorization']) && $_SESSION['authorization'] == 'Customer') {
  echo "<script> alert('You must log out from your current account first'); </script>";
  echo "<script> window.location.replace('http://127.0.0.1/rucas.co/my_account.php'); </script>";
  exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Account - R U C A S</title>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/png" href="image/icon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--  <title>Responsive Sticky Navbar | CodingNepal</title> -->
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

</head>
  <body>
      <nav class="navibar">
          <div class="content">
              <div class="logo">
                  <a href="index.php">R U C A S</a>
              </div>
              <ul class="menu-list">
                  <div class="icon cancel-btn">
          	           <i class="fas fa-times"></i>
                  </div>
                  <li><a href="shop.php">Shop</a></li>
                  <li><a href="about_us.html">About Us</a></li>
                  <li><a href="index.php">Main Page</a></li>
                  <li><a href="/rucas.co/cart.php"><i class="fas fa-shopping-cart"></i></a></li>
              </ul>
              <div class="icon menu-btn">
                  <i class="fas fa-bars"></i>
              </div>
          </div>
      </nav>

  <!-- FORM REGISTER -->
  <div class="container">
    <div class="row justify-content-center">
      <section class="col-md-8 formulir mb-4">

        <!-- Tambahan willson -->
        <div id="messages"></div>

        <!-- Default form login -->
        <form class="text-center border border-light p-5" action="#!" id="boxform">
          <p class="h4 mb-4">REGISTER YOUR ACCOUNT</p>
          <!-- Nama -->
          <input type="text" id="registername" class="form-control mb-4" placeholder="Your Name*" required>
          <!-- Email -->
          <input type="email" id="registeremail" class="form-control mb-4" placeholder="E-mail*" required>
          <!-- Phone Number -->

          <input type="text" id="registerphonenum" class="form-control mb-4" placeholder="Phone Number*" required>

          <!-- Address -->
          <input type="text" id="registeraddress" class="form-control mb-4" placeholder="Address*" required>
          <!-- Password -->
          <input type="password" id="registerpassword" class="form-control mb-2" placeholder="Password*" required>

          <div class="progress mb-3">
            <div class="progress-bar" role ="progressbar" id ="progress"></div>

            <p id="percent" class="float-right mt-2">0%</p>
          </div>

          <div class="d-flex justify-content-around">
            <div>

              <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="agreeterms" required>
                  <label class="custom-control-label" for="agreeterms">Agree to terms and conditions</label>
              </div>
            </div>
          </div>

          <!-- Register button -->
          <button class="btn btn-dark btn-block my-4" id="register-btn">Register</button>

          <p>Already have an account?
            <a href="login.php">Login here</a>
          </p>
        </form>
      </section>
    </div>
  </div>


  	<script>
    	const body = document.querySelector("body");
    	const navbar = document.querySelector(".navibar");
    	const menuBtn = document.querySelector(".menu-btn");
    	const cancelBtn = document.querySelector(".cancel-btn");
    	menuBtn.onclick = ()=>{
      	navbar.classList.add("show");
      	menuBtn.classList.add("hide");
      	body.classList.add("disabled");
    	}
    	cancelBtn.onclick = ()=>{
      	body.classList.remove("disabled");
      	navbar.classList.remove("show");
      	menuBtn.classList.remove("hide");
    	}
    	window.onscroll = ()=>{
      	this.scrollY > 20 ? navbar.classList.add("sticky") : navbar.classList.remove("sticky");
    	}
  	</script>
  	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.complexify@0.5.2/jquery.complexify.banlist.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.complexify@0.5.2/jquery.complexify.min.js"></script>
    <script src="register_request.js"></script>
</body>
</html>
