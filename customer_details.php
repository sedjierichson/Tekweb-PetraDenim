<?php

require $_SERVER['DOCUMENT_ROOT']."/rucas.co/conn.php";

$query = "SELECT * FROM `customer` WHERE id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$_GET['id']]);
$row = $stmt->fetch();

echo $row['nama'];
echo "<br>";
echo $row['no_telp'];
echo "<br>";
echo $row['alamat'];
echo "<br>";

?>
