<?php

include $_SERVER['DOCUMENT_ROOT']."/rucas.co/conn.php";

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == "GET") {
  $query = "SELECT barang.id, `nama`, `harga`, `ukuran`, `deskripsi`, `gambar_1`, `gambar_2`, `gambar_3`, `status`, `qty` FROM `barang` JOIN `detail_item_gudang` ON barang.id = detail_item_gudang.id_barang WHERE status = 1 ORDER BY barang.id ASC";
  $stmt = $pdo->prepare($query);
  $stmt->execute();

  $result = array();
  while ($row = $stmt->fetch()) {
    array_push($result, $row);
  }

  echo json_encode($result);
} else {
  header("HTTP/1.1 400 Bad Request");
  $error = array('error' => 'Method not allowed');

  echo json_encode($error);
}
