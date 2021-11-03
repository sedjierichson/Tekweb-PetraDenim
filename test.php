<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <table>
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Product</th>
            <th scope="col">Price</th>
            <th scope="col">qty</th>
            <th scope="col">Subtotal</th>
        </tr>
    </thead>
    <tbody id="table-content">
        <tr>
            <th scope="row" id="co">1</th>
            <td>sss></td>
            <td>ddd</td>
            <td class="qty-btn"><input class="x"> QTY></td>
            <td class="item-price-acc">12</td>
        </tr>

        <tr>
            <th scope="row" id="co">1</th>
            <td>sss></td>
            <td>ddd</td>
            <td class="qty-btn"><input class="x"> QTY></td>
            <td class="item-price-acc">12</td>
        </tr>

    </tbody>
    </table>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $('.x').click(function() {
          console.log($(this).html());
          $(this).parent().next().html("abcccc");
        });
      });
    </script>
  </body>
</html>
