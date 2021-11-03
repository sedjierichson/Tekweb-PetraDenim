<?php
session_start();
if (!isset($_SESSION['name'])) {
  header("Location: login.php");
  exit;
}

if($_SESSION['authorization'] == 'Admin') {
  header("Location: index.php");
  exit;
}

require $_SERVER['DOCUMENT_ROOT']."/rucas.co/conn.php";

$id = $_GET['id'];

$query = "SELECT barang.id, `nama`, `harga`, `ukuran`, `deskripsi`, `gambar_1`, `gambar_2`, `gambar_3`, `status`, `qty` FROM `barang` JOIN `detail_item_gudang` ON barang.id = detail_item_gudang.id_barang WHERE barang.id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$id]);

if ($stmt->rowCount() < 1) {
  header("Location: shop.php");
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
    <link rel="stylesheet" href="css/detail.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" integrity="sha512-1cK78a1o+ht2JcaW6g8OXYwqpev9+6GqOkz9xmBN9iUUhIndKtxwILGWYOSibOKjLsEdjyjZvYDq/cZwNeak0w==" crossorigin="anonymous"/>
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


  	<div class="outer">
  		<div class="center-wrapper">
    		<div class="container-fluid content">
      			<div class="row">
              <?php while($row = $stmt->fetch()) { ?>
        			<div class="col-12 col-sm-12 col-md-6 shoe-slider">
          				<div id="carousel" class="carousel slide" data-ride="carousel">
            				<ol class="carousel-indicators">
              					<li data-target="#carousel" data-slide-to="0" class="active"><img src="/rucas.co/services/admin/tmp/<?= $row['gambar_1']; ?>" class="d-block w-100" alt="img"></li>
              					<li data-target="#carousel" data-slide-to="1"><img src="/rucas.co/services/admin/tmp/<?= $row['gambar_2']; ?>" class="d-block w-100" alt="img"></li>
              					<li data-target="#carousel" data-slide-to="2"><img src="/rucas.co/services/admin/tmp/<?= $row['gambar_3']; ?>" class="d-block w-100" alt="img"></li>
            				</ol>
            				<div class="carousel-inner">
              					<div class="carousel-item active" data-interval="2000">
                					<img src="/rucas.co/services/admin/tmp/<?= $row['gambar_1']; ?>" class="d-block w-100" alt="img">
              					</div>
              					<div class="carousel-item" data-interval="2000">
                					<img src="/rucas.co/services/admin/tmp/<?= $row['gambar_2']; ?>" class="d-block w-100" alt="img">
              					</div>
             					<div class="carousel-item" data-interval="2000">
                					<img src="/rucas.co/services/admin/tmp/<?= $row['gambar_3']; ?>" class="d-block w-100" alt="img">
              					</div>
              					<a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
    								<i class="fa fa-chevron-left" style="color: black;"></i>
  								</a>
  								<a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
    								<i class="fa fa-chevron-right" style="color: black;"></i>
  								</a>
            				</div>
          				</div>
        			</div>
        			<div class="col-12 col-sm-12 col-md-6 shoe-content">
          				<div class="text1">
            				<span>MEN</span>
            				<span><?= $row['qty']; ?> STOCK AVAILABLE</span>
          				</div>
          				<div class="text2">Rp. <?= $row['harga']; ?></div>
						<div class="text3" style="text-transform:uppercase"><?= $row['nama']; ?></div>
						<div class="text4">DESCRIPTION</div>
          				<div class="text5"><?= $row['deskripsi']; ?></div>
          				<div class="text5">
          					<ul>Detailed Features</ul>
							<li>100% cotton</li>
							<li>Black</li>
							<li>Size for: <?= $row['ukuran']; ?> </li>
							<li>Model measurements: chest 86.5 cm/34 inches, height 186 cm/6 feet 1.5 inches </li>
							<li>Made in Italy </li>
          				</div>
          				<div class="btn-wrapper">
            				<span class="btn <?php if ($row['qty'] == 0){ echo 'disabled'; }?>" id="add-to-card-btn" data-id="<?= $_GET['id']; ?>" style="color: white;">Add to cart</span>
          				</div>
        			</div>
            <?php } ?>
      			</div>
    		</div>
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
  <script type="text/javascript" src="add-to-card.js"></script>
</body>
</html>
