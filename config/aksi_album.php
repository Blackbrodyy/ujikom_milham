<?php
session_start();
include 'koneksi.php';

if (isset($_POST['tambah'])) {
    $namaalbum = $_POST['namaalbum'];
    $deskripsi = $_POST['deskripsi'];
    $tanggalbuat = date('y-m-d');
    $userid = $_SESSION['userid'];

    $sql = mysqli_query($koneksi,"INSERT INTO album VALUES(null,'$namaalbum','$deskripsi','$tanggalbuat','$userid')");

    echo"<script>
    alert('Data berhasil di simpan');
    location.href='../admin/album.php';
    </script>";

}

if (isset($_POST['edit'])) {
    $albumid = $_POST['albumid'];
    $namaalbum = $_POST['namaalbum'];
    $deskripsi = $_POST['deskripsi'];
    $tanggalbuat = date('y-m-d');
    $userid = $_SESSION['userid'];

    $sql = mysqli_query($koneksi,"UPDATE album SET namaalbum='$namaalbum', deskripsi='$deskripsi',tanggalbuat='$tanggalbuat' WHERE albumid='$albumid'");

    echo"<script>
    alert('Data berhasil di perbarui');
    location.href='../admin/album.php';
    </script>";

}

if (isset($_POST['hapus'])) {
    $albumid = $_POST['albumid'];

    $sql = mysqli_query($koneksi,"DELETE FROM album WHERE albumid='$albumid'");

    echo"<script>
    alert('Data berhasil di hapus');
    location.href='../admin/album.php';
    </script>";

}
?>