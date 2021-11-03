<?php

include $_SERVER['DOCUMENT_ROOT']."/rucas.co/conn.php";

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = $_POST['id'];


  $result = array(
    'status' => 0,
    'message' => ''
  );

  if (isset($_POST['task1'])) {

    $query = "UPDATE `detail_kirim_kurir` SET hari_tanggal = NOW() WHERE id_transaksi_penjualan = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);

    $result['status'] = 1;
    $result['message'] = "Data successfuly updated on 'detail_kirim_kurir' table";
  }

  if (isset($_POST['task2'])) {
    $query = "UPDATE `detail_jual_barang` SET status = 1 WHERE id_transaksi_penjualan = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);

    $result['status'] = 1;
    $result['message'] .= "Data successfuly updated on 'detail_jual_barang' table";
  }

  echo json_encode($result);

} else {
    header("HTTP/1.1 400 Bad Request");
    $error = array(
        'error' => 'Method not Allowed'
    );

    echo json_encode($error);
}
