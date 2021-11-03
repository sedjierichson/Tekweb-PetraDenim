<?php

include $_SERVER['DOCUMENT_ROOT']."/rucas.co/conn.php";

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == "GET") {
  $query = "SELECT * FROM barang WHERE status = 1 ORDER BY id ASC";
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

?>
