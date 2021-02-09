

<?php
    include "config.php";

    $id_buku = $_GET['id_buku'];
    $query = mysqli_query($koneksi, "SELECT * FROM tblbuku WHERE id_buku='$id_buku'");
    $data = mysqli_fetch_array($query);


?>

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
                    <h3>Book's Detail</h3><br>
                </div>
                <div class="main-content">
                    <form method="post" enctype="multipart/form-data">
                        <table class="add-form">
                            <tr>
                                <td>Cover : </td>
                                <td>
                                    <div style="width: 175px; height: 240px; margin-bottom: 8px; border: 1px solid black;">
                                        <img id="blah" src="img/<?php echo $data['coverbuku']; ?>" alt="Book Cover" style="width: 175px; height: 240px;">
                                    </div>                                    
                                    <input type="file" name="cover" onchange="readURL(this);">
                                </td>
                            </tr>
                        </table>

                        <table class="add-form3">
                            <tr>
                                <td>ID Buku : </td>
                                <td><input type="text" name="id_buku" value="<?php echo $data['id_buku']; ?>"></td>
                            </tr>
                            <tr>
                                <td>Judul : </td>
                                <td><input type="text" name="judul" value="<?php echo $data['judul']; ?>"></td>
                            </tr>
                        
                            <tr>
                                <td>Penulis : </td>
                                <td><input type="text" name="penulis" value="<?php echo $data['penulis']; ?>"></td>
                            </tr>
                            <tr>
                                <td>Penerbit : </td>
                                <td><input type="text" name="penerbit" value="<?php echo $data['penerbit']; ?>"></td>
                            </tr>
                            <tr>
                                <td>Kategori : </td>
                                <td><input type="text" name="kategori" value="<?php echo $data['kategori']; ?>"></td>
                            </tr>
                            <tr>
                                <td>Jumlah Halaman : </td>
                                <td><input type="text" name="tebal" value="<?php echo $data['tebal']; ?>"></td>
                            </tr>
                            <tr>
                                <td>ISBN : </td>
                                <td><input type="text" name="isbn" value="<?php echo $data['isbn']; ?>"></td>
                            </tr>
                            <tr>
                                
                                <td colspan="2">
                                    <input type="submit" name="ubah" value="Update" class="btnsubmit">
                                    <?php
                                        echo "<a href='hapus.php?id_buku=$data[id_buku]' class='btndelete'>Hapus</a>";
                                    ?>
                                    
                                </td>
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
</body>
</html>



<?php
    include "config.php";
    if(isset($_POST['ubah'])) {
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

            echo "file ".$imgFile;
        if ($imgFile) { 
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
                    unlink($upload_dir.$data['coverbuku']);
                    move_uploaded_file($tmp_dir,$upload_dir.$coverbuku);
                } else {
                    $errMSG = "Sorry, your file is too large.";
                }
            }
            else{
                $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";  
            }
        } else {
            // if no image is selected, old image still remain as it is
            $coverbuku = $data['coverbuku'];

            
        }
        
        
        
        $update = mysqli_query($koneksi, "UPDATE tblbuku SET coverbuku='$coverbuku', judul='$judul', penulis='$penulis', penerbit='$penerbit', kategori='$kategori', tebal='$tebal', isbn='$isbn' WHERE id_buku='$_GET[id_buku]'")  or die(mysqli_error(connection));   

        if($update) {
            // header("location: detail-list.php");
            echo "<script>window.location.href = 'detail-list.php';</script>";
        } else {
            echo "GAGAL";
            
        }
    }
?>