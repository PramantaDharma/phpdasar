<?php
    $conn = mysqli_connect("localhost", "root", "", "hp_php");

    // menampilkan data dari tabel
    function query($query){
        global $conn;
        $result = mysqli_query($conn, $query);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    function tambah($data){
        
        global $conn;

        // ambil data dari tiap elemen dalam form
        $nama = htmlspecialchars($data["nama"]);
        $merek = htmlspecialchars($data["merek"]);
        $rilis = htmlspecialchars($data["rilis"]);
        $harga = htmlspecialchars($data["harga"]);
        $deskripsi = htmlspecialchars($data["deskripsi"]);
        // upload gambar
        $gambar = upload();
        if (!$gambar) {
            return false;
        }   

        // query insert data
        $query = "INSERT INTO hp_flagship 
                    VALUES
                        ('0', '$nama', '$merek', $rilis, '$harga', '$deskripsi', '$gambar' )
                ";
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);

    }

    function upload(){
        $namaFile = $_FILES["gambar"]["name"];
        $ukuranFile = $_FILES["gambar"]["size"];
        $error = $_FILES["gambar"]["error"];
        $tmpName = $_FILES["gambar"]["tmp_name"];

        // cek apakah ada gambar yang diupload
        if ($error === 4 ) {
            echo "<script>
                alert('Masukkan gambar terlebih dahulu')
            </script>";
            return false;
        }

        // cek yang diupload itu adalah gambar dan memecah ekstensi menjadi array
        $ekstensiNamaFileGambar = ['jpg', 'jpeg', 'png'];
        $ekstensiGambar = explode(".", "$namaFile");
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        if (!in_array($ekstensiGambar, $ekstensiNamaFileGambar) ) {
            echo "<script>
                alert('Ekstensi file anda salah, harap upload berupa gambar!')
            </script>";
        };
        
        // cek ukuran gambar agar tidak kebesaran
        if($ukuranFile > 10000000){
            echo "<script>
                alert('Gambar terlalu besar dari ketentuan, mohon perhatikan')
            </script>";
            return false;
        }

        // lolos pengecekan, gambar siap diupload
        // generate nama gambar baru
        $namaFileBaru = uniqid();
        $namaFileBaru .= ".";
        $namaFileBaru .= $ekstensiGambar;
        move_uploaded_file($tmpName, 'img/img/' . $namaFileBaru);

        return $namaFileBaru;

    }
    
    function hapus($data) {
        global $conn;
        mysqli_query($conn, "DELETE FROM hp_flagship WHERE id = $data");

        return mysqli_affected_rows($conn);
    }

    function ubah($data) {
        global $conn;

        $id = $data["id"];
        $nama = htmlspecialchars($data["nama"]);
        $merek = htmlspecialchars($data["merek"]);
        $rilis = htmlspecialchars($data["rilis"]);
        $harga = htmlspecialchars($data["harga"]);
        $deskripsi = htmlspecialchars($data["deskripsi"]);
        $gambarLama =  htmlspecialchars($data["gambarLama"]);

        // cek apakah user mengganti gambar atau tidak
        if ($_FILES['gambar']['error'] === 4){
            $gambar = $gambarLama;
        }else {
            $gambar = upload();
        }

        $query = "UPDATE hp_flagship SET
                        nama = '$nama',
                        merek = '$merek',
                        rilis = '$rilis',
                        harga = '$harga',
                        deskripsi = '$deskripsi',
                        gambar = '$gambar'
                        WHERE id = $id
                ";
                
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function cari($keyword) {
        $query = "SELECT * FROM hp_flagship WHERE
        nama LIKE '%$keyword%' OR
        merek LIKE '%$keyword%' OR
        rilis LIKE '%$keyword%' OR
        harga LIKE '%$keyword%' OR
        deskripsi LIKE '%$keyword%' OR
        gambar LIKE '%$keyword%'
        ";
        return query($query);
    }

    function signup($data){
        global $conn;

        $username = strtolower(stripslashes($data["username"]));
        $password = mysqli_real_escape_string($conn, $data["password"]);
        $password2 = mysqli_real_escape_string($conn, $data["password2"]);
        $email = $data["email"];

        // cek username sudah ada atau tidak
        $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");

        if( mysqli_fetch_assoc($result) ) {
            echo "<script>
            alert('Maaf, nama yang anda masukkan sudah ada. Mohon gunakan nama yang lain')
            </script>";
            return false;
        }


        // cek konfirmasi password
        if( $password !== $password2 ){
            echo "<script>
            alert('Password anda tidak sesuai, mohon masukkan kembali')
            </script>";
            return false;  
        }
        
        // enkripsi password
        $pass = password_hash($password, PASSWORD_DEFAULT);

        // tambahkan user baru ke database
        mysqli_query($conn, "INSERT INTO users VALUES('0', '$username', '$pass', '$email' )");

        return mysqli_affected_rows($conn);
    }
?>