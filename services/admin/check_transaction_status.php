<?php

include $_SERVER['DOCUMENT_ROOT']."/rucas.co/conn.php";

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = $_POST['id'];


  $result = array(
    'status' => 1,
    'check1' => '',
    'check2' => ''
  );
  $query = "SELECT * FROM `detail_kirim_kurir` WHERE id_transaksi_penjualan = ?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$id]);

  $row = $stmt->fetch();

  $result['status'] = 1;
  $result['check1'] = $row['hari_tanggal'];

  $query = "SELECT * FROM `detail_jual_barang` WHERE id_transaksi_penjualan = ?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$id]);

  while ($row = $stmt->fetch()) {
    $result['status'] = 1;
    $result['check2'] = $row['status'];
  }


  echo json_encode($result);

} else {
    header("HTTP/1.1 400 Bad Request");
    $error = array(
        'error' => 'Method not Allowed'
    );

    echo json_encode($error);
}
