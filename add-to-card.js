$(document).ready(function() {
  $("#add-to-card-btn").click(function() {
    if ($(this).hasClass('disabled') == true) {
      toastr.warning('This item is currently unavailable');
    } else {
      var id = $(this).data("id");
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
          if (data.status == 0) {
            toastr.warning(data.message);
          } else {
            toastr.success('You have successfuly put it in shopping cart.');
          }
        },
        error: function(request, status, error) {
          console.log(request.responseText);
          $("#messages").html("<div class='alert alert-danger' role='alert'>"+ request.responseText +"</div>");
        }
      });
    }
  });
});
