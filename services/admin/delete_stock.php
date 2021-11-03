<?php

session_start();

require $_SERVER['DOCUMENT_ROOT']."/rucas.co/conn.php";

header("Content-Type: application/json");


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = $_POST['id'];

  $result = array(
    'status' => 1,
    'message' => ''
  );

  $query = "UPDATE `barang` SET status = 0 WHERE id = ?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([ $id]);

   $query = "UPDATE `detail_item_gudang` SET qty = -1 WHERE id_barang = ?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([ $id]);

  $query = "INSERT INTO `detail_edit_barang` VALUES (DEFAULT, ?, ?, NOW(), 'delete')";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$id, $_SESSION['admin_id']]);

  $result['status'] = 1;
  $result['message'] = "You have successfuly delete this data!";

  echo json_encode($result);

} else {

  header("HTTP/1.1 400 Bad Request");

  $error = array(
    'error' => 'Method not Allowed'
  );

  echo json_encode($error);

}
