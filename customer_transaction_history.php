<?php
session_start();
if (!isset($_SESSION['name'])) {
  header("Location: login.php");
  exit;
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/shopping-cart.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <!-- <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" integrity="sha512-1cK78a1o+ht2JcaW6g8OXYwqpev9+6GqOkz9xmBN9iUUhIndKtxwILGWYOSibOKjLsEdjyjZvYDq/cZwNeak0w==" crossorigin="anonymous" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/shopping-cart.css"> -->


    <title>TRANSACTION HISTORY - <?= $_SESSION['name']; ?> </title>

    <style media="screen">
      th, td {
        text-align: center;
      }
    </style>
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
          		<li><a href="/rucas.co/cart.php"><i class="fas fa-shopping-cart"></i></a></li>
        		</ul>
        		<div class="icon menu-btn">
          		<i class="fas fa-bars"></i>
        		</div>
      	</div>
    	</nav>

    <div class="container">
      <div class="title mb-4 text-center">
        <h3>Transaction History</h3>
      </div>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nama Barang</th>
            <th scope="col">Ukuran</th>
            <th scope="col">Qty</th>
            <th scope="col">Tanggal Transaksi</th>
            <th scope="col">Kurir</th>
            <th scope="col">Status Transaksi</th>
          </tr>
        </thead>
        <tbody id="user-content">

        </tbody>
      </table>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script type="text/javascript">

    function loadData() {
      $.ajax({
          url: "/rucas.co/services/customer/get_all_transaction_history_cust.php",
          method: "GET",
          success: function(data) {
              var co = 1;
              $("#user-content").html('');
              data.forEach(function(penjualan){
                var status = '';
                if (penjualan['status'] == '1') {
                  status = 'Transaksi selesai';
                } else {
                  status = 'Transaksi belum selesai';
                }

                  var row = $("<tr></tr>");
                  var col1 = $("<td>" + co + "</td>");
                  var col2 = $("<td style = 'text-align : center'> <a href='/rucas.co/product-detail.php?id=" + penjualan['id_barang'] +"'</a>" + penjualan['nama'] + "</td>");
                  var col3 = $("<td style = 'text-align : center'>" + penjualan['ukuran'] + "</td>");
                  var col5 = $("<td style = 'text-align : center'>" + penjualan['qty'] + "</td>");
                  var col6 = $("<td style = 'text-align : center'>" + penjualan['hari_tanggal'] + "</td>");
                  var col7 = $("<td style = 'text-align : center'>" + penjualan['kurir'] + "</td>");

                  var col8 = $("<td style = 'text-align : center'>" + status + "</td>");
                  col1.appendTo(row);
                  col2.appendTo(row);
                  col3.appendTo(row);
                  col5.appendTo(row);
                  col6.appendTo(row);
                  col7.appendTo(row);
                  col8.appendTo(row);

                  co++;
                  $("#user-content").append(row);
              });

              if (co == 1) {
                $("#user-content").append("<td colspan='7'>No transaction record.</td>")
              }
          },
          error: function(data) {

          }
      });
    }

    $(document).ready(function() {
      loadData();
    });

    </script>
  </body>
</html>
