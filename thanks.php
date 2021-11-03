<?php
session_start();
if (!isset($_SESSION['name'])) {
	header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Products - HIGH QUALITY DENIM</title>
	<meta charset="UTF-8">
	<link rel="shortcut icon" type="image/png" href="image/icon.png">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://kit.fontawesome.com/a076d05399.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" integrity="sha512-1cK78a1o+ht2JcaW6g8OXYwqpev9+6GqOkz9xmBN9iUUhIndKtxwILGWYOSibOKjLsEdjyjZvYDq/cZwNeak0w==" crossorigin="anonymous" />
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
	<link rel="stylesheet" href="css/shopping-cart.css">

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
        		<li>
							<?php if (!isset($_SESSION['name'])): ?>
								<a href="login.php">Login/Register</a>
							<?php else : ?>
								<a href="/rucas.co/my_account.php"> Welcome <?= $_SESSION['name']; ?> </a>
							<?php endif; ?>
						</li>
        		<li><a href="#"><i class="fas fa-shopping-cart"></i></a></li>
      		</ul>
      		<div class="icon menu-btn">
        		<i class="fas fa-bars"></i>
      		</div>
    	</div>
  	</nav>

	<div class="container thanks">
		<div class="card text-center mt-5">
			<div class="card-header">
				<h2><i class="lnr lnr-thumbs-up"></i></h2>
			</div>
			<div class="card-body">
				<h2 class="card-title">Thank you for purchasing our items</h2>
				<p class="card-text">Please check your email <i class="lnr lnr-envelope"></i></p>
			</div>
			<div class="card-footer text-muted">
				<a href="/rucas.co/customer_transaction_history.php" class="btn btn-primary">See Your Order</a>
			</div>
		</div>
	</div>


	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
	<!-- <script>
		AOS.init();
	</script> -->
	<script src="get_all_stocks_cust.js"></script>
</body>
</html>
