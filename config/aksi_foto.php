<?php
session_start();
include 'koneksi.php';

if (isset($_POST['tambah'])) {
    $judulfoto = $_POST['judulfoto'] ?? ''; // Pastikan variabel tidak undefined
    $deskripsifoto = $_POST['deskripsifoto'] ?? '';
    $tanggalunggah = date('Y-m-d');
    $albumid = $_POST['albumid'] ?? '';
    $userid = $_SESSION['userid'] ?? '';

    // Cek apakah ada file yang diunggah dan tidak ada error pada file
    if (isset($_FILES['lokasifile']) && $_FILES['lokasifile']['error'] == 0) {
        $foto = $_FILES['lokasifile']['name'];
        $tmp = $_FILES['lokasifile']['tmp_name'];
        $lokasi = '../assets/img/';
        $namafoto = rand() . '-' . $foto; // Nama unik untuk file yang diunggah

        // Pindahkan file ke folder yang ditentukan
        if (move_uploaded_file($tmp, $lokasi . $namafoto)) {
            // Insert data ke database
            $sql = mysqli_query($koneksi, "INSERT INTO foto (judulfoto, deskripsifoto, tanggalunggah, lokasifile, albumid, userid) VALUES ('$judulfoto', '$deskripsifoto', '$tanggalunggah', '$namafoto', '$albumid', '$userid')");

            if ($sql) {
                echo "<script>
                alert('Data berhasil disimpan!');
                location.href='../admin/poto.php';
                </script>";
            } else {
                echo "<script>
                alert('Gagal menyimpan data ke database!');
                location.href='../admin/poto.php';
                </script>";
            }
        } else {
            echo "<script>
            alert('Gagal mengunggah file!');
            location.href='../admin/poto.php';
            </script>";
        }
    } else {
        echo "<script>
        alert('Tidak ada file yang diunggah atau terjadi kesalahan pada file!');
        location.href='../admin/poto.php';
        </script>";
    }
}

if (isset($_POST['edit'])) {
    $fotoid = $_POST['fotoid'] ?? '';
    $judulfoto = $_POST['judulfoto'] ?? '';
    $deskripsifoto = $_POST['deskripsifoto'] ?? '';
    $tanggalunggah = date('Y-m-d');
    $albumid = $_POST['albumid'] ?? '';
    $userid = $_SESSION['userid'] ?? '';

    if (isset($_FILES['lokasifile']) && $_FILES['lokasifile']['error'] == 0) {
        $foto = $_FILES['lokasifile']['name'];
        $tmp = $_FILES['lokasifile']['tmp_name'];
        $lokasi = '../assets/img/';
        $namafoto = rand() . '-' . $foto;

        // Hapus file lama jika ada
        $query = mysqli_query($koneksi, "SELECT * FROM foto WHERE fotoid='$fotoid'");
        $data = mysqli_fetch_array($query);
        if (is_file($lokasi . $data['lokasifile'])) {
            unlink($lokasi . $data['lokasifile']);
        }

        // Pindahkan file baru ke folder yang ditentukan
        move_uploaded_file($tmp, $lokasi . $namafoto);

        // Update data termasuk file foto baru
        $sql = mysqli_query($koneksi, "UPDATE foto SET judulfoto='$judulfoto', deskripsifoto='$deskripsifoto', tanggalunggah='$tanggalunggah', lokasifile='$namafoto', albumid='$albumid' WHERE fotoid='$fotoid'");
    } else {
        // Update data tanpa mengganti file foto
        $sql = mysqli_query($koneksi, "UPDATE foto SET judulfoto='$judulfoto', deskripsifoto='$deskripsifoto', tanggalunggah='$tanggalunggah', albumid='$albumid' WHERE fotoid='$fotoid'");
    }

    if ($sql) {
        echo "<script>
        alert('Data berhasil diperbarui!');
        location.href='../admin/poto.php';
        </script>";
    } else {
        echo "<script>
        alert('Gagal memperbarui data di database!');
        location.href='../admin/poto.php';
        </script>";
    }
}

if (isset($_POST['hapus'])) {
    $fotoid = $_POST['fotoid'] ?? '';
    $query = mysqli_query($koneksi, "SELECT * FROM foto WHERE fotoid='$fotoid'");
    $data = mysqli_fetch_array($query);
    if (is_file('../assets/img/' . $data['lokasifile'])) {
        unlink('../assets/img/' . $data['lokasifile']);
    }

    $sql = mysqli_query($koneksi, "DELETE FROM foto WHERE fotoid='$fotoid'");

    if ($sql) {
        echo "<script>
        alert('Data berhasil dihapus!');
        location.href='../admin/poto.php';
        </script>";
    } else {
        echo "<script>
        alert('Gagal menghapus data di database!');
        location.href='../admin/poto.php';
        </script>";
    }
}
?>