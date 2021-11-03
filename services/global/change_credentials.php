<?php
session_start();

include $_SERVER['DOCUMENT_ROOT']."/rucas.co/conn.php";

header("Content-Type: application/json");


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $result = array(
    "status" => 0,
    "message" => "Failed"
  );

  if ($_SESSION['authorization'] == "Admin") {
    $id = $_SESSION['admin_id'];
  } else {
    $id = $_SESSION['cust_id'];
  }

  $name = $_POST['name'];
  $email = $_POST['email'];
  $address = $_POST['address'];
  $phonenum = $_POST['phonenum'];
  $password = $_POST['password'];
  $date_of_birth = $_POST['date_of_birth'];

  $check_query1 = "SELECT * FROM `customer` WHERE (nama = ? OR email = ?) AND id <> ?";
  $stmt = $pdo->prepare($check_query1);
  $stmt->execute([$name, $email, $id]);

  if ($stmt->rowCount() != 0) {
    $result['status'] = 0;
    $result['message'] = "Username or Email already taken";
  } else {
    $check_query2 = "SELECT * FROM `admin` WHERE (nama = ? OR email = ?) AND id <> ?";
    $stmt = $pdo->prepare($check_query2);
    $stmt->execute([$name, $email, $id]);

    if ($stmt->rowCount() != 0) {
      $result['status'] = 0;
      $result['message'] = "Username or Email already taken";
    } else {
      if ($_POST['authorization'] == "Customer") {

        if ($password == "") {
          $sql = "UPDATE `customer` SET nama = ?, email = ?, alamat = ?, no_telp = ? WHERE id = ?";
          $stmt = $pdo->prepare($sql);
          $stmt->execute([$name, $email, $address, $phonenum, $id]);
          $result['status'] = 1;
          $result['message'] = "Success";
        } else {

          $check_query1 = "SELECT `password`, `tanggal_lahir` FROM `customer` WHERE id = ?";
          $stmt = $pdo->prepare($check_query1);
          $stmt->execute([$id]);

          if (password_verify($password, $stmt->fetch()['password']) || password_verify($password, $stmt->fetch()['tanggal_lahir'])) {
            $result['status'] = 0;
            $result['message'] = "You can't use same password as before.";
          } else {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE `customer` SET nama = ?, email = ?, alamat = ?, no_telp = ?, password = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$name, $email, $address, $phonenum, $password, $id]);
            $result['status'] = 1;
            $result['message'] = "Success";
          }

        }

      } else if ($_POST['authorization'] == "Admin") {

        if ($password == "") {
          $sql = "UPDATE `admin` SET nama = ?, email = ?, alamat = ?, tanggal_lahir = ?, no_telp = ? WHERE id = ?";
          $stmt = $pdo->prepare($sql);
          $stmt->execute([$name, $email, $address, $date_of_birth, $phonenum, $_SESSION['admin_id']]);
          $result['status'] = 1;
          $result['message'] = "Success";
        } else {

          $check_query2 = "SELECT `password` FROM `admin` WHERE id = ?";
          $stmt = $pdo->prepare($check_query2);
          $stmt->execute([$id]);

          if (password_verify($password, $stmt->fetch()['password'])) {
            $result['status'] = 0;
            $result['message'] = "You can't use same password as before.";
          } else {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE `admin` SET nama = ?, email = ?, alamat = ?, tanggal_lahir = ?, no_telp = ?, password = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$name, $email, $address, $date_of_birth, $phonenum, $password, $_SESSION['admin_id']]);
            $result['status'] = 1;
            $result['message'] = "Success";
          }
        }

      }

      $_SESSION['name'] = $name;

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
