<?php

    session_start();
    if(!isset($_SESSION["signin"]) ) {
        header("Location: login.php");
        exit;
    }

require 'functions.php';

    // cek apakah tombol submit sudah ditekan
    if( isset($_POST["submit"]) ) {

        // cek apakah data berhasil di tambahkan atau tidak
       if ( tambah($_POST) > 0) {
           echo "
            <script>
            alert('Data baru berhasil ditambahkan');
            document.location.href = 'index.php';
            </script>
            ";
        } else {
            echo "
            <script>
            alert('Data baru tidak berhasil ditambahkan');
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
    <title>Tambah Data</title>
    <link rel="stylesheet" href="style/main.css">
</head>
<body>
    <h1>Tambah Data Baru</h1>
    <h3>Hp Baru Rilis</h3>

    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="seri">Nama : </label>
                <input type="text" name="nama" id="seri" required >
            </li>
            <li>
                <label for="brand"> Merek : </label>
                <input type="text" name="merek" id="brand" required >
            </li>
            <li>
                <label for="release"> Rilis : </label>
                <input type="text" name="rilis" id="release" >
            </li>
            <li>
                <label for="cost"> Harga : </label>
                <input type="text" name="harga" id="cost" >
            </li>
            <li>
                <label for="desc"> Deskripsi : </label>
                <input type="text" name="deskripsi" id="desc" class="form-control">
            </li>
            <li>
                <label for="image"> Gambar : </label>
                <input type="file" name="gambar" id="image">
            </li>
            <li>
                <button name="submit" type="submit" >Tambah Data Baru</button>
            </li>
        </ul>
        <h4>Mohon untuk mengisi semua form karena pemanggilan variabel nya dari semua form!</h4>
    </form>

</body>
</html>