function loadData() {
  $.ajax({
    url: '/rucas.co/services/customer/get_all_stocks_cust.php',
    method: 'GET',
    success: function(data) {
      data.forEach(function(stock) {
        var disabled = "";
        if (stock['qty'] == 0) {
          disabled = "disabled";
        }
        $("#table-of-content").append("<div class='col-md-4 product-grid'> <div class='image'> <a class='view-detail' href='product-detail.php?id="+ stock['id'] +"'> <img src='services/admin/tmp/"+ stock['gambar_1'] +"' class='w-100'> <div class='overlay'> <div class='detail'>View Details</div> </div> </a> </div> <h5 class='text-center'>"+ stock['nama'] +"</h5> <h5 class='text-center'>Rp. "+ stock['harga'] +"</h5> <button class='btn buy "+ disabled +"' data-id='"+ stock['id']+ "'>BUY</button></div>");
      });

    },
    error: function(request, status, error) {
      $("#messages").append("<div class='alert alert danger' role='alert'>"+ request.responseText +"</div>");
    }
  });
}

$(document).ready(function() {
  loadData();

  //console.log('ok');

  $("#table-of-content").click(function(e) {
    //e.preventDefault();
    e.stopPropagation();
    if (e.target.classList.contains('buy') == true && !(e.target.classList.contains('disabled'))) {
      var id = e.target.getAttribute("data-id");
      var qty = -1;
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
          //console.log(data.message);
          if (data.status == 0) {
            toastr.warning(data.message);
          } else {
            toastr.success('You have successfuly put it in shopping cart.');
          }

        },
        error: function(request, status, error) {
          console.log(request.responseText);
          toastr.error(request.responseText);
        }

      });

    } else if (e.target.classList.contains('disabled') == true) {
      toastr.warning('This item is currently unavailable');
    }
  });

  $("#search-bar").on("keyup", function() {
    var x = $("#search-bar").val().replace(/\s/g,"%20");
    $("#table-of-content").load('/rucas.co/services/customer/ajax-stocks-search.php?keyword=' + x);
  });

});
