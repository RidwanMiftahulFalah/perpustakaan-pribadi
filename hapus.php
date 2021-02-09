<?php
    include_once("config.php");

    // Deleting image in img folder
    $id_buku = $_GET['id_buku'];
    $query1 = mysqli_query($koneksi, "SELECT * FROM tblbuku WHERE id_buku='$id_buku'");
    $data = mysqli_fetch_array($query1);
    $upload_dir = 'img/';
    unlink($upload_dir.$data['coverbuku']);

    $query = mysqli_query($koneksi, "DELETE FROM tblbuku WHERE id_buku='$id_buku'");
    if ($query) {
        header('location:detail-list.php');
    } else {
        echo "GAGAL";
    }  
?>