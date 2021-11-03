<?php

session_start();

require $_SERVER['DOCUMENT_ROOT']."/rucas.co/conn.php";

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $_POST['name'];
  $address = $_POST['address'];
  $phonenum = $_POST['phonenum'];
  $email = $_POST['email'];
  $date_of_birth = $_POST['date_of_birth'];


  $result = array(
    'status' => 0,
    'message' => ''
  );

  $check_query1 = "SELECT * FROM `customer` WHERE email = ?";
  $stmt = $pdo->prepare($check_query1);
  $stmt->execute([$email]);

  if ( $name == '' || $address == '' || $phonenum == '' || $email == '' || $date_of_birth == '') {
    $result['status'] = 0;
    $result['message'] = "You must fill all data";

  } else if (is_numeric($phonenum) == '') {
    $result['status'] = 0;
    $result['message'] = "Phone Number must be a number!";

  } else if ($stmt->rowCount() != 0) {

    $result['status'] = 0;
    $result['message'] = "Email already taken by customer";

  } else {

    $check_query = "SELECT * FROM `admin` WHERE email = ?";
    $stmt = $pdo->prepare($check_query);
    $stmt->execute([$email]);

    if ($stmt->rowCount() != 0) {
      $result['status'] = 0;
      $result['message'] = "Username or Email already taken by another admin";
    } else {

      $check_query = "SELECT * FROM `customer` WHERE email = ?";
      $stmt = $pdo->prepare($check_query);
      $stmt->execute([$email]);

      if ($stmt->rowCount() != 0) {
        $result['status'] = 0;
        $result['message'] = "Username or Email already taken by another customer";

      } else {
        $password = password_hash($date_of_birth, PASSWORD_DEFAULT);
        $query = "INSERT INTO `admin` VALUES (DEFAULT, ?, ?, ?, ?, ?, ?, 1)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([ $name, $address, $email, $date_of_birth, $phonenum, $password]);

        $query = "INSERT INTO `detail_edit_barang` VALUES (DEFAULT, ?, ?, NOW(), 'enroll new admin')";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id, $_SESSION['admin_id']]);

        $result['status'] = 1;
        $result['message'] = "You have successfuly make an account!";
      }


    }

  }
  echo json_encode($result);

} else {
  header("HTTP/1.1 400 Bad Request");
  $error = array(
    'error' => 'Method not Allowed'
  );

  echo json_encode($error);
}
