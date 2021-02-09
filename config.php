<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "db_uas";
    $koneksi = mysqli_connect($server, $username, $password) or die ("Koneksi Gagal");

    mysqli_select_db($koneksi, "$database") or die ("Database tidak ditemukan!");
?>