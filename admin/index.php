<?php
include '../config/koneksi.php';
session_start();

// Ensure user is logged in
if ($_SESSION['status'] != 'login') {
    echo "<script>
    alert('Anda belum login!');
    location.href='../index.php';
    exit();
    </script>";
}

// Fetch user ID from session
$userid = $_SESSION['userid'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gallery</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
</head>
<body>
<nav class="navbar navbar-expand-lg bg-success navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">Gallery</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse mt-2" id="navbarNavAltMarkup">
            <div class="navbar-nav me-auto">
                <a href="home.php" class="nav-link">Home</a>
                <a href="album.php" class="nav-link">Album</a>
                <a href="poto.php" class="nav-link">Foto</a>
            </div>
            <a href="../config/aksi_logout.php" class="btn btn-outline-primary m-1">Keluar</a>
        </div>
    </div>
</nav>

<div class="container mt-3">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <!-- Assuming you want to use the first image from the DB -->
                <!-- <img src="" class="card-img-top" alt="Image" style="height: 12rem;">
                <div class="card-footer text-center">
                    <a href="#">10 Suka</a>
                    <a href="#">3 Komentar</a> -->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-2">
    <div class="row">
        <?php
        // Query to fetch photos of the logged-in user
        $query = mysqli_query($koneksi, "SELECT * FROM foto WHERE userid = '$userid'");
        while ($data = mysqli_fetch_array($query)) {
            ?>
            <div class="col-md-3 mb-4">
                <div class="card">
                    <img style="height: 12rem;" src="../assets/img/<?php echo $data['lokasifile']; ?>" class="card-img-top" alt="Image">
                    <div class="card-footer text-center">
                        <?php
                        $fotoid = $data['fotoid'];

                        // Check if the user already liked this photo
                        $ceksuka = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");
                        if (mysqli_num_rows($ceksuka) == 1) { ?>
                            <a href="../config/proses_like.php?fotoid=<?php echo $data['fotoid']; ?>" class="text-danger"><i class="fa fa-heart"></i></a>
                        <?php } else { ?>
                            <a href="../config/proses_like.php?fotoid=<?php echo $data['fotoid']; ?>"><i class="fa-regular fa-heart"></i></a>
                        <?php }

                        // Display the number of likes
                        $like = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
                        echo mysqli_num_rows($like) . ' Suka';
                        ?>

                        <a href="#" class="ml-2"><i class="fa-regular fa-comment"></i> 3 Komentar</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">
    <p>&copy; UKK RPL 2024 | Muhamad Ilham Fadilah</p>
</footer>

<!-- Corrected Bootstrap JS script -->
<script src="../assets/js/bootstrap.bundle.min.js"></script>

</body>
</html>
