<?php

include("koneksi.php");
session_start();
error_reporting(0);

// Redirect jika sudah login
if (isset($_SESSION['username'])) {
  header("Location: index2.php");
  exit();
}

$alert = "Masukkan username dan password";
if (isset($_POST['masuk'])) {
  // Ambil dan sanitasi input pengguna
  $username = mysqli_real_escape_string($link, $_POST['username']);
  $password = $_POST['password'];

  // Ambil data pengguna dari database berdasarkan username yang dimasukkan
  $sql = "SELECT * FROM user WHERE username='$username' LIMIT 1";
  $result = mysqli_query($link, $sql);

  if (mysqli_num_rows($result) == 1) {
    $data = mysqli_fetch_array($result);

    // Periksa apakah password yang dimasukkan cocok dengan hash yang disimpan di database
    if (password_verify($password, $data['password'])) {
      // Jika cocok, periksa apakah pengguna adalah admin
      if ($data['status'] == 'ADMIN') {
        // Atur sesi pengguna
        $_SESSION['id'] = $data['id'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['nama_lengkap'] = $data['nama_lengkap'];
        $_SESSION['status'] = $data['status'];
        header("Location: index2.php");
        exit();
      } else {
        $alert = "Anda tidak memiliki akses admin";
      }
    } else {
      // Jika password tidak cocok, tampilkan pesan kesalahan
      $alert = "Password Salah";
    }
  } else {
    // Jika username tidak ditemukan, tampilkan pesan kesalahan
    $alert = "Username Salah";
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php include("title.php") ?>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="login.php" class="h1"><b>LOG</b>IN</a>
    </div>
    <p class="login-box-msg"><?php echo $alert ?></p>
    <div class="card-body">

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="masuk" class="btn btn-primary btn-block">Masuk</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
