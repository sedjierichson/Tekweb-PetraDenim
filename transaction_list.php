<?php

session_start();
if (!isset($_SESSION['name']) || $_SESSION['authorization'] == "Customer") {
  header("Location: shop.php");
}

?>

<html>
    <head>
        <title>Transaction List</title>

        <!-- Bootstrap -->
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <link rel="stylesheet" href="/rucas.co/css/admin_nav.css">

        <style media="screen">
          #status {
            cursor: pointer;
          }
        </style>

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
            		<li><a class="active" href="/rucas.co/transaction_list.php">Transaction List</a></li>
            		<li><a href="/rucas.co/stock_list.php">Product List</a></li>
            		<li><a href="/rucas.co/liat_stock.php">Product Stocks</a></li>
            		<li><a href="/rucas.co/my_account.php">Account</a></li>
          		</ul>
        </nav>

        <div class="container">
            <div class="row pt-4">
            </div>
            <div class="col-12">
                <h3 class="title" style = "text-align : center">Transaction</h3>
            </div>
            <div class="row pt-4">
                <div class="col-12">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="25%" style ="text-align : center">Nama Item</th>
                                <th width="25%" style ="text-align : center">Ukuran</th>
                                <th width="25%" style ="text-align : center">Nama Customer</th>
                                <th width="20%" style ="text-align : center">Qty</th>
                                <th width="20%" style ="text-align : center">Kurir</th>
                                <th width="25%" style ="text-align : center">Tanggal Transaksi</th>
                                <th width="25%" style ="text-align : center">Status</th>
                            </tr>
                        </thead>
                        <tbody id="user-content">

                        </tbody>
                    </table>

                    <!-- edit status modal -->
                    <div class="modal fade" id="edit-status-modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Transaction Status</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                              <input type="text" hidden id="shipping-id">
                                <div class="form-group">
                                    <label for="shipping" class="form-check-label">Sudah Dikirim: </label> &nbsp;
                                    <input type="checkbox" id="shipping" name="shipping">
                                </div>
                                <div class="form-group">
                                    <label for="complete-transaction" class="form-check-label">Sudah Selesai: </label> &nbsp;
                                    <input type="checkbox" id="complete-transaction" name="complete-transaction">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" id="edit-transaction" name="submit" class="btn btn-success"><i class="lnr lnr-plus-circle"></i> Edit </button>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <!-- JQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

        <script>
            function load_data() {
                $.ajax({
                    url: "/rucas.co/services/admin/get_all_transaksi.php",
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
                            var col2 = $("<td style = 'text-align : center'>" + penjualan['nama'] + "</td>");
                            var col3 = $("<td style = 'text-align : center'>" + penjualan['ukuran'] + "</td>");
                            var col4 = $("<td style = 'text-align : center'><a href='customer_details.php?id=" + penjualan['id_customer'] +"'>" + penjualan['nama_customer'] + "</a></td>");
                            var col5 = $("<td style = 'text-align : center'>" + penjualan['qty'] + "</td>");
                            var col6 = $("<td style = 'text-align : center'>" + penjualan['kurir'] + "</td>");
                            var col7 = $("<td style = 'text-align : center'>" + penjualan['hari_tanggal'] + "</td>");
                            var col8 = $("<td id='status' data-id='"+ penjualan['id_transaksi'] +"'>" + status + "</td>");
                            col1.appendTo(row);
                            col2.appendTo(row);
                            col3.appendTo(row);
                            col4.appendTo(row);
                            col5.appendTo(row);
                            col6.appendTo(row);
                            col7.appendTo(row);
                            col8.appendTo(row);

                            co++;
                            $("#user-content").append(row);
                        });
                    },
                    error: function(data) {

                    }
                });
            }

            $(document).ready(function(){
                load_data();

                $("#user-content").on("click", "[id='status']", function() {
                  var id = $(this).data("id");
                  $("#shipping-id").val(id);

                  $("#edit-status-modal").modal();

                  $.ajax({
                    url: '/rucas.co/services/admin/check_transaction_status.php',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                      id: id
                    },
                    success: function(data){
                      console.log(data.check1);
                      if (data.check1 != null) {
                        $("#shipping").prop('checked', true);
                        $("#shipping").prop('disabled', true);
                      }

                      if (data.check2 != 0) {
                        $("#complete-transaction").prop('checked', true);
                        $("#complete-transaction").prop('disabled', true);
                      }
                    },
                    error: function(request, status, error) {
                      console.log(request.responseText);
                      //toastr.error(request.responseText);
                    }

                  });
                });

                $("#edit-transaction").click(function() {
                  var id = $("#shipping-id").val();

                  if ($("#shipping").is(":Checked") == true && $('#shipping').prop('disabled') == false) {
                    $.ajax({
                      url: '/rucas.co/services/admin/update_transaction_status.php',
                      method: 'POST',
                      dataType: 'json',
                      data: {
                        id: id,
                        task1: true
                      },
                      success: function(data){
                        console.log(data.message);
                        $("#edit-status-modal").modal('toggle');
                      },
                      error: function(request, status, error) {
                        console.log(request.responseText);
                        //toastr.error(request.responseText);
                      }

                    });
                  }

                  if ($("#complete-transaction").is(":Checked") == true) {
                    $.ajax({
                      url: '/rucas.co/services/admin/update_transaction_status.php',
                      method: 'POST',
                      dataType: 'json',
                      data: {
                        id: id,
                        task2: true
                      },
                      success: function(data){
                        console.log(data.message);
                        $("#edit-status-modal").modal('toggle');
                        load_data();
                      },
                      error: function(request, status, error) {
                        console.log(request.responseText);
                        //toastr.error(request.responseText);
                      }

                    });
                  }
                });
            });

        </script>
    </body>
</html>
