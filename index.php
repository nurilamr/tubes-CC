<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penerimaan Siswa Baru - SMK Telkom Bandung</title>
    
    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Material Dashboard CSS -->
    <link href="assets/css/material-dashboard.css?v=1.2.0" rel="stylesheet">
    
    <!-- Font Awesome CSS -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    
    <!-- Google Fonts - Roboto -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="assets/css/main.css" rel="stylesheet">
    
    <!-- Demo CSS (remove this in production) -->
    <link href="assets/css/demo.css" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background: url('assets/img/siswa.jpg') no-repeat center center fixed; /* Tambahkan gambar latar belakang */
            background-size: cover; /* Menyesuaikan ukuran gambar */
        }
        .header {
            background-color: rgba(238, 51, 78, 0.8); /* Warna latar belakang header dengan transparansi */
            color: #ffffff; /* Warna teks header */
            text-align: center;
            padding: 20px 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
        }
        .header img {
            width: 100px;
            height: 100px;
            margin-right: 10px;
        }
        .header h1 {
            font-size: 32px;
            margin: 0;
        }
        .header p {
            font-size: 18px;
            margin-bottom: 0;
        }
        .card-background {
            padding: 40px;
            border-radius: 8px;
            background-color: rgba(255, 255, 255, 0.9); /* Warna latar belakang card dengan transparansi */
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
            max-width: 600px;
            margin: auto;
            margin-top: 20px;
        }
        .row-flex {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin-top: 30px;
        }
        .col-md-6 {
            flex-basis: 48%;
        }
        .student a, .note a {
            display: block;
            text-decoration: none;
            color: #333333; /* Warna teks link */
        }
        .student img, .note img {
            width: 100px;
            height: 100px;
            margin-bottom: 10px;
        }
        .student h3, .note h3 {
            font-size: 18px;
            margin-top: 0;
        }
        /* Style untuk desktop (lebar layar >= 992px) */
        @media (min-width: 992px) {
            .card-background {
                padding: 40px 80px;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="https://www.dbl.id/uploads/school/13763/965-SMK_TELKOM_MALANG.jpg" alt="Logo SMK TELKOM BANDUNG">
        <div>
            <h1>Penerimaan Peserta Didik Baru</h1>
            <p>SMK TELKOM BANDUNG <br>Tahun Pelajaran 2025/2026</p>
        </div>
    </div>
    
    <div class="card-background">
        <div class="row row-flex">
            <div class="col-md-6 col-sm-6 student">
                <a href="login.php">
                    <center><img src="assets/img/student.png" alt="Login"></center>
                    <center><h3>Masuk</h3></center>
                </a>
            </div>
            <div class="col-md-6 col-sm-6 note">
                <a href="daftar_akun.php">
                    <center><img src="assets/img/note.png" alt="Pendaftaran Siswa Baru"></center>
                    <center><h3>Daftar</h3></center>
                </a>
            </div> 
        </div>
    </div>
</body>
</html>
