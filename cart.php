<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']."/rucas.co/conn.php";

if (isset($_COOKIE['shopping_cart'])) {
	$cookie_data = stripslashes($_COOKIE['shopping_cart']);
  $cart_data = json_decode($cookie_data, true);
}

if (!isset($_SESSION['name'])) {
	header("Location: login.php");
	exit;
}

if($_SESSION['authorization'] == 'Admin') {
  header("Location: index.php");
  exit;
}

$query = "SELECT * FROM kurir";
$stmt = $pdo->prepare($query);
$stmt->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Cart - PETRA DENIM</title>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/png" href="image/icon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/shopping-cart.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" integrity="sha512-1cK78a1o+ht2JcaW6g8OXYwqpev9+6GqOkz9xmBN9iUUhIndKtxwILGWYOSibOKjLsEdjyjZvYDq/cZwNeak0w==" crossorigin="anonymous" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
		<style media="screen">
			a {
				color: black;
				text-decoration: none;
			}
		</style>
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

    <div class="container">
        <h2 class="text-center">SHOPPING CART</h2>

				<div class="message"></div>

        <div class="table-responsive justify-content-center pt-5">
            <table class="table table-hover col-12">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product</th>
                        <th scope="col">Price</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Subtotal</th>
												<th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="table-content">
									<?php $co = 1; ?>
									<?php if (isset($_COOKIE['shopping_cart'])): ?>
										<?php  foreach($cart_data as $keys => $values) : ?>
											<?php if ($values['owner'] == $_SESSION['name']): ?>
		                    <tr>
		                        <th scope="row" id="co"><?= $co; ?></th>
		                        <td><?= $values['item_name'];?></td>
		                        <td><?= $values['item_price']; ?></td>
		                        <td class="tdtd"><input data-id="<?php echo $values['item_id']; ?>" class="col-sm-3 qty-increase-decrease" type="number" min = 0 style="border: none;" value="<?= $values['item_quantity']; ?>"></td>
		                        <td class="item-price-acc"><?= $values['item_price_acc'];  ?></td>
														<td> <a href="#" class="remove-item" data-id="<?php echo $values['item_id']; ?>"> Remove item </a> </td>
		                    </tr>
												<?php $co++; ?>
											<?php endif; ?>
										<?php endforeach; ?>
									<?php endif; ?>
                </tbody>
								<tr>
									<td colspan='4'>Total: </td>
									<th id="total">0</th>
								</tr>

            </table>

						<div class="form-inline my-3">
								<label for="input-kurir" class="mr-3">Kurir: </label>
								<select id="input-kurir" class="form-control col-5">
									<option selected value="0">Choose...</option>
									<?php while($row = $stmt->fetch()) { ?>
						        <option value="<?php echo $row['id']; ?>"><?php echo $row['nama']; ?></option>
									<?php } ?>
								</select>
						</div>

            <a href="shop.php">
                <button type="button" class="btn btn-light mr-5">Continue shopping</button>
            </a>
            <button type="button" id="checkout" class="btn btn-dark">Checkout</button>

        </div>
    </div>


	<footer class="page-footer">
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
	<script>
  		AOS.init();
	</script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
		$(document).ready(function() {

			updateTotal();
        $('#checkout').click(function(){
					if ($("#co").length == false) {
						alert("You have to select item first");

					} else if ($("#input-kurir").val() == "0") {

						alert("You have to select courier first");

					} else {
						var kurir = $("#input-kurir").val();
						var co = $("#co").html();

						swal({
                title: "Are you sure want to checkout?",
                text: "Make sure your product list again!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    swal("Poof! Your imaginary file has been deleted!", {
                        title: "THANK YOU FRIEND!",
                        text: "Please wait... Redirecting to payment page...",
                        icon: "success",
												buttons: false,
                    });
										$.ajax({
											url: '/rucas.co/services/customer/buy-db.php',
											method: 'POST',
											dataType: 'json',
											data: {
												kurir: kurir
											},
											success: function(data){
												console.log(data.message);
												window.location.replace("http://127.0.0.1/rucas.co/thanks.php");
											},
											error: function(request, status, error) {
												console.log(request.responseText);
												$("#messages").html("<div class='alert alert-danger' role='alert'>"+ request.responseText +"</div>");
											}
										});
                }
            });

					}

        });

				$(".remove-item").click(function(e) {
					e.preventDefault();
					var id = $(this).data("id");
					var parent = $(this).parent().parent();
					var minus = parseInt($(this).parent().prev().html());
					var total = parseInt($("#total").html());

					total = total - minus;
					$("#total").html(total);

					$.ajax({
						url: '/rucas.co/services/customer/add-to-card.php',
			      method: 'POST',
			      dataType: 'json',
			      data: {
							id: id,
							qty: 0,
							action: 'delete'
			      },
			      success: function(data){
							parent.html('');
			      },
			      error: function(request, status, error) {
			        console.log(request.responseText);
			        $("#messages").html("<div class='alert alert-danger' role='alert'>"+ request.responseText +"</div>");
			      }
					});
				});

				$(".qty-increase-decrease").change(function() {
					var id = $(this).data("id");
					var qty = $(this).val();
					var change = $(this).parent().next();

					var qty_back = $(this);

					$.ajax({
						url: '/rucas.co/services/customer/add-to-card.php',
			      method: 'POST',
			      dataType: 'json',
			      data: {
							id: id,
							qty: qty,
							action: 'add'
			      },
			      success: function(data){
							if (data.status == 1) {
								change.html(data.message);
							} else {
								alert('Stock is already empty!');
								qty_back.val(data.message);
							}
			      },
			      error: function(request, status, error) {
			        console.log(request.responseText);
			        $("#messages").html("<div class='alert alert-danger' role='alert'>"+ request.responseText +"</div>");
			      }
					});


					setTimeout(updateTotal, 100);

				});

				function updateTotal() {
					var total = 0;
					$('.item-price-acc').each(function(item){
						total = total + parseInt($(this).html());
					});
					$('#total').html(total);
				}

			});
    </script>
</body>
</html>
