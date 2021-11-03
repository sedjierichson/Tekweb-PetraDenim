<?php

session_start();

include $_SERVER['DOCUMENT_ROOT']."/rucas.co/conn.php";

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $result = array(
        "status" => 1,
        "error" => ""
    );

    $id = $_POST['id'];
    $qty = $_POST['qty'];

    if ($qty == ' ') {
        header("HTTP/1.1 400 Bad Request");
        $result['status'] = 0;
        $result['error'] = 'quantity Must Have Value!';
    } else {
        $sql = "UPDATE detail_item_gudang SET qty = ? WHERE id_barang = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$qty,$id]);
    }

    $query = "INSERT INTO `detail_edit_barang` VALUES (DEFAULT, ?, ?, NOW(), 'edit quantity')";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id, $_SESSION['admin_id']]);

    echo json_encode($result);
} else {
    header("HTTP/1.1 400 Bad Request");
    $error = array(
        'error' => 'Method not Allowed'
    );

    echo json_encode($error);
}
