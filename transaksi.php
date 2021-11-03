<?php

session_start();
if (!isset($_SESSION['name']) || $_SESSION['authorization'] == "Customer") {
  header("Location: shop.php");
}

?>

<html>
    <head>
        <title>Database</title>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    </head>
    <body>

        <div class="container">
            <div class="row pt-4">
                <div class="col-12">
                    <h3 class="title" style = "text-align : center">Transaction</h3>
                </div>
                <!-- <div class="col-6">
                    <div class="text-right">
                        <button id="add-user-btn" class="btn btn-success"><i class="lnr lnr-plus-circle"></i> Add Student</button>
                    </div>
                </div> -->
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
                </div>
            </div>
        </div>

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
                            var col4 = $("<td style = 'text-align : center'>" + penjualan['nama_customer'] + "</td>");
                            var col5 = $("<td style = 'text-align : center'>" + penjualan['qty'] + "</td>");
                            var col6 = $("<td style = 'text-align : center'>" + penjualan['kurir'] + "</td>");
                            var col7 = $("<td style = 'text-align : center'>" + penjualan['hari_tanggal'] + "</td>");
                            var col8 = $("<td style = 'text-align : center'>" + status + "</td>");
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
            });

        </script>

        <!-- JQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    </body>
</html>
