<?php

include("koneksi.php");
session_start();

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "DELETE FROM pendaftar_reguler WHERE id='$id'";
  if (mysqli_query($link, $sql)) {
      $_SESSION['success'] = "Data berhasil dihapus.";
  } else {
      $_SESSION['error'] = "Terjadi kesalahan saat menghapus Data.";
  }
  header("Location: pendaftar-reguler.php");
} else {
  header("Location: pendaftar-reguler.php");
}

?>