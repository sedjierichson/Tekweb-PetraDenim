<?php
session_start();

require $_SERVER['DOCUMENT_ROOT']."/rucas.co/conn.php";

if (isset($_COOKIE['key']) && isset($_COOKIE['username'])) {
  $id = $_COOKIE['key'];
  $email = $_COOKIE['username'];
  if ($_COOKIE['role'] == 'admin') {
    $query1 = "SELECT * FROM admin WHERE id = ?";
    $stmt = $pdo->prepare($query1);
    $stmt->execute([$id]);
    $row = $stmt->fetch();

    if ($stmt->rowCount() != 0 && hash('sha256', $row['email']) === $email) {
      $_SESSION['name'] = $row['nama'];
      $_SESSION['authorization'] = "Admin";
      $_SESSION['admin_id'] = $row['id'];
      header("Location: admin_page.php");
    }
  } else if ($_COOKIE['role'] == 'cust') {
    $query2 = "SELECT * FROM customer WHERE id = ?";
    $stmt = $pdo->prepare($query2);
    $stmt->execute([$id]);
    $row = $stmt->fetch();

    if ($stmt->rowCount() != 0 && hash('sha256', $row['email']) === $email) {
      $_SESSION['name'] = $row['nama'];
      $_SESSION['authorization'] = "Customer";
      $_SESSION['cust_id'] = $row['id'];
      header("Location: shop.php");
    }
  }
}

if (isset($_SESSION['name'])) {
  $name = $_SESSION['name'];
}
?>

<!DOCTYPE html>
<!-- Created By CodingNepal - www.codingnepalweb.com -->
<html lang="en">
<head>
    <title>My Account - PETRADENIM</title>
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
                <a href="index.php">PETRADENIM</a>
            </div>
            <ul class="menu-list">
                <div class="icon cancel-btn">
          	       <i class="fas fa-times"></i>
                </div>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="about_us.html">About Us</a></li>
                <li><a href="index.php">Main Page</a></li>
                <li><a href="cart.php"><i class="fas fa-shopping-cart"></i></a></li>
            </ul>
            <div class="icon menu-btn">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </nav>

  <!-- Default form login -->
  <div class="container">

    <div class="row justify-content-center">
      <section class="col-md-8 formulir">
        <!-- Default form login -->
        <!-- Tambahan willson -->
        <div id="messages">
          <?php if (isset($_GET['e']) && $_GET['e'] == 1): ?>
            <div class='alert alert-danger' role='alert'>You Must Login First! </div>
          <?php endif; ?>
        </div>

        <form class="text-center border border-light p-5" action="#!" id="boxform">
          <p class="h4 mb-4">LOGIN</p>
          <!-- Email -->
          <input type="email" id="defaultLoginFormEmail" class="form-control mb-4" placeholder="E-mail*" required <?php if(isset($_SESSION['name'])) {echo "disabled value='$name'";} ?>>

          <!-- Password -->
          <input type="password" id="defaultLoginFormPassword" class="form-control mb-4" placeholder="Password*" required <?php if(isset($_SESSION['name'])) {echo 'disabled';} ?>>

          <div class="d-flex justify-content-around">
            <div>
              <!-- Remember me -->
              <div class="custom-control custom-checkbox">
                 <input type="checkbox" class="custom-control-input" id="defaultLoginFormRemember" <?php if(isset($_SESSION['name'])) {echo 'disabled';} ?>>
                  <label class="custom-control-label" for="defaultLoginFormRemember">Remember me</label>
              </div>
            </div>
          </div>

          <!-- Sign in button -->
          <button class="btn btn-dark btn-block my-4" id ="sign-in-btn" <?php if(isset($_SESSION['name'])) {echo 'disabled';} ?>>Sign in</button>

          <!-- Register -->
          <p>Not a member?
            <a href="register.php">Register here</a>
          </p>
        </form>
      </section>
    </div>
  </div>

<!-- Jumbotron -->

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
  <script src="login_request.js"></script>
</body>
</html>
