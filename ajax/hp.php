<?php
usleep(500000);
// sleep(3);
require '../functions.php';
$keyword = $_GET['keyword'];

$query = "SELECT * FROM hp_flagship WHERE
    nama LIKE '%$keyword%' OR
    merek LIKE '%$keyword%' OR
    rilis LIKE '%$keyword%' OR
    harga LIKE '%$keyword%' OR
    deskripsi LIKE '%$keyword%' OR
    gambar LIKE '%$keyword%'
    ";
$hp = query($query);
?>

<table border="1" cellpadding="12" cellspacing="1">
            
    <tr>
        <th>No</th>
        <th>Aksi</th>
        <th>Nama</th>
        <th>Merek</th>
        <th>Rilis</th>
        <th>Harga</th>
        <th>Deskripsi</th>
        <th>Gambar</th>
    </tr>
    
    <?php $i = 1; ?>
    <?php foreach( $hp as $row ) : ?>
<tr>
    <td><?= $i; ?></td>
    <td>
        <a href="ubah.php?id=<?= $row["id"]; ?>">Ubah</a> |
        <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('Apakah yakin ingin menghapus data berikut?');">Hapus</a>
    </td>
    <td><?= $row["nama"]; ?></td>
    <td><?= $row["merek"]; ?></td>
    <td><?= $row["rilis"]; ?></td>
    <td><?= $row["harga"]; ?></td>
    <td><?= $row["deskripsi"]; ?></td>
    <td><img src="img/img/<?= $row["gambar"]; ?> " alt="desktop" width="300"></td>
</tr>
<?php $i++; ?>
<?php endforeach; ?>

</table>