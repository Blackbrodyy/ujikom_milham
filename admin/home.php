<?php
require_once('../config/koneksi.php');
session_start();

// Ensure user is logged inF
if ($_SESSION['status'] != 'login') { 
    echo "<script>
    alert('Anda belum login!');
    location.href='../index.php';
    </script>";
    exit();  // Prevent further code execution after redirect
}

$userid = $_SESSION['userid'];  // Get user ID from session
?>

<!DOCTYPE html>
<html lang="id">

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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
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
        <h4>Album:</h4>
        <?php
        $albumid = mysqli_query($koneksi, "SELECT * FROM album WHERE userid = '$userid'");
        while ($row = mysqli_fetch_array($albumid)) {
            ?>
            <a href="home.php?albumid=<?php echo $row['albumid']; ?>" class="btn btn-outline-primary">
                <?php echo $row['namaalbum']; ?>
            </a>
        <?php } ?>

        <div class="row mt-4">
            <?php
            if (isset($_GET['albumid'])) {
                $albumid = $_GET['albumid'];
                $query = mysqli_query($koneksi, "SELECT * FROM foto WHERE userid = '$userid' AND albumid = '$albumid'");
            } else {
                $query = mysqli_query($koneksi, "SELECT * FROM foto WHERE userid = '$userid'");
            }

            while ($data = mysqli_fetch_array($query)) {
                ?>
                <div class="col-md-3 mb-3">
                    <div class="card">
                        <img style="height: 12rem;" src="../assets/img/<?php echo $data['lokasifile']; ?>" class="card-img-top" alt="Foto">
                        <div class="card-footer text-center">
                            <?php
                            $fotoid = $data['fotoid'];
                            $ceksuka = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid = '$fotoid' AND userid = '$userid'");
                            if (mysqli_num_rows($ceksuka) == 1) {
                                ?>
                                <a href="../config/proses_like.php?fotoid=<?php echo $data['fotoid']; ?>" class="text-danger"><i class="fa fa-heart"></i></a>
                            <?php } else { ?>
                                <a href="../config/proses_like.php?fotoid=<?php echo $data['fotoid']; ?>" class="text-muted"><i class="fa-regular fa-heart"></i></a>
                            <?php }
                            $like = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid = '$fotoid'");
                            echo mysqli_num_rows($like) . ' suka';
                            ?>
                            <a href="" class="text-muted"><i class="fa-regular fa-comment"></i> 3 komentar</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <footer class="d-flex justify-content-center border-top mt-3 bg-light py-3">
        <p>&copy; 2024 Gallery - Muhamad Ilham Fadilah</p>
    </footer>

    <script src="../assets/js/bootstrap.bundle.min.js"></script> <!-- Use bundle for both JS and Popper -->
</body>

</html>
