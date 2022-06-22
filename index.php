<?php

    session_start();
    if(!isset($_SESSION["signin"]) ) {
        header("Location: login.php");
        exit;
    }

    require 'functions.php';
    $hp = query("SELECT * FROM hp_flagship"); // ORDER BY DESC

    // jika tombol cari ditekan
    if (isset($_POST["cari"]) ) {
        $hp = cari($_POST["keyword"]);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Admin</title>

    <link rel="stylesheet" href="style/main.css" />
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/script.js"></script>

</head>
<body>
    <a href="logout.php">Logout.</a>

    <h1>List Handphone Flagship</h1>


    <a href="registrasi.php">Register new account.</a> ||

    <a href="tambah.php">Tambah Data Baru !</a>
    <br><br>

    <form action="" method="post">
        <input type="text" name="keyword" placeholder="Cari informasi seputar Handphone flagship..." autofocus size="50" autocomplete="off" id="keyword">
        <button type="submit" name="cari" id="butt-search">Cari !!!</button>
        <img src="img/gif/loader1.gif" class="loader">
    </form>
    <br>

    <div class="container" id="container">
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
    </div>

</body>
</html>