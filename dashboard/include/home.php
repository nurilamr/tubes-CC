<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard <?php echo htmlspecialchars($role); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
        }

        .kelas-container {
            display: flex;
            justify-content: space-around;
            align-items: flex-start; /* Align items to the top */
            margin-top: 20px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .kelas {
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            width: 200px;
            text-align: center;
            margin: 10px;
        }

        .kelas-a {
            background-color: #cce5ff; /* warna biru untuk kelas A */
        }

        .kelas-b {
            background-color: #d4edda; /* warna hijau untuk kelas B */
        }

        .kelas:hover {
            transform: translateY(-5px);
        }

        .kelas .title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .kelas .count {
            font-size: 24px;
            color: #333;
        }

        .kelas .keterangan {
            font-size: 14px;
            color: #777;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <h2>Selamat Datang, <?php echo htmlspecialchars($role == "Admin" ? $nama_admin : $nama); ?></h2>

    <div class="kelas-container">
        <div class="kelas kelas-a">
            <div class="title">Kelas A</div>
            <?php
            // Query untuk menghitung jumlah pendaftar kelas A
            $query_kelas_a = "SELECT COUNT(*) as total_kelas_a FROM detail_pendaftaran WHERE kelas = 'A'";
            $result_kelas_a = mysqli_query($conn, $query_kelas_a);
            $row_kelas_a = mysqli_fetch_assoc($result_kelas_a);
            $total_kelas_a = $row_kelas_a['total_kelas_a'];
            ?>
            <div class="count"><?php echo htmlspecialchars($total_kelas_a); ?></div>
            <div class="keterangan">Siswa</div>
        </div>

        <div class="kelas kelas-b">
            <div class="title">Kelas B</div>
            <?php
            // Query untuk menghitung jumlah pendaftar kelas B
            $query_kelas_b = "SELECT COUNT(*) as total_kelas_b FROM detail_pendaftaran WHERE kelas = 'B'";
            $result_kelas_b = mysqli_query($conn, $query_kelas_b);
            $row_kelas_b = mysqli_fetch_assoc($result_kelas_b);
            $total_kelas_b = $row_kelas_b['total_kelas_b'];
            ?>
            <div class="count"><?php echo htmlspecialchars($total_kelas_b); ?></div>
            <div class="keterangan">Siswa</div>
        </div>
    </div>
</body>
</html>
