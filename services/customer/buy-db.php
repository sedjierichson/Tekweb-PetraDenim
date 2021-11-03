<?php

session_start();

require $_SERVER['DOCUMENT_ROOT']."/rucas.co/conn.php";

use PHPMailer\PHPMailer\PHPMailer;


header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $kurir = $_POST['kurir'];

  $result = array(
    "status" => 1,
    "message" => ""
  );

  if (isset($_COOKIE["shopping_cart"])) {
    $cookie_data = stripslashes($_COOKIE['shopping_cart']);
    $cart_data = json_decode($cookie_data, true);

    //$item_id_list = array_column($cart_data, 'item_id');
    //$item_qty_list = array_column($cart_data, 'item_quantity');
    $item_name_list = array_column($cart_data, 'owner');

    if (in_array($_SESSION['name'], $item_name_list)) {

      //php mailer
      $name = $_SESSION['name'];

      $query1 = "SELECT * FROM customer WHERE id = ?";
      $stmt = $pdo->prepare($query1);
      $stmt->execute([$_SESSION['cust_id']]);
      $row = $stmt->fetch();

      $email = $row['email'];
      $subject = 'Rucas.co payment';

      $address = $row['alamat'];
      $address_new = explode(",", $address);

      $body = "

      <!DOCTYPE html>
      <html>
      <body style='background-color: white;font-family: Helvetica, Arial, sans-serif;'>

      		<div class='header' style='background-color: #ebebeb;width: 500px;margin: 40px auto 0;'>
            <h1 style='line-height: 80px;margin-left: 10px;font-weight: normal;font-size: 25px;'>RUCAS.CO</h1>
          </div>
          <div class='content' style='text-align: center;margin: 40px auto 0;width: 500px;'>
      			<div class='head-container' style='border: 1px solid black;overflow: auto;padding: 10px;box-sizing: border-box;'>
            	<div class='left-side' style='float: left;width: 50%;text-align: left;'>
             		<h3 class=''>Invoice #BBB10234</h3>
             		Date:" . date("M-d-Y") . "
             	</div>
            	<div class='right-side' style='float: left;width: 50%;text-align: left;'>
                	<div class='' style='font-weight: 700;'>TUJUAN PENGIRIMAN:</div>
                	<div class=''>$name</div>
                	<div>". $address_new[0]. "</div>
                	<div>". $address_new[1]. "</div>
                	<div>". $address_new[2]. "</div>
                	<div>". $row['no_telp']. "</div>
            	</div>
           	</div>
            <table style='margin-top: 20px;width: 100%;'>
            	<thead>
      					<tr style='height: 30px;'>
                 	<th class='center'>No</th>
                 	<th>Item</th>
                 	<th class='right'>Price</th>
                 	<th class='center'>Qty</th>
                 	<th class='right'>Subtotal</th>
               	</tr>
            	</thead>
      				<tbody>

      ";

      $query = "INSERT INTO `transaksi_penjualan` VALUES (NULL, NOW())";
      $stmt = $pdo->prepare($query);
      $stmt->execute();

      $query = "SELECT MAX(id) AS `id` FROM `transaksi_penjualan`";
      $stmt = $pdo->prepare($query);
      $stmt->execute();

      $row = $stmt->fetch();

      $query = "INSERT INTO `detail_transaksi_customer` VALUES (DEFAULT, ?, ?, 'BCA Virtual Account')";
      $stmt = $pdo->prepare($query);
      $stmt->execute([$_SESSION['cust_id'], $row['id'] ]);


      $co = 1;
      $total_item_price = 0;
      foreach ($cart_data as $keys => $values) {
        if($cart_data[$keys]["owner"] == $_SESSION['name']) {
          $query = "INSERT INTO `detail_jual_barang` VALUES (DEFAULT, ?, ?, ?, 0)";
          $stmt = $pdo->prepare($query);
          $stmt->execute([$cart_data[$keys]['item_id'],  $row['id'], $cart_data[$keys]['item_quantity'] ]);

          $item_name = $cart_data[$keys]['item_name'];
          $item_quantity = $cart_data[$keys]['item_quantity'];
          $item_price = $cart_data[$keys]['item_price'];
          $item_price_acc = $cart_data[$keys]['item_price_acc'];
          $total_item_price = $total_item_price + $item_price_acc;

          $body .= "
            <tr style='height: 30px;'>
              <td class='center'>$co</td>
              <td class='left strong'>$item_name</td>
              <td class='right' id='hargabarang'>Rp. $item_price</td>
              <td class='center' id='qtybelanja'>$item_quantity</td>
              <td class='right' id='subtotalbelanja'>Rp. $item_price_acc</td>
            </tr>
          ";

          $item_id = $cart_data[$keys]['item_id'];

          $select_current_qty_query = "SELECT qty FROM `detail_item_gudang` WHERE id_barang = ?";
          $stmt = $pdo->prepare($select_current_qty_query);
          $stmt->execute([$item_id]);

          $updated_qty =  $stmt->fetch()['qty'] - $item_quantity;

          $update_qty_query = "UPDATE `detail_item_gudang` SET qty = ? WHERE id_barang = ?";
          $stmt = $pdo->prepare($update_qty_query);
          $stmt->execute([$updated_qty, $item_id]);

          $co++;

        }

      }

      $query = "INSERT INTO `detail_kirim_kurir` VALUES (DEFAULT, ?, ?, NULL)";
      $stmt = $pdo->prepare($query);
      $stmt->execute([$row['id'], $kurir]);



      setcookie("shopping_cart", "", time() - 3600, '/rucas.co/cart.php');
      setcookie('shopping_cart', "", time() - 3600, '/rucas.co/services/customer/add-to-card.php');
      setcookie('shopping_cart', "", time() - 3600, '/rucas.co/services/customer/buy-db.php');

      $body .= "

            </tbody>
          </table>

          <div class='foot-container' style='border: 1px solid black;overflow: auto;padding: 10px;box-sizing: border-box; margin-top:40px;'>
            <h4 class='left-side' style='float: left;width: 50%;text-align: left;'>Total Belanja: </h4>
            <h4 class='right-side' style='text-align: right;float: left;width: 50%;'>Rp. $total_item_price</h4>
          </div>

        </div>
        <div class='footer' style='margin: 40px auto 0;width: 500px;background-color: #ebebeb;padding: 10px;box-sizing: border-box;'>
          <p style='color: black;margin: 0;padding: 0;'>Pesanan Anda sudah kami terima, <br> silakan transfer senilai Rp. $total_item_price ke salah satu bank dibawah ini.</p>
          <br>
          <p style = 'margin: 40px auto 0;width: 500px;background-color: #ebebeb;padding: 10px;box-sizing: border-box;'>No Rek : 7970283565</p>
              <p style = 'margin: 40px auto 0;width: 500px;background-color: #ebebeb;padding: 10px;box-sizing: border-box;'>Atas nama : Richson Sedjie</p>
          <small style='font-size: 12px;color: #999999;'>from</small>
          <small style='font-size: 12px;color: #999999;'>&#169; Rucas.co <a href='mailto: christianwillson1211gmail.com' style='color: #999999;text-decoration: none;'> Rucas clothing store, 1601 Willow Road, Menlo Park, CA 94025
            <br>
            This message was sent to <u class='email_address' style='color: #3c99ff;'>$email</u> </a> and intended for <br> $name. Have a question? <a href='#' style='color: #999999;text-decoration: none;'> <u>Ask here</u> </a>.
          </small>
        </div>

      </body>
      </html>
      ";

      require_once "PHPMailer/PHPMailer.php";
      require_once "PHPMailer/SMTP.php";
      require_once "PHPMailer/Exception.php";

      $mail = new PHPMailer();

      //SMTP Settings
      $mail->isSMTP();
      $mail->Host = "smtp.gmail.com";
      $mail->SMTPAuth = true;
      $mail->Username = "christianwillson1211@gmail.com";
      $mail->Password = '';
      $mail->Port = 465; //587
      $mail->SMTPSecure = "ssl"; //tls

      //Email Settings
      $mail->isHTML(true);
      $mail->setFrom("christianwillson1211@gmai.com", "Rucas.co");
      $mail->addAddress($email);
      $mail->Subject = $subject;
      $mail->Body = $body;

      if ($mail->send()) {
          $result['status'] = 1;
          //$result['message'] = "Email is sent!";
      } else {
          $result['status'] = 0;
          $result['message'] = "Something is wrong: <br><br>" . $mail->ErrorInfo;
      }

    } else {
      $result['status'] = 0;
      $result['message'] = "error!";
    }
  }

  echo json_encode($result);

} else {
  header("HTTP/1.1 400 Bad Request");

  $error = array('error' => 'Method not allowed');

  echo json_encode($error);
}
