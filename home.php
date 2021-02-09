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
            <p>What are you looking for?</p>
            <form class="search">
                <input type="text" class="input" name="search" placeholder="Search here...">
                <a href=""><input type="button" value="Search" class="btn"></a>
            </form>

        </div>
    </section>

    <main>
        <div class="main-container">
            <div class="collection">
                <?php
                    include "config.php";

                    $query = mysqli_query($koneksi, "SELECT * FROM tblbuku ORDER BY id_buku ASC");

                    while ($data = mysqli_fetch_array($query)) {    
                        echo "<a href='book-detail.php?id_buku=$data[id_buku]'><img class='book-container' src='img/".$data['coverbuku']."' class='img-rounded' width='200px' height='300px' /></a>";
                    } 
                ?>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; Copyright 2020 Ridwan Miftahul Falah</p>
    </footer>

    <!-- <script src="script.js"></script> -->
</body>

</html>