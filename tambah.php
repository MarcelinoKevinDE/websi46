<?php
session_start();
if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

$conn = mysqli_connect("localhost", "root", "", "dbakademiksi46");

if (isset($_POST["submit"])) {
  $nim = $_POST["nim"];
  $nama = $_POST["nama"];
  $kelas = $_POST["kelas"];
  $prodi = $_POST["prodi"];
  $alamat = $_POST["alamat"];
  $nohp = $_POST["nohp"];
  $email = $_POST["email"];
  $jkl = $_POST["jkl"];

  $fotoName = $_FILES["foto"]["name"];
  $fotoTmp = $_FILES["foto"]["tmp_name"];
  move_uploaded_file($fotoTmp, "img/" . $fotoName);

  $query = "INSERT INTO tbmahasiswa (nim, nama, kelas, prodi, alamat, nohp, email, jkl, foto)
            VALUES ('$nim', '$nama', '$kelas', '$prodi', '$alamat', '$nohp', '$email', '$jkl', '$fotoName')";
  mysqli_query($conn, $query);

  echo "<script>alert('Data berhasil ditambahkan!'); window.location='index.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head><title>Tambah Data</title></head>
<body>
<h3>Tambah Data Mahasiswa</h3>
<form method="post" enctype="multipart/form-data">
  <ul>
    <li><input type="text" name="nim" placeholder="NIM" required></li>
    <li><input type="text" name="nama" placeholder="Nama" required></li>
    <li><input type="text" name="kelas" placeholder="Kelas" required></li>
    <li><input type="text" name="prodi" placeholder="Prodi" required></li>
    <li><input type="text" name="alamat" placeholder="Alamat" required></li>
    <li><input type="text" name="nohp" placeholder="No HP" required></li>
    <li><input type="email" name="email" placeholder="Email" required></li>
    <li>
      <select name="jkl" required>
        <option value="">-- Pilih Jenis Kelamin --</option>
        <option value="l">Laki-laki</option>
        <option value="p">Perempuan</option>
      </select>
    </li>
    <li><input type="file" name="foto" required></li>
    <li>
      <button type="submit" name="submit">Simpan</button>
      <button type="button" onclick="window.location='index.php'">Batal</button>
    </li>
  </ul>
</form>
</body>
</html>



