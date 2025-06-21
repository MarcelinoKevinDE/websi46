<?php
session_start();
if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

$conn = mysqli_connect("localhost", "root", "", "dbakademiksi46");
$nim = $_GET["nim"];

$data = mysqli_query($conn, "SELECT foto FROM tbmahasiswa WHERE nim = '$nim'");
$m = mysqli_fetch_assoc($data);
if (file_exists("img/" . $m["foto"])) {
  unlink("img/" . $m["foto"]);
}

mysqli_query($conn, "DELETE FROM tbmahasiswa WHERE nim = '$nim'");
echo "<script>alert('Data berhasil dihapus!'); window.location='index.php';</script>";
?>
