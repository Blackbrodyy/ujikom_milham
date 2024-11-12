<?php
include'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$namalengkap = $_POST['namalengkap'];
$alamat = $_POST['alamat'];
$encrip = md5($password);

$sql = mysqli_query($koneksi,"INSERT INTO user VALUES(null,'$username','$encrip','$email','$namalengkap','$alamat')");

if ($sql){
    echo"<script>
    alert('pendaftaran akun berhasil');
    location.href='../login.php';
    </script>";

}

?>