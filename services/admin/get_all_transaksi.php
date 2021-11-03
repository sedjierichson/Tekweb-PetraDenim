<?php

include $_SERVER['DOCUMENT_ROOT']."/rucas.co/conn.php";

header("Content-Type: application/json");


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $sql = "SELECT t.id AS `id_transaksi`, b.nama,b.ukuran,d.qty, t.hari_tanggal, d.status, c.nama AS `nama_customer`, c.id AS `id_customer`, k.nama AS `kurir`
    FROM detail_jual_barang d
    JOIN barang b ON b.id = d.id_barang
    LEFT JOIN transaksi_penjualan t ON t.id = d.id_transaksi_penjualan
    LEFT JOIN detail_transaksi_customer dt ON t.id = dt.id_transaksi_penjualan
    LEFT JOIN customer c ON c.id = dt.id_customer
    LEFT JOIN detail_kirim_kurir dk ON dk.id_transaksi_penjualan = t.id
    LEFT JOIN kurir k ON k.id = dk.id_kurir ORDER BY t.hari_tanggal DESC
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $result = array();
    while($row = $stmt->fetch()) {
        array_push($result, $row);
    }

    echo json_encode($result);
} else {
    header("HTTP/1.1 400 Bad Request");
    $error = array(
        'error' => 'Method not Allowed'
    );

    echo json_encode($error);
}
