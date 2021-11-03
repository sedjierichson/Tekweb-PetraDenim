<?php

session_start();

if (!isset($_SESSION['authorization']) || $_SESSION['authorization'] == "Customer") {
  header("Location: index.php");
  exit;
}

require $_SERVER['DOCUMENT_ROOT']."/rucas.co/conn.php";

$query = "UPDATE `admin` SET status = 0 WHERE id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$_SESSION['admin_id']]);

header("Location: /rucas.co/services/global/logout.php");
