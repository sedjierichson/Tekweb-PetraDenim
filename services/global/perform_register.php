<?php

require $_SERVER['DOCUMENT_ROOT']."/rucas.co/conn.php";

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $_POST['name'];
  $address = $_POST['address'];
  $phonenum = $_POST['phonenum'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  $result = array(
    'status' => 0,
    'message' => ''
  );

  $check_query1 = "SELECT * FROM `customer` WHERE nama = ? OR email = ?";
  $stmt = $pdo->prepare($check_query1);
  $stmt->execute([$name, $email]);

  if ( $name == '' || $address == '' || $phonenum == '' || $email == '' || $password == '') {
    $result['status'] = 0;
    $result['message'] = "You must enter all data";

  } else if (is_numeric($phonenum) == '') {
    $result['status'] = 0;
    $result['message'] = "Phone Number must be a number!";

  } else if ($stmt->rowCount() != 0) {

    $result['status'] = 0;
    $result['message'] = "Username or Email already taken";

  } else {

    $check_query2 = "SELECT * FROM `admin` WHERE nama = ? OR email = ?";
    $stmt = $pdo->prepare($check_query2);
    $stmt->execute([$name, $email]);

    if ($stmt->rowCount() != 0) {
      $result['status'] = 0;
      $result['message'] = "Username or Email already taken";
    } else {
      $password = password_hash($password, PASSWORD_DEFAULT);
      $query = "INSERT INTO `customer` VALUES (DEFAULT, ?, ?, ?, ?, ?)";
      $stmt = $pdo->prepare($query);
      $stmt->execute([ $name, $address, $phonenum, $email, $password]);
      $result['status'] = 1;
      $result['message'] = "You have successfuly make an account!";
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
