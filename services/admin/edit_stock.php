<?php

session_start();

require $_SERVER['DOCUMENT_ROOT']."/rucas.co/conn.php";

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $id = $_POST['id'];
  $name = $_POST['name'];
  $price = $_POST['price'];
  $size = $_POST['size'];
  $desc = $_POST['desc'];

  $result = array(
    'status' => 1,
    'message' => ''
  );

  $query = "UPDATE `barang` SET nama = ?, harga = ?, ukuran = ?, deskripsi = ? WHERE id = ?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([ $name, $price, $size, $desc, $id]);

  $query = "INSERT INTO `detail_edit_barang` VALUES (DEFAULT, ?, ?, NOW(), 'edit')";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$id, $_SESSION['admin_id']]);

  $result['status'] = 1;
  $result['message'] = "You have successfuly update this data!";

  echo json_encode($result);

} else {

  header("HTTP/1.1 400 Bad Request");

  $error = array(
    'error' => 'Method not Allowed'
  );

  echo json_encode($error);

}
