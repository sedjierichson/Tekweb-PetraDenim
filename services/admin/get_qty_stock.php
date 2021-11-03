<?php

include $_SERVER['DOCUMENT_ROOT']."/rucas.co/conn.php";

header("Content-Type: application/json");


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $sql = "SELECT  b.id, b.nama, d.qty
    FROM detail_item_gudang d
    JOIN barang b ON b.id = d.id_barang WHERE d.qty != -1";
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
