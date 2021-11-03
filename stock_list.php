<?php
session_start();
if (!isset($_SESSION['name']) || $_SESSION['authorization'] == "Customer") {
  header("Location: shop.php");
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/jquery-confirm/jquery-confirm.css">
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="/rucas.co/css/admin_nav.css">

    <style media="screen">
      img {
        width: 60px;
      }
    </style>

    <title>Stock</title>
  </head>
  <body>

    <nav style="z-index: 999; position: relative;">
    	<input type="checkbox" id="check">
    		<label for="check" class="checkbtn">
        		<i class="fas fa-bars"></i>
      		</label>
      		<label class="logo">PETRADENIM ADMIN</label>
      		<ul>
        		<li><a href="/rucas.co/admin_page.php">Home</a></li>
        		<li><a href="/rucas.co/transaction_list.php">Transaction List</a></li>
        		<li><a class="active" href="/rucas.co/stock_list.php">Product List</a></li>
        		<li><a href="/rucas.co/liat_stock.php">Product Stocks</a></li>
        		<li><a href="/rucas.co/my_account.php">Account</a></li>
      		</ul>
    </nav>

    <div class="container mt-5">
      <div id="messages"> </div>

      <button class="btn btn-success mb-2" id="add-btn"> <i class="lnr lnr-plus-circle"></i> &nbsp; Add</button>

      <table class="table" id="stocks-data-table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Size</th>
            <th scope="col">Description</th>
            <th scope="col">Image(s)</th>
            <th scope="col">Tools</th>
          </tr>
        </thead>
        <tbody id="stocks-data">

        </tbody>
      </table>
    </div>


    <!-- MODAL ADD FROM HERE -->
    <div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add Stock Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form id="add-form" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="form-group" hidden>
                <input type="text" class="form-control" id="product-id" name="id">
              </div>

              <div class="form-group">
                <label for="product-name" class="col-form-label">Product Name:</label>
                <input type="text" class="form-control" id="product-name" name="name">
              </div>

              <div class="form-group">
                <label for="product-price" class="col-form-label">Price:</label>
                <input type="number" class="form-control" id="product-price" name="price">
              </div>

              <div class="form-group">
                <label for="product-size" class="col-form-label">Product Size:</label>
                <input type="text" class="form-control" id="product-size" name="size">
              </div>

              <div class="form-group">
                <label for="product-desc" class="col-form-label">Description:</label>
                <textarea class="form-control" id="product-desc" name="desc"></textarea>
              </div>

              <div class="form-group">
                <label for="file">Files</label>
                <input type="file" class="form-control" id="file-attachment" name="files[]" multiple />
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button type="submit" name="submit" class="btn btn-primary submit-btn" id="add-modal-btn">Add</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- MODAL ADD UNTIL HERE -->

    <!-- MODAL EDIT FROM HERE -->
    <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Stock Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>

              <div class="form-group" hidden>
                <input type="text" class="form-control" id="product-id">
              </div>

              <div class="form-group">
                <label for="product-name" class="col-form-label">Product Name:</label>
                <input type="text" class="form-control" id="product-name">
              </div>

              <div class="form-group">
                <label for="product-price" class="col-form-label">Price:</label>
                <input type="number" class="form-control" id="product-price">
              </div>

              <div class="form-group">
                <label for="product-size" class="col-form-label">Product Size:</label>
                <input type="text" class="form-control" id="product-size">
              </div>

              <div class="form-group">
                <label for="product-desc" class="col-form-label">Description:</label>
                <textarea class="form-control" id="product-desc"></textarea>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" id="edit-modal-btn">Edit</button>
          </div>
        </div>
      </div>
    </div>
    <!-- MODAL EDIT UNTIL HERE -->


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://cdn.linearicons.com/free/1.0.0/svgembedder.min.js"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->

    <script src="assets/jquery-confirm/jquery-confirm.js"></script>

    <script src="script.js"> </script>
  </body>
</html>
