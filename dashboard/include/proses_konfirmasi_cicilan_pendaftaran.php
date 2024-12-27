<?php
session_start();
include '../../koneksi/koneksi.php';

if (isset($_GET['id']) && isset($_GET['idd'])) {
    // ID Cicilan pendaftaran
    $id = $_GET['id'];
    // ID detail pendaftaran
    $idd = $_GET['idd'];

    $date = substr(date('Y'), 2, 4);

    // Query untuk mendapatkan nis terakhir siswa
    $query = "SELECT * FROM siswa ORDER BY nis DESC LIMIT 1";
    $baris = mysqli_query($conn, $query);
    if ($baris) {
        if (mysqli_num_rows($baris) > 0) {
            $auto = mysqli_fetch_array($baris);
            $kode = $auto['nis'];
            $baru = substr($kode, 2, 6);
            $nol = (int)$baru;
        } else {
            $nol = 0;
        }
        $nol = $nol + 1;
        $nol2 = str_pad($nol, 4, '0', STR_PAD_LEFT);
        $kode2 = $date . $nol2 . $nol;
    } else {
        echo mysqli_error($conn);
        exit; // Menghentikan eksekusi jika terjadi kesalahan
    }

    // Query ubah status cicilan menjadi 1(sudah dikonfirmasi oleh admin)
    $query = "UPDATE cicilan_pendaftaran SET status_cicilan=1 WHERE Id=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    $exec = mysqli_stmt_execute($stmt);

    if ($exec) {
        // Query mendapatkan metode pembayaran dan kelas yang didapat oleh siswa
        $queryMetodePembayaran = "SELECT metode_pembayaran_pendaftaran, kelas FROM detail_pendaftaran WHERE Id=?";
        $stmt2 = mysqli_prepare($conn, $queryMetodePembayaran);
        mysqli_stmt_bind_param($stmt2, "i", $idd);
        mysqli_stmt_execute($stmt2);
        $resultMetodePembayaran = mysqli_stmt_get_result($stmt2);

        if ($resultMetodePembayaran) {
            $payment = mysqli_fetch_array($resultMetodePembayaran);
            $metode_pembayaran = $payment['metode_pembayaran_pendaftaran'];
            $kelas = $payment['kelas'];

            // Query untuk insert data ke dalam table siswa setelah melakukan pembayaran pertama
            if ($metode_pembayaran == "L") {
                $status_pendaftaran = 4;
                $queryNis = "INSERT INTO siswa VALUES (?, ?, ?, ?)";
                $stmt3 = mysqli_prepare($conn, $queryNis);
                mysqli_stmt_bind_param($stmt3, "ssis", $kode2, $kelas, $idd, $nama);
                $execNis = mysqli_stmt_execute($stmt3);
                if (!$execNis) {
                    echo mysqli_error($conn);
                    exit;
                }
            } else {
                $queryCountCicilan = "SELECT SUM(nominal) as nom FROM cicilan_pendaftaran WHERE id_detail_pendaftaran=?";
                $stmt4 = mysqli_prepare($conn, $queryCountCicilan);
                mysqli_stmt_bind_param($stmt4, "i", $idd);
                mysqli_stmt_execute($stmt4);
                $resultCountCicilan = mysqli_stmt_get_result($stmt4);
                if ($resultCountCicilan) {
                    $row = mysqli_fetch_array($resultCountCicilan);
                    $countNominal = $row['nom'];

                    if ($kelas == "A" && $countNominal >= 880000 || $kelas == "B" && $countNominal >= 895000) {
                        $status_pendaftaran = 4;
                    } else {
                        $status_pendaftaran = 3;
                    }

                    if ($status_pendaftaran == 3) {
                        echo 'kelas B';
                    }

                    // Query untuk insert data ke dalam table siswa setelah melakukan pembayaran pertama
                    if ($status_pendaftaran == 3) {
                        $queryNis = "INSERT INTO siswa VALUES (?, ?, ?, ?)";
                        $stmt5 = mysqli_prepare($conn, $queryNis);
                        mysqli_stmt_bind_param($stmt5, "ssis", $kode2, $kelas, $idd, $nama);
                        $execNis = mysqli_stmt_execute($stmt5);
                        if (!$execNis) {
                            echo mysqli_error($conn);
                            exit;
                        }
                    }
                } else {
                    echo mysqli_error($conn);
                    exit;
                }
            }

            // Update status pendaftaran
            $queryDetailPendaftaran = "UPDATE detail_pendaftaran SET status_pendaftaran=? WHERE Id=?";
            $stmt6 = mysqli_prepare($conn, $queryDetailPendaftaran);
            mysqli_stmt_bind_param($stmt6, "ii", $status_pendaftaran, $idd);
            $execStatusPendaftaran = mysqli_stmt_execute($stmt6);

            if ($execStatusPendaftaran) {
                $_SESSION['message'] = "1";
                echo '<script>window.location="../index.php?page=17"</script>';
            } else {
                echo mysqli_error($conn);
            }
        }
    } else {
        echo mysqli_error($conn);
    }
} else {
    echo 'tidak ada';
}
?>
