<?php
session_start();
if (!isset($_SESSION['name']) || $_SESSION['authorization'] == "Customer") {
  header("Location: shop.php");
}
?>

<html>
    <head>
        <title>Re-stock</title>

        <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">

        <link rel="stylesheet" href="/rucas.co/css/admin_nav.css">

    </head>
    <body>

      <nav style="z-index: 999; position: relative;">
        <input type="checkbox" id="check">
          <label for="check" class="checkbtn" style="margin-top: 20px;">
              <i class="fas fa-bars"></i>
            </label>
            <label class="logo">PETRADENIM ADMIN</label>
            <ul>
              <li><a href="/rucas.co/admin_page.php">Home</a></li>
              <li><a href="/rucas.co/transaction_list.php">Transaction List</a></li>
              <li><a href="/rucas.co/stock_list.php">Product List</a></li>
              <li><a class="active" href="/rucas.co/liat_stock.php">Product Stocks</a></li>
              <li><a href="/rucas.co/my_account.php">Account</a></li>
            </ul>
      </nav>

    <div class="container">
            <div class="row pt-4">

            </div>
            <div class="col-12 text-center">
                <h3 class="title text-center">Stock List</h3>
            </div>
            <div class="row pt-4">
                <div class="col-12">
                    <table class="table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                        <th width="10%" style ="text-align : center">No</th>
                        <th width="40%" style ="text-align : center">Nama Barang</th>
                        <th width="30%" style ="text-align : center">Quantity</th>
                        <th width="30%" style ="text-align : center">Re-stock</th>
                        </tr>
                    </thead>
                    <tbody id="tabel-stock">

                    </tbody>
                </table>
            </div>

            <!-- Edit Student Modal -->
            <div class="modal fade" id="edit-stock-modal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Barang</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="edit-id" name="id" value="">
                            <div class="form-group">
                                <label for="qty">Qty : </label>
                                <input type="text" id="edit-qty" name="qty" class="form-control" placeholder="Qty">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" id="edit-modal-button" class="btn btn-warning"><i class="lnr lnr-pencil"></i> Edit</button>
                        </div>
                    </div>
                </div>
            </div>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


        <script>

            function load_data() {
                $.ajax({
                    url: "/rucas.co/services/admin/get_qty_stock.php",
                    method: "GET",
                    success: function(data) {
                        var co = 1;
                        $("#tabel-stock").html('');
                        data.forEach(function(stock){
                            var row = $("<tr></tr>");
                            var col1 = $("<td style = 'text-align : center'>" + co + "</td>");
                            var col2 = $("<td style = 'text-align : center'>" + stock['nama'] + "</td>");
                            var col3 = $("<td style = 'text-align : center'>" + stock['qty'] + "</td>");
                            col1.appendTo(row);
                            col2.appendTo(row);
                            col3.appendTo(row);

                            // Tools
                            var tools = $("<td style = 'text-align : center'></td>");
                            var edit_btn = $('<button id="edit-stock-btn" class="btn btn-warning" data-id = ' + stock['id'] + '><i class="fas fa-edit"></i></button>');

                            edit_btn.data('id', stock['id']);
                            edit_btn.data('qty', stock['qty']);

                            edit_btn.appendTo(tools);
                            tools.append(" ");
                            tools.appendTo(row);

                            co++;
                            $("#tabel-stock").append(row);
                        });
                    },
                    error: function(data) {

                    }
                });
            }

            $(document).ready(function(){
                load_data();
            });

            $("#tabel-stock").on("click", "[id='edit-stock-btn']", function(){
                var id = $(this).data('id');
                var qty = $(this).data('qty');

                $("#edit-id").val(id);
                $("#edit-qty").val(qty);
                $("#edit-stock-modal").modal('toggle');
            });

            $("#edit-modal-button").click(function(){
                var id = $("#edit-id").val();
                var qty = $("#edit-qty").val();

                // alert(id);
                // alert(qty);

                $.ajax({
                    url: '/rucas.co/services/admin/edit_qty_barang.php',
                    method: 'POST',
                    data: {
                        id: id,
                        qty: qty
                    },
                    success: function(data) {
                        $("#edit-stock-modal").modal('toggle');
                        load_data();
                    },
                    error: function(request, status, error) {
                        console.log(request.responseText);
                        alert('error');
                    }
                });
            });


        </script>
    </body>
</html>
