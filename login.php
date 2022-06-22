<?php
session_start();
require 'functions.php';

    // cek cookie
    if(isset($_COOKIE['key']) && isset($_COOKIE['user']) ){
        $key = $_COOKIE['key'];
        $user = $_COOKIE['user'];

        // ambil username berdasarkan id
        $result = mysqli_query($conn, "SELECT username FROM users WHERE id = $key");
        $row = mysqli_fetch_assoc($result);

        // cek cookie beserta username
        if($user === hash('sha256', $row['username']) ) {
            $_SESSION['signin'] = true;
        }

    }

    if(isset($_SESSION["signin"]) ) {
        header("Location: index.php");
        exit;
    }


    if( isset($_POST["signin"]) ) {
        
        $username = $_POST["username"];
        $password = $_POST["password"];

        $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

        // cek username
        if( mysqli_num_rows($result) === 1 ){

            // cek password
            $row = mysqli_fetch_assoc($result);
            if( password_verify($password, $row["password"]) ) {

                // cek remember me (checkbox)
                if(isset($_POST['remember'])) {
                    // set cookie
                    setcookie('key', $row["id"], time()+40 );
                    setcookie('user', hash('sha256', $row["username"]), time()+40 );
                }

                // set session
                $_SESSION["signin"] = true;

                header("Location: index.php");
                exit;
            }
        }

        $error = true;

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="style/main.css">
</head>
<body>
    <h3>Halaman Login Akun</h3>

    <?php if(isset($error) ) : ?>
        <p>Tuh kan, dibilangin untuk ingat password atau username sebelumnya,</p>
        <p class="salah">Password atau Username salah !!!</p>
    <?php endif; ?>

    <form action="" method="post">
        <h4>Jangan lupa untuk mengingat password anda sebelumnya.</h4>
        <ul>
            <li>
                <label for="username">Username : </label>
                <input type="text" name="username" id="username" placeholder="Masukkan username" class="mid">
            </li>
            <li>
                <label for="password">Password : </label>
                <input type="password" name="password" id="password" placeholder="Masukkan password" class="mid">
            </li>
            <input type="checkbox" name="remember" id="remember">
            <label for="remember" >Ingat akun saya.</label>
            <button type="submit" class="spasi" name="signin">Sign-in</button>
        </ul>
    </form>


</body>
</html>