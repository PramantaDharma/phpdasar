<?php

    session_start();
    if(!isset($_SESSION["signin"]) ) {
        header("Location: login.php");
        exit;
    }

require 'functions.php';

    // ambil data dari URL (id)
    $dataU = $_GET["id"];

    // query data mahasiswa berdasarkan id
    $hp = query("SELECT * FROM hp_flagship WHERE id = $dataU")[0];

    // cek apakah tombol submit sudah ditekan atau belum
    if( isset($_POST["submit"]) ) {

        // cek apakah data berhasil di  ubah atau tidak
       if ( ubah($_POST) > 0) {
           echo "
            <script>
            alert('Data berhasil diubah');
            document.location.href = 'index.php';
            </script>
            ";
        } else {
            echo "
            <script>
            alert('Data tidak berhasil diubah');
            document.location.href = 'index.php';
            </script>
           ";
       }

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data</title>
    <link rel="stylesheet" href="style/main.css">
</head>
<body>
    <h3>Ubah Data List HP </h3>

    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $hp["id"]; ?>">
        <input type="hidden" name="gambarLama" value="<?= $hp["gambar"]; ?>">
        <ul>
            <li>
                <label for="seri">Nama : </label>
                <input type="text" name="nama" id="seri" required value="<?= $hp["nama"]; ?>" class="mid">
            </li>
            <li>
                <label for="brand"> Merek : </label>
                <input type="text" name="merek" id="brand" required value="<?= $hp["merek"]; ?>"class="mid">
            </li>
            <li>
                <label for="release"> Rilis : </label>
                <input type="text" name="rilis" id="release" required value="<?= $hp["rilis"]; ?>"class="mid">
            </li>
            <li>
                <label for="cost"> Harga : </label>
                <input type="text" name="harga" id="cost" required value="<?= $hp["harga"]; ?>"class="mid">
            </li>
            <li>
                <label for="desc"> Deskripsi : </label>
                <input type="text" name="deskripsi" id="desc" required value="<?= $hp["deskripsi"]; ?>"class="mid">
            </li>
            <li>
                <label for="image"> Gambar : </label>
                <img src="img/<?= $hp["gambar"] ?> " alt="Image your fucking handphone" class="imgkcl">
                <input type="file" name="gambar" id="image" >
            </li>
            <li>
                <button name="submit" type="submit" >Ubah Data!</button>
            </li>
        </ul>
    </form>

</body>
</html>
