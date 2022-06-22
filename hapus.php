<?php

    session_start();
    if(!isset($_SESSION["signin"]) ) {
        header("Location: login.php");
        exit;
    }

require 'functions.php';

    $data = $_GET["id"];

    if ( hapus($data) > 0 ) {
        echo "
            <script>
            alert('Data berhasil dihapus');
            document.location.href = 'index.php';
            </script>
            ";
        } else {
            echo "
            <script>
            alert('Data tidak berhasil dihapus');
            document.location.href = 'index.php';
            </script>
           ";
       }
    

?>