function loadData() {
  $.ajax({
    url: '/rucas.co/services/admin/get_all_stocks.php',
    method: 'GET',
    success: function(data) {
      $("#stocks-data").html('');
      var co = 1;
      data.forEach(function(stock) {

          $("#stocks-data").append("<tr> <th hidden> "+ stock['id'] +" </th> <th scope='row'>"+ co +"</th> <th>"+ stock['nama'] +"</th> <td>"+ stock['harga']+ "</td> <td>"+ stock['ukuran'] +"</td> <td>"+ stock['deskripsi'] +"</td> <td><img src='services/admin/tmp/"+ stock['gambar_1'] +"'> <td> <button type='button' class='btn btn-warning' id='edit-btn' data-id="+stock['id']+" data-name='" + stock['nama'] + "' data-price=" + stock['harga'] + " data-size='" + stock['ukuran'] + "' data-desc='" + stock['deskripsi'] + "'><i class='lnr lnr-pencil'> </i></button> <button type='button' class='btn btn-danger delete-btn'><i class='lnr lnr-trash'> </i></button></td> </tr>");

        co++;
      });

    },
    error: function(request, status, error) {
      $("#messages").append("<div class='alert alert danger' role='alert'>"+ request.responseText +"</div>");
    }
  });
}

$(document).ready(function() {
  loadData();


  $("#add-form").on('submit', function(e){

      e.preventDefault();
      $.ajax({
          type: 'POST',
          url: '/rucas.co/services/admin/add_stock.php',
          data: new FormData(this),
          dataType: 'json',
          contentType: false,
          cache: false,
          processData:false,
          async: false,
          beforeSend: function(){
            $('.submit-btn').attr("disabled","disabled");
            $('#add-form').css("opacity",".5");
          },
          success: function(data){

            $('#messages').html('');

            if(data.status == 1){

                $('#add-form')[0].reset();
                $('#messages').html('<p class="alert alert-success">'+data.message+'</p>');

            } else {
                $('#messages').html('<p class="alert alert-danger">'+data.message+'</p>');
            }

            $('#add-form').css("opacity","");
            $(".submit-btn").removeAttr("disabled");

            $("#modal-add").modal("toggle");
            loadData();
          },
          error: function(request, status, error) {
            $("#messages").html("<div class='alert alert-danger' role='alert'>"+ request.responseText +"</div>");

            $('#add-form').css("opacity","");
            $(".submit-btn").removeAttr("disabled");

            $("#modal-add").modal("toggle");
            loadData();
          }
      });
    });

    // File type validation
    var match = ['image/jpeg', 'image/png', 'image/jpg'];
    $("#file-attachment").change(function() {
        for(i=0;i<this.files.length;i++){
            var file = this.files[i];
            var fileType = file.type;

            if(!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) || (fileType == match[3]) || (fileType == match[4]) || (fileType == match[5]))){
                alert('Sorry, only JPG, JPEG, and PNG files are allowed to upload.');
                $("#file-attachment").val('');
                return false;
            }
        }
    });

  $("#add-btn").click(function() {
    $("#modal-add").modal();
  });

  // $("#add-modal-btn").click(function() {
  //   var name = $("#modal-add #product-name").val();
  //   var price = $("#modal-add #product-price").val();
  //   var size = $("#modal-add #product-size").val();
  //   var desc = $("#modal-add #product-desc").val();
  //
  //   $.ajax({
  //     url: '/rucas.co/services/admin/add_stock.php',
  //     method: 'POST',
  //     data: {
  //       name: name,
  //       price: price,
  //       size: size,
  //       desc: desc
  //     },
  //     success: function(data){
  //       $("#modal-add").modal("toggle");
  //       loadData();
  //     },
  //     error: function(request, status, error) {
  //       $("#messages").append("<div class='alert alert danger' role='alert'>"+ request.responseText +"</div>");
  //     }
  //   });
  // });

  $("#stocks-data-table").click(function(e) {
    //console.log(e.target.className.split(" ")[1]);
    if (e.target.className.split(" ")[2] == 'delete-btn' || e.target.className.split(" ")[1] == 'lnr-trash') {

      if (e.target.className.split(" ")[2] == 'delete-btn') {
        var id = e.target.parentElement.parentElement.children[0].innerText;
      } else {
        var id = e.target.parentElement.parentElement.parentElement.children[0].innerText;
      }



      $.confirm({
          title: 'Confirm!',
          content: 'Jangan delete akuuuuu!',
          buttons: {
              confirm: {
                  text: 'Confirm',
                  btnClass: 'btn-success',
                  keys: ['enter'],
                  action: function(){
                    $.ajax({
                      url: '/rucas.co/services/admin/delete_stock.php',
                      method: 'POST',
                      data: {
                        id: id
                      },
                      async: false,
                      success: function(data) {
                        if (data.status == 1) {
                          $("#messages").html("<div class='alert alert-success' role='alert'>"+ data.message +"</div>");
                        }

                        loadData();
                      },
                      error: function(request, status, error) {
                        $("#messages").html("<div class='alert alert-danger' role='alert'>"+ request.responseText +"</div>");
                      }

                    });
                  }
              },
              cancel: {
                  text: 'Cancel',
                  btnClass: 'btn-secondary',
                  keys: ['shift'],
                  action: function(){

                  }
              }
          }
      });
    }
  });

  $('#stocks-data-table').on("click", "[id = 'edit-btn']", function(){
    var id = $(this).data('id');
    var name = $(this).data('name');
    var price = $(this).data('price');
    var size = $(this).data('size');
    var desc = $(this).data('desc');

    $("#modal-edit #product-id").val(id);
    $("#modal-edit #product-name").val(name);
    $("#modal-edit #product-price").val(price);
    $("#modal-edit #product-size").val(size);
    $("#modal-edit #product-desc").val(desc);

    $("#modal-edit").modal();
  });

  $('#edit-modal-btn').click(function() {
    var id = $("#modal-edit #product-id").val();
    var name = $("#modal-edit #product-name").val();
    var price = $("#modal-edit #product-price").val();
    var size = $("#modal-edit #product-size").val();
    var desc = $("#modal-edit #product-desc").val();

    $.ajax({
      url: '/rucas.co/services/admin/edit_stock.php',
      method: 'POST',
      data: {
        id: id,
        name: name,
        price: price,
        size: size,
        desc: desc
      },
      success: function(data){
        $("#modal-edit").modal("toggle");
        loadData();
      },
      error: function(request, status, error) {
        $("#messages").html("<div class='alert alert danger' role='alert'>"+ request.responseText +"</div>");
      }

    });


  });

});
