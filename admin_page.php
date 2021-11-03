<?php
session_start();
if (!isset($_SESSION['name'])) {
	header("Location: login.php");
	exit;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome <?= $_SESSION['name'];?></title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
	<link rel="stylesheet" type="text/css" href="css/admin-page.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<style>

</style>
<body>
	<nav style="z-index: 999;">
    	<input type="checkbox" id="check">
    		<label for="check" class="checkbtn">
        		<i class="fas fa-bars"></i>
      		</label>
      		<label class="logo">PETRADENIM ADMIN</label>
      		<ul>
        		<li><a class="active" href="/rucas.co/admin_page.php">Home</a></li>
        		<li><a href="/rucas.co/transaction_list.php">Transaction List</a></li>
        		<li><a href="/rucas.co/stock_list.php">Product List</a></li>
        		<li><a href="/rucas.co/liat_stock.php">Product Stocks</a></li>
        		<li><a href="/rucas.co/my_account.php">Account</a></li>
      		</ul>

    </nav>
    <section class="wrapper" style="z-index: -999;">
        <div id="stars"></div>
        <div id="stars2"></div>
        <div id="stars3"></div>
        <div id="title">
            <span>WELCOME BACK, <?= $_SESSION['name']; ?></span>
            <br>
            <span>A dream does not become reality through magic; it takes sweat, determination, and hard work.</span>
        </div>
    </section>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>
</html>
