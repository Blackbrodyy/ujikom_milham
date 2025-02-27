<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">
    <a class="navbar-brand" href="index.php">Gallery Photo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse mt-2" id="navbarNavAltMarkup">
      <div class="navbar-nav me-auto">
        
      </div>
      <a herf="register.php" class="btn btn-outline-primary m-1">Daftar</a>
      <a herf="login.php" class="btn btn-outline-primary m-1">masuk</a>
    </div>
  </div>
</nav>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                 <div class="card-body bg-light">
                    <div class="text-center">
                        <h5>Daftar Akun Baru</h5>
                    </div>
                    <form action="config/aksi_register.php"method="POST">
                        <label class="from-label">Username</label>
                        <input type="text" name="username" class="form-control"required>
                        <label class="from-label">Password</label>
                        <input type="password" name="password" class="form-control"required>
                        <label class="from-label">email</label>
                        <input type="email" name="email" class="form-control"required>
                        <label class="from-label">nama lengkap</label>
                        <input type="text" name="namalengkap" class="form-control"required>
                        <label class="from-label">alamat</label>
                        <input type="text" name="alamat" class="form-control"required>
                        <div class="d-grid mt-2">
                            <button class="btn btn-primary" type="submit" name="kirim">DAFTAR
                            </button>
                        </div>
                    </form>
                    <hr>
                    <p>dudah punya akun? <a href="login.php">login disini!</a></p>
                 </div>
            </div>
        </div>
    </div>
</div>

<footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">

<p>&copy; UKK RPL 2024 | Muhamad ilham fadilah</p>
</footer>

    <script>type="text/javascript" src="assets/js/boostrap.min.js"</script>

</body>
</html>