<?php
include $_SERVER['DOCUMENT_ROOT']."/rucas.co/conn.php";

$key = $_GET['keyword'];
$keyword = str_replace('%20', ' ', $key);

$query = "SELECT barang.id, `nama`, `harga`, `ukuran`, `deskripsi`, `gambar_1`, `gambar_2`, `gambar_3`, `status`, `qty` FROM `barang` JOIN `detail_item_gudang` ON barang.id = detail_item_gudang.id_barang WHERE status = 1 AND (nama LIKE '%$keyword%' OR deskripsi LIKE '%$keyword%') ORDER BY barang.id ASC";
$stmt = $pdo->prepare($query);
$stmt->execute();

?>
<?php $co = 0 ?>
<?php while ($row = $stmt->fetch()):?>
  <div class="col-md-4 product-grid">
    <div class="image">
      <a href="product-detail.php?id=<?= $row['id']; ?>">
        <img src="/rucas.co/services/admin/tmp/<?= $row['gambar_1']; ?>" class="w-100">
        <div class="overlay">
          <div class="detail">View Details</div>
        </div>
      </a>
    </div>
    <h5 class="text-center"><?= $row['nama']; ?></h5>
    <h5 class="text-center"><?= $row['harga']; ?></h5>
    <a href="#" class="btn buy <?php if ($row['qty'] == 0){ echo 'disabled'; } ?>" data-id='<?= $row['id']; ?>'><?php if ($row['qty'] == 0){ echo 'NOT AVAILABLE'; } else { echo 'BUY'; } ?></a>
  </div>
<?php $co++; ?>
<?php endwhile; ?>

<?php if ($co == 0) { ?>
  <h3 class="my-4">Hmm... Sorry, Product Not Found</h3>
<?php } ?>
