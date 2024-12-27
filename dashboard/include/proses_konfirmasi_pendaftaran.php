<?php  
session_start();
include '../../koneksi/koneksi.php';

date_default_timezone_set("Asia/Jakarta");

if (isset($_GET['idd'], $_GET['idu'])) {
    $idu = $_GET['idu'];
    $idd = $_GET['idd'];

    $queryAge = "SELECT tanggal_lahir FROM pendaftaran WHERE Id = ?";
    $stmt = mysqli_prepare($conn, $queryAge);
    mysqli_stmt_bind_param($stmt, "i", $idd);
    $exec2 = mysqli_stmt_execute($stmt);

    if ($exec2) {
        $result = mysqli_stmt_get_result($stmt);
        $tanggal_lahir = mysqli_fetch_array($result);
        $kelas = findage($tanggal_lahir['tanggal_lahir']);
        $age = getAge($tanggal_lahir['tanggal_lahir']);
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    $query = "UPDATE detail_pendaftaran SET status_pendaftaran=1, id_admin=?, kelas=?, usia=? WHERE id_user=?";
    $stmt2 = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt2, "issi", $idu, $kelas, $age, $idd);
    $exec = mysqli_stmt_execute($stmt2);

    if ($exec) {
        $_SESSION['message'] = "1";
        echo '<script>window.location="../index.php?page=7"</script>';
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo 'tidak ada';
}

function findage($dob)
{
    $dob = strtotime($dob);
    $current_time = time();

    $age_years = date('Y', $current_time) - date('Y', $dob);
    $age_months = date('m', $current_time) - date('m', $dob);
    $age_days = date('d', $current_time) - date('d', $dob);

    if ($age_days < 0) {
        $days_in_month = date('t', $current_time);
        $age_months--;
        $age_days = $days_in_month + $age_days;
    }

    if ($age_months < 0) {
        $age_years--;
        $age_months = 12 + $age_months;
    }

    if ($age_years > 6 && $age_months > 6) {
        $kelas = "B";
    } else {
        $kelas = "A";
    }

    return $kelas;
}

function getAge($dob)
{
    $dob = strtotime($dob);
    $current_time = time();

    $age_years = date('Y', $current_time) - date('Y', $dob);
    $age_months = date('m', $current_time) - date('m', $dob);
    $age_days = date('d', $current_time) - date('d', $dob);

    if ($age_days < 0) {
        $days_in_month = date('t', $current_time);
        $age_months--;
        $age_days = $days_in_month + $age_days;
    }

    if ($age_months < 0) {
        $age_years--;
        $age_months = 12 + $age_months;
    }

    $age = $age_years . " tahun " . $age_months . " bulan";

    return $age;
}
?>
