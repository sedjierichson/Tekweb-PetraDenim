<?php

use PHPMailer\PHPMailer\PHPMailer;

$name = 'Christian Willson';
$email = 'christianwillson11@yahoo.com';

if ($name != '' && $email != '') {

    $subject = 'PETRADENIM.co payment';
    $body = "

    <!DOCTYPE html>
    <html>
    <body style='background-color: white;font-family: Helvetica, Arial, sans-serif;'>

    		<div class='header' style='background-color: #ebebeb;width: 500px;margin: 40px auto 0;'>
          <h1 style='line-height: 80px;margin-left: 10px;font-weight: normal;font-size: 25px;'>PETRADENIM.CO.CO</h1>
        </div>
        <div class='content' style='text-align: center;margin: 40px auto 0;width: 500px;'>
    			<div class='head-container' style='border: 1px solid black;overflow: auto;padding: 10px;box-sizing: border-box;'>
          	<div class='left-side' style='float: left;width: 50%;text-align: left;'>
           		<h3 class=''>Invoice #BBB10234</h3>
           		Date: 12 Jun,2019
           	</div>
          	<div class='right-side' style='float: left;width: 50%;text-align: left;'>
              	<div class='' style='font-weight: 700;'>TUJUAN PENGIRIMAN:</div>
              	<div class=''>Richson Sedjie	</div>
              	<div>Jalan Tupai Nomor 78</div>
              	<div>Mamajang Kota Makassar 90135</div>
              	<div>Sulawesi Selatan</div>
              	<div>0812 4322 4432</div>
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
    					<tr style='height: 30px;'>
               	<td class='center'>1</td>
               	<td class='left strong'>Iphone 10X</td>
               	<td class='right' id='hargabarang'>1500</td>
               	<td class='center' id='qtybelanja'>2</td>
               	<td class='right' id='subtotalbelanja'>Rp. 200.000,-</td>
             	</tr>
    					<tr style='height: 30px;'>
               	<td class='center'>2</td>
               	<td class='left strong'>Iphone 10X</td>
               	<td class='right' id='hargabarang'>1500</td>
               	<td class='center' id='qtybelanja'>2</td>
               	<td class='right' id='subtotalbelanja'>Rp. 200.000,-</td>
             	</tr>
    				</tbody>
          </table>

    			<div class='foot-container' style='border: 1px solid black;overflow: auto;padding: 10px;box-sizing: border-box; margin-top:40px;'>
    				<h4 class='left-side' style='float: left;width: 50%;text-align: left;'>Total Belanja: </h4>
    				<h4 class='right-side' style='text-align: right;float: left;width: 50%;'>Rp. 400.000,-</h4>
    			</div>

        </div>
        <div class='footer' style='margin: 40px auto 0;width: 500px;background-color: #ebebeb;padding: 10px;box-sizing: border-box;'>
    			<p style='color: black;margin: 0;padding: 0;'>Pesanan Anda sudah kami terima, <br> silakan transfer senilai Rp. 400.000 ke salah satu bank dibawah ini.</p>
    			<br>
          <small style='font-size: 12px;color: #999999;'>from</small>
          <small style='font-size: 12px;color: #999999;'>&#169; PETRADENIM.CO <a href='mailto: christianwillson11@yahoo.com' style='color: #999999;text-decoration: none;'> PETRADENIM clothing store, 1601 Willow Road, Menlo Park, CA 94025
            <br>
            This message was sent to <u class='email_address' style='color: #3c99ff;'>johnappleseed@gmail.com</u> </a> and intended for <br> John Appleseed. Have a question? <a href='#' style='color: #999999;text-decoration: none;'> <u>Ask here</u> </a>.
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
    $mail->Password = 'scale92?tabards';
    $mail->Port = 465; //587
    $mail->SMTPSecure = "ssl"; //tls

    //Email Settings
    $mail->isHTML(true);
    $mail->setFrom("christianwillson1211@gmai.com", "PETRADENIM.CO");
    $mail->addAddress($email);
    $mail->Subject = $subject;
    $mail->Body = $body;

    if ($mail->send()) {
        $status = "success";
        $response = "Email is sent!";
        echo $response;
    } else {
        $status = "failed";
        $response = "Something is wrong: <br><br>" . $mail->ErrorInfo;
        echo $response;
    }

    //exit(json_encode(array("status" => $status, "response" => $response)));
}


?>
