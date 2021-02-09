<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <title>Personal Library</title>
    <style>
        <?php include "style.css" ?>
    </style>

    <script type="text/javascript" src="jquery-3.5.1.js"></script>
    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
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
                <input type="text" class="input" placeholder="Search here...">
                <input type="button" value="Search" class="btn">
            </form>
        </div>
    </section>

    <main>
        <div class="main-container">
            <div class="content-container">
                <div class="page-title">
                    <h3>Add your New Book Here</h3><br>
                </div>
                <div class="main-content">
                    <form method="post" enctype="multipart/form-data">
                        <table class="add-form">
                            <tr>
                                
                                <td>
                                    <div style="width: 175px; height: 240px; margin-bottom: 8px; border: 1px solid black;">
                                        <img id="blah" src="#" alt="Add your Book's Cover" style="width: 175px; height: 240px;">
                                    </div>                                    
                                    <input type="file" name="cover" onchange="readURL(this);">
                                </td>
                            </tr>
                        </table>

                        <table class="add-form2">
                            <tr>
                                <td>ID Buku : </td>
                                <td><input type="text" name="id_buku"></td>
                            </tr>
                            <tr>
                                <td>Judul : </td>
                                <td><input type="text" name="judul"></td>
                            </tr>
                        
                            <tr>
                                <td>Penulis : </td>
                                <td><input type="text" name="penulis"></td>
                            </tr>
                            <tr>
                                <td>Penerbit : </td>
                                <td><input type="text" name="penerbit"></td>
                            </tr>
                            <tr>
                                <td>Kategori : </td>
                                <td><input type="text" name="kategori"></td>
                            </tr>
                            <tr>
                                <td>Jumlah Halaman : </td>
                                <td><input type="text" name="tebal"></td>
                            </tr>
                            <tr>
                                <td>ISBN : </td>
                                <td><input type="text" name="isbn"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input type="submit" name="Submit" class="btnsubmit" value="Save"></td>
                            </tr>
                        </table>     
                    </form>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; Copyright 2020 Ridwan Miftahul Falah</p>
    </footer>
    <?php
    include "config.php";

    if (isset($_POST['Submit'])) {
        $id_buku = $_POST['id_buku'];
        $judul = $_POST['judul'];
        $penulis = $_POST['penulis'];
        $penerbit = $_POST['penerbit'];
        $kategori = $_POST['kategori'];
        $tebal = $_POST['tebal'];
        $isbn = $_POST['isbn'];

        $imgFile = $_FILES['cover']['name'];
        $tmp_dir = $_FILES['cover']['tmp_name'];
        $imgSize = $_FILES['cover']['size'];

        $upload_dir = 'img/'; // upload directory

        $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension

        // valid image extensions
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions

        // rename uploading image
        $coverbuku = rand(1000,1000000).".".$imgExt;

        // allow valid image file formats
        if(in_array($imgExt, $valid_extensions)){   
        // Check file size '5MB'
            if($imgSize < 5000000)    {
                move_uploaded_file($tmp_dir,$upload_dir.$coverbuku);
            } else {
                $errMSG = "Sorry, your file is too large.";
            }
        }
        else{
            $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";  
        }


        $query = mysqli_query($koneksi, "insert into tblbuku values('$id_buku', '$coverbuku', '$judul', '$penulis', '$penerbit', '$kategori', '$tebal', '$isbn')") or die(mysql_error());
        if($query) {
            echo "Data Tersimpan";
        } else {
            echo "Gagal Tersimpan";
        }

        // header('location: tampil1.php');
        echo "<script>window.location.href = 'detail-list.php';</script>";
    }
?>
    
</body>

</html>

