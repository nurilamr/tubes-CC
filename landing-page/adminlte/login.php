<?php
include("koneksi.php");
session_start();
error_reporting(0);

$alert = "Masukkan username dan password";
if (isset($_POST['masuk'])) {
  $username = mysqli_real_escape_string($link, $_POST['username']);
  $password = $_POST['password'];

  // Ambil data pengguna dari database berdasarkan username yang dimasukkan
  $sql = "SELECT * FROM user_pendaftar WHERE username='$username' LIMIT 1";
  $result = mysqli_query($link, $sql);

  if (mysqli_num_rows($result) == 1) {
    $data = mysqli_fetch_array($result);
    if (password_verify($password, $data['password'])) {
      $_SESSION['user_id'] = $data['id'];
      $_SESSION['nama_lengkap'] = $data['nama_lengkap'];

      $sql = "SELECT * FROM pendaftar_reguler WHERE user_id='{$data['id']}' LIMIT 1";
      $result = mysqli_query($link, $sql);

      if (mysqli_num_rows($result) == 1) {
        header("Location: index.php");
      } else {
        header("Location: form-reguler.php");
      }
      exit();
    } else {
      $alert = "Password Salah";
    }
  } else {
    $alert = "Username Salah";
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Tambahkan kode HTML bagian head sesuai kebutuhan -->
</head>
<body class="hold-transition login-page">
  <!-- Tambahkan kode HTML bagian body sesuai kebutuhan -->
</body>
</html>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in (v2)</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
</head>

<body class="hold-transition login-page">
<div class="login-box">
    <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>LOG</b>IN</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg"><?php echo $alert ?></p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="username" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password">
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

      <p class="mb-0">
        <a href="register.php" class="text-center">Belum punya akun?</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <div class="text-center mt-3">
    <a href="../index.html">
      <button type="button" class="btn btn-info btn-group-sm">
        <i class="fa fa-chevron-plus"></i>
        <span class="m-sm-3">Home</span>
      </button>
    </a>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- SweetAlert2 -->
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<?php
if (isset($_SESSION['success'])) {
    echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: '" . $_SESSION['success'] . "'
    });
    </script>";
    unset($_SESSION['success']);
}
?>
</body>
</html>
