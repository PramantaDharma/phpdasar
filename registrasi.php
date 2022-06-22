<?php

    session_start();
    if(!isset($_SESSION["signin"]) ) {
        header("Location: login.php");
        exit;
    }

    require 'functions.php';
    // document.location.href = 'login.php;

    if(isset($_POST["register"]) ) {

        if( signup($_POST) > 0 ) {
            echo "<script>
                    alert ('user baru berhasil ditambah');
                    document.location.href = 'login.php';
                </script>";
        } else {
            echo mysqli_error($conn);
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registasi Page</title>
    <link rel="stylesheet" href="style/main.css">
</head>
<body>
    <h1>Halaman Registrasi</h1>
    <div class="container">
        <form action="" method="post">
            <ul>
                <li>
                    <label for="username">username : </label>
                    <input type="text" name="username" id="usernmame" class="mid">
                </li>
                <li>
                    <label for="password">password : </label>
                    <input type="password" name="password" id="password" class="mid">
                </li>
                <li>
                    <label for="password2">konfirmasi Password : </label>
                    <input type="password" name="password2" id="password2" class="mid">
                </li>
                <li>
                    <label for="email">email : </label>
                    <input type="email" name="email" id="email" class="mid">
                </li>
                <button type="submit" name="register">Daftar cuy</button>
            </ul>
        </form>
    </div>
</body>
</html>