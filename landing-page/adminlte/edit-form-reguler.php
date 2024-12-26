<?php

include("koneksi.php");
session_start();

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM pendaftar_reguler WHERE user_id='$user_id' LIMIT 1";
$result = mysqli_query($link, $sql);

if (mysqli_num_rows($result) == 1) {
  $data = mysqli_fetch_assoc($result);
} else {
  // Jika tidak ada data, arahkan ke halaman lain atau tampilkan pesan kesalahan
  echo "Data tidak ditemukan";
  exit();
}

if(isset($_POST['edit'])) {
  $nama_siswa = $_POST['nama_siswa'];
  $ttl = $_POST['ttl'];
  $jk = $_POST['jk'];
  $alamat = $_POST['alamat'];
  $telp_siswa = $_POST['telp_siswa'];
  $agama = $_POST['agama'];
  $asal_sekolah = $_POST['asal_sekolah'];
  $ijazah = !empty($_FILES['ijazah']['name']) ? $_FILES['ijazah']['name'] : $data['ijazah'];
  $rapor = !empty($_FILES['rapor']['name']) ? $_FILES['rapor']['name'] : $data['rapor'];
  $prestasi = !empty($_FILES['prestasi']['name']) ? $_FILES['prestasi']['name'] : $data['prestasi'];
  $nama_ortu = $_POST['nama_ortu'];
  $pekerjaan = $_POST['pekerjaan'];
  $telp_ortu = $_POST['telp_ortu'];
  $pendidikan = $_POST['pendidikan'];

  // Cek apakah file diunggah, jika tidak gunakan file yang lama
  $ijazah = !empty($_FILES['ijazah']['name']) ? time() . "_" . $_FILES['ijazah']['name'] : $data['ijazah'];
  $rapor = !empty($_FILES['rapor']['name']) ? time() . "_" . $_FILES['rapor']['name'] : $data['rapor'];
  $prestasi = !empty($_FILES['prestasi']['name']) ? time() . "_" . $_FILES['prestasi']['name'] : $data['prestasi'];

  // Simpan file yang diunggah
  if (!empty($_FILES['ijazah']['tmp_name'])) {
    move_uploaded_file($_FILES['ijazah']['tmp_name'], "../../ijazah/" . $ijazah);
  }
  if (!empty($_FILES['rapor']['tmp_name'])) {
    move_uploaded_file($_FILES['rapor']['tmp_name'], "../../rapor/" . $rapor);
  }
  if (!empty($_FILES['prestasi']['tmp_name'])) {
    move_uploaded_file($_FILES['prestasi']['tmp_name'], "../../prestasi/" . $prestasi);
  }

  $sql = "UPDATE pendaftar_reguler SET nama_siswa='$nama_siswa', ttl='$ttl', jk='$jk', alamat='$alamat', telp_siswa='$telp_siswa', agama='$agama', asal_sekolah='$asal_sekolah', ijazah='$ijazah', rapor='$rapor', prestasi='$prestasi', nama_ortu='$nama_ortu', pekerjaan='$pekerjaan', telp_ortu='$telp_ortu', pendidikan='$pendidikan' WHERE user_id='$user_id'";

  if (mysqli_query($link, $sql)) {
    $_SESSION['success'] = "Data Berhasil diubah!";
    header("Location: index.php");
    exit();
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($link);
  }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard 2</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="plugins/bs-stepper/css/bs-stepper.min.css">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="plugins/dropzone/min/dropzone.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
</head>

<body>
  <div class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
  
      <!-- Preloader -->
      <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__wobble" src="dist/img/logo-smktelkom.png" alt="SMK Telkom" height="60" width="60">
      </div>
  
      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-dark">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item">
            <a href="index.php">
              <button type="button" class="btn btn-warning btn-block">
              <i class="fas fa-chevron-left"></i>
                <span class="m-1"> Kembali</span> 
              </button>
            </a>
          </li>
        </ul>
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
          <!-- Messages Dropdown Menu -->
          <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
              <i class="fas fa-expand-arrows-alt"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
              <i class="fas fa-th-large"></i>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.navbar -->
  
      <!-- Main Sidebar Container -->
      <?php include('sidebar.php') ?>
  
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0"><strong>Formulir Pendaftaran Jalur Reguler</strong></h1>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
  
        <!-- Main content -->
        <section class="content">
          <form action="" method="post" enctype="multipart/form-data">
            <div class="container-fluid">
              <!-- Info boxes -->
              <div class="row">
                <div class="col-md-12">
                  <div class="card card-secondary">
                    <div class="card-header">
                      <h3 class="card-title">Data Diri</h3>
        
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                      </div>
                      <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <div class="card-body">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Nama Lengkap</label>
                          <input type="text" name="nama_siswa" value="<?= $data['nama_siswa'] ?>" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                          <label>Tempat, Tanggal Lahir</label>
                          <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <input type="text" name="ttl" value="<?php echo $data['ttl'] ?>" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Jenis Kelamin</label>
                          <div class="input-group">
                            <select class="form-control select1" name="jk">
                              <option disabled="disabled" selected="selected">Pilih</option>
                              <option value="laki-laki" <?php if($data['jk'] == "laki-laki") echo "selected"; ?>>Laki-Laki</option>
                              <option value="perempuan" <?php if($data['jk'] == "perempuan") echo "selected"; ?>>Perempuan</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Alamat Lengkap</label>
                          <textarea class="form-control" name="alamat" id=""><?php echo $data['alamat'] ?></textarea>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">No. Telp/HP</label>
                          <input type="number" id="telp_siswa" maxlength="12" value="<?php echo $data['telp_siswa'] ?>" name="telp_siswa" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="form-group">
                          <label>Agama</label>
                          <div class="input-group">
                            <select class="form-control select1" name="agama">
                              <option disabled="disabled" selected="selected">Pilih</option>
                              <option value="islam" <?php if($data['agama'] == "islam") echo "selected"; ?>>Islam</option>
                              <option value="protestan" <?php if($data['agama'] == "protestan") echo "selected"; ?>>Protestan</option>
                              <option value="katolik" <?php if($data['agama'] == "katolik") echo "selected"; ?>>Katolik</option>
                              <option value="hindu" <?php if($data['agama'] == "hindu") echo "selected"; ?>>Hindu</option>
                              <option value="buddha" <?php if($data['agama'] == "buddha") echo "selected"; ?>>Buddha</option>
                              <option value="konghucu" <?php if($data['agama'] == "konghucu") echo "selected"; ?>>Konghucu</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Asal Sekolah</label>
                          <input type="text" name="asal_sekolah" value="<?php echo $data['asal_sekolah'] ?>" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="form-group">
                          <label for="ijazahInputFile">Ijazah</label>
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" name="ijazah" class="custom-file-input" id="ijazahInputFile" accept=".pdf">
                              <label class="custom-file-label" for="ijazahInputFile"><?php echo $data['ijazah'] ?></label>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="raporInputFile">Rapor</label>
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" name="rapor" class="custom-file-input" id="raporInputFile" accept=".pdf">
                              <label class="custom-file-label" for="raporInputFile"><?php echo $data['rapor'] ?></label>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="prestasiInputFile">Prestasi</label>
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" name="prestasi" class="custom-file-input" id="prestasiInputFile" accept=".pdf">
                              <label class="custom-file-label" for="prestasiInputFile"><?php echo $data['prestasi'] ?></label>
                            </div>
                          </div>
                        </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
                <div class="col-md-12">
                  <div class="card card-secondary">
                    <div class="card-header">
                      <h3 class="card-title">Data Orang Tua</h3>
        
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                      </div>
                      <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <div class="card-body">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Nama Lengkap Orang Tua/Wali</label>
                          <input type="text" name="nama_ortu" value="<?php echo $data['nama_ortu'] ?>" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Pekerjaan Orang Tua</label>
                          <input type="text" name="pekerjaan" value="<?php echo $data['pekerjaan'] ?>" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">No. Telp/HP Orang Tua/Wali</label>
                          <input type="number" id="telp_ortu" value="<?php echo $data['telp_ortu'] ?>" maxlength="12" name="telp_ortu" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="form-group">
                          <label>Pendidikan Terakhir Orang Tua/Wali</label>
                          <div class="input-group">
                            <select class="form-control select1" name="pendidikan">
                              <option disabled="disabled" selected="selected">Pilih</option>
                              <option value="SD" <?php if($data['pendidikan'] == "SD") echo "selected"; ?>>SD</option>
                              <option value="SMP" <?php if($data['pendidikan'] == "SMP") echo "selected"; ?>>SMP</option>
                              <option value="SMA/SMK" <?php if($data['pendidikan'] == "SMA/SMK") echo "selected"; ?>>SMA/SMK</option>
                              <option value="D3" <?php if($data['pendidikan'] == "D3") echo "selected"; ?>>D3</option>
                              <option value="S1/D4" <?php if($data['pendidikan'] == "S1/D4") echo "selected"; ?>>S1/D4</option>
                              <option value="S2" <?php if($data['pendidikan'] == "S2") echo "selected"; ?>>S2</option>
                              <option value="S3" <?php if($data['pendidikan'] == "S3") echo "selected"; ?>>S3</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <div class="card-footer mb-4">
                    <button type="submit" name="edit" class="btn btn-success form-control">
                      <i class="fa fa-check"></i>
                    </button>
                  </div>
                  <!-- /.card -->
                </div>
              </div>
              <!-- /.row -->
            </div><!--/. container-fluid -->
          </form>
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
  
      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
  
      <!-- Main Footer -->
      <footer class="main-footer">
        <strong>Copyright &copy; 2024 SkuyBro.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
          <a href="login.html">
            <button type="submit" class="btn btn-outline-danger btn-block">Log Out 
              <i class="fa fa-sign-out-alt"></i>
            </button>
          </a>
        </div>
      </footer>
    </div>
  </div>
  <!-- ./wrapper -->


<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="plugins/raphael/raphael.min.js"></script>
<script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard2.js"></script>
<!-- SweetAlert2 -->
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- alert -->
<script>
  $(function() {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    $('.swalDefaultSuccess').click(function() {
      Toast.fire({
        icon: 'success',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultInfo').click(function() {
      Toast.fire({
        icon: 'info',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultError').click(function() {
      Toast.fire({
        icon: 'error',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultWarning').click(function() {
      Toast.fire({
        icon: 'warning',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultQuestion').click(function() {
      Toast.fire({
        icon: 'question',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });

    $('.toastrDefaultSuccess').click(function() {
      toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
    $('.toastrDefaultInfo').click(function() {
      toastr.info('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
    $('.toastrDefaultError').click(function() {
      toastr.error('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
    $('.toastrDefaultWarning').click(function() {
      toastr.warning('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });

    $('.toastsDefaultDefault').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultTopLeft').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        position: 'topLeft',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultBottomRight').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        position: 'bottomRight',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultBottomLeft').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        position: 'bottomLeft',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultAutohide').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        autohide: true,
        delay: 750,
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultNotFixed').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        fixed: false,
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultFull').click(function() {
      $(document).Toasts('create', {
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        icon: 'fas fa-envelope fa-lg',
      })
    });
    $('.toastsDefaultFullImage').click(function() {
      $(document).Toasts('create', {
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        image: '../../dist/img/user3-128x128.jpg',
        imageAlt: 'User Picture',
      })
    });
    $('.toastsDefaultSuccess').click(function() {
      $(document).Toasts('create', {
        class: 'bg-success',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultInfo').click(function() {
      $(document).Toasts('create', {
        class: 'bg-info',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultWarning').click(function() {
      $(document).Toasts('create', {
        class: 'bg-warning',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultDanger').click(function() {
      $(document).Toasts('create', {
        class: 'bg-danger',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultMaroon').click(function() {
      $(document).Toasts('create', {
        class: 'bg-maroon',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
  });
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- BS-Stepper -->
<script src="plugins/bs-stepper/js/bs-stepper.min.js"></script>
<!-- dropzonejs -->
<script src="plugins/dropzone/min/dropzone.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

    //Date and time picker
    $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })

    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    })

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })

  })
  // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  })

  // DropzoneJS Demo Code Start
  Dropzone.autoDiscover = false

  // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
  var previewNode = document.querySelector("#template")
  previewNode.id = ""
  var previewTemplate = previewNode.parentNode.innerHTML
  previewNode.parentNode.removeChild(previewNode)

  var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
    url: "/target-url", // Set the url
    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,
    previewTemplate: previewTemplate,
    autoQueue: false, // Make sure the files aren't queued until manually added
    previewsContainer: "#previews", // Define the container to display the previews
    clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
  })

  myDropzone.on("addedfile", function(file) {
    // Hookup the start button
    file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
  })

  // Update the total progress bar
  myDropzone.on("totaluploadprogress", function(progress) {
    document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
  })

  myDropzone.on("sending", function(file) {
    // Show the total progress bar when upload starts
    document.querySelector("#total-progress").style.opacity = "1"
    // And disable the start button
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
  })

  // Hide the total progress bar when nothing's uploading anymore
  myDropzone.on("queuecomplete", function(progress) {
    document.querySelector("#total-progress").style.opacity = "0"
  })

  // Setup the buttons for all transfers
  // The "add files" button doesn't need to be setup because the config
  // `clickable` has already been specified.
  document.querySelector("#actions .start").onclick = function() {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
  }
  document.querySelector("#actions .cancel").onclick = function() {
    myDropzone.removeAllFiles(true)
  }
  // DropzoneJS Demo Code End
</script>
<script>
  $(document).ready(function () {
      // Fungsi untuk menampilkan nama file
      function showFileName(input) {
          var fileName = input.val().split('\\').pop();
          input.next('.custom-file-label').html(fileName);
      }

      // Handler untuk input file Ijazah
      $('#ijazahInputFile').on('change', function () {
          showFileName($(this));
      });

      // Handler untuk input file Rapor
      $('#raporInputFile').on('change', function () {
          showFileName($(this));
      });

      // Handler untuk input file Prestasi
      $('#prestasiInputFile').on('change', function () {
          showFileName($(this));
      });
  });
</script>
<script>
  document.getElementById('telp_siswa').addEventListener('input', function (e) {
      if (this.value.length > this.maxLength) {
          this.value = this.value.slice(0, this.maxLength);
      }
  });
  document.getElementById('telp_ortu').addEventListener('input', function (e) {
      if (this.value.length > this.maxLength) {
          this.value = this.value.slice(0, this.maxLength);
      }
  });
</script>
<!-- SweetAlert2 -->
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- alert -->
<script>
  $(function() {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    $('.swalDefaultSuccess').click(function() {
      Toast.fire({
        icon: 'success',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultInfo').click(function() {
      Toast.fire({
        icon: 'info',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultError').click(function() {
      Toast.fire({
        icon: 'error',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultWarning').click(function() {
      Toast.fire({
        icon: 'warning',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultQuestion').click(function() {
      Toast.fire({
        icon: 'question',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });

    $('.toastrDefaultSuccess').click(function() {
      toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
    $('.toastrDefaultInfo').click(function() {
      toastr.info('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
    $('.toastrDefaultError').click(function() {
      toastr.error('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
    $('.toastrDefaultWarning').click(function() {
      toastr.warning('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });

    $('.toastsDefaultDefault').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultTopLeft').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        position: 'topLeft',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultBottomRight').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        position: 'bottomRight',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultBottomLeft').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        position: 'bottomLeft',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultAutohide').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        autohide: true,
        delay: 750,
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultNotFixed').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        fixed: false,
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultFull').click(function() {
      $(document).Toasts('create', {
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        icon: 'fas fa-envelope fa-lg',
      })
    });
    $('.toastsDefaultFullImage').click(function() {
      $(document).Toasts('create', {
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        image: '../../dist/img/user3-128x128.jpg',
        imageAlt: 'User Picture',
      })
    });
    $('.toastsDefaultSuccess').click(function() {
      $(document).Toasts('create', {
        class: 'bg-success',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultInfo').click(function() {
      $(document).Toasts('create', {
        class: 'bg-info',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultWarning').click(function() {
      $(document).Toasts('create', {
        class: 'bg-warning',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultDanger').click(function() {
      $(document).Toasts('create', {
        class: 'bg-danger',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultMaroon').click(function() {
      $(document).Toasts('create', {
        class: 'bg-maroon',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
  });
</script>
</body>
</html>