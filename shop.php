<?php
session_start();
if (!isset($_SESSION['name'])) {
  header("Location: login.php?e=1");
  exit;
}

if($_SESSION['authorization'] == 'Admin') {
  header("Location: index.php");
  exit;
}



?>

<!DOCTYPE html>
<!-- Created By CodingNepal - www.codingnepalweb.com -->
<html lang="en">
<head>
	<title>Products - HIGH QUALITY DENIM</title>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/png" href="image/icon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/shop-style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" integrity="sha512-1cK78a1o+ht2JcaW6g8OXYwqpev9+6GqOkz9xmBN9iUUhIndKtxwILGWYOSibOKjLsEdjyjZvYDq/cZwNeak0w==" crossorigin="anonymous" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
</head>
<body>
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
        		<li><a href="/rucas.co/my_account.php">Welcome <?= $_SESSION['name']; ?></a></li>
        		<li><a href="/rucas.co/cart.php"><i class="fas fa-shopping-cart"></i></a></li>
      		</ul>
      		<div class="icon menu-btn">
        		<i class="fas fa-bars"></i>
      		</div>
    	</div>
  	</nav>


  	<div class="container2">
  		<h1 class="text-center">SHOP</h1>

      <form class="form-inline">
        <div class="md-form my-0">
          <input class="form-control mr-sm-2" type="text" name="search" placeholder="Search Product Here" id="search-bar" aria-label="Search">
        </div>
      </form>

  		<div class="row" id="table-of-content">


		    </div>
  	</div>

	<footer class="page-footer mt-3">
        <div class="footer-copyright text-left py-5 ml-5 mr-5">© 2020 Copyright:
            <a href="https://rucas.co/" target="#">PETRADENIM.CO</a>
            <a href="https://instagram.com/rucas.co">
            	<i class="fab fa-instagram float-right"></i>
            </a>
        </div>

    </footer>

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
	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
	<script>
  		AOS.init();
	</script>
	<script src="get_all_stocks_cust.js"></script>
</body>
</html>
