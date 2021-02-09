<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Personal Library</title>

    <style>
        <?php include "style.css" ?>
    </style>
</head>

<body>
    <header id="navbar">
        <h1>Wans Library</h1>
        <div class="menu">
            <div class="hamburger-wrap">
                <input type="checkbox" class="toggler">
                <div class="hamburger"><div></div></div>
                <div class="hamburger-menu">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Categories</a></li>
                            <li><a href="#">Collections</a></li>
                        </ul>
                </div>
            </div>
            <ul class="menu-desktop">
                <li><a href="home.php">Home</a></li>
                <li><a href="add.php">Add a New Book</a></li>
                <li><a href="detail-list.php">Detail List</a></li>
            </ul>
        </div>
    </header>

    <section class="jumbotron">
        <div class="jumbotron-container">
            <h1>Welcome Back!</h1>
        </div>
    </section>

    <main>
        <div class="main-container">
            <div class="content-container-detail">
                <div class="page-title">
                    <h3>Your Books Detailed List</h3><br>
                </div>
                <div class="main-content">
                    <table class="detail-table">
                        <tr>
                            <th>No.</th>
                            <th>ID Buku</th>
                            <th>Cover</th>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Penerbit</th>
                            <th>Kategori</th>
                            <th>Jumlah Halaman</th>
                            <th>ISBN</th>
                            <th>Aksi</th>
                        </tr>

                        <?php
                            include "config.php";

                            $query = mysqli_query($koneksi, "SELECT * FROM tblbuku ORDER BY id_buku ASC");

                            $no = 1;
                            while ($data = mysqli_fetch_array($query)) {    
                                echo"<tr>";
                                    echo"<td>".$no++."</td>";
                                    echo"<td>".$data['id_buku']."</td>";
                        ?>
                                    <td><img src="img/<?php echo $data['coverbuku']; ?>" class="img-rounded" width="100px" height="150px" /></td>
                        <?php
                                    echo"<td>".$data['judul']."</td>";
                                    echo"<td>".$data['penulis']."</td>";
                                    echo"<td>".$data['penerbit']."</td>";
                                    echo"<td>".$data['kategori']."</td>";
                                    echo"<td>".$data['tebal']."</td>";
                                    echo"<td>".$data['isbn']."</td>";

                                    echo"<td>
                                        <a href='book-detail.php?id_buku=$data[id_buku]' class='tombol edit'>Edit</a>
                                        <a href='hapus.php?id_buku=$data[id_buku]' class='tombol hapus'>Hapus</a>
                                    </td>
                                </tr>";
                                // echo "</tr>";   
                            } 
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; Copyright 2020 Ridwan Miftahul Falah</p>
    </footer>

    <!-- <script src="script.js"></script> -->
</body>

</html>