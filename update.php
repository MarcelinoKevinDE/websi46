<?php
session_start();
if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

$conn = mysqli_connect("localhost", "root", "", "dbakademiksi46");
$nim = $_GET["nim"];
$data = mysqli_query($conn, "SELECT * FROM tbmahasiswa WHERE nim = '$nim'");
$m = mysqli_fetch_assoc($data);

if (isset($_POST["submit"])) {
  $nama = $_POST["nama"];
  $kelas = $_POST["kelas"];
  $prodi = $_POST["prodi"];
  $alamat = $_POST["alamat"];
  $nohp = $_POST["nohp"];
  $email = $_POST["email"];
  $jkl = $_POST["jkl"];

  if ($_FILES["foto"]["error"] === 0) {
    $fotoName = $_FILES["foto"]["name"];
    move_uploaded_file($_FILES["foto"]["tmp_name"], "img/" . $fotoName);
    if (file_exists("img/" . $m["foto"])) unlink("img/" . $m["foto"]);
  } else {
    $fotoName = $m["foto"];
  }

  $query = "UPDATE tbmahasiswa SET 
            nama='$nama', kelas='$kelas', prodi='$prodi',
            alamat='$alamat', nohp='$nohp', email='$email',
            jkl='$jkl', foto='$fotoName' 
            WHERE nim='$nim'";
  mysqli_query($conn, $query);

  echo "<script>alert('Data berhasil diupdate!'); window.location='index.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head><title>Edit Data</title></head>
<body>
<h3>Edit Data Mahasiswa</h3>
<form method="post" enctype="multipart/form-data">
  <ul>
    <li>NIM: <input type="text" value="<?= $m['nim']; ?>" readonly></li>
    <li><input type="text" name="nama" value="<?= $m['nama']; ?>" required></li>
    <li><input type="text" name="kelas" value="<?= $m['kelas']; ?>" required></li>
    <li><input type="text" name="prodi" value="<?= $m['prodi']; ?>" required></li>
    <li><input type="text" name="alamat" value="<?= $m['alamat']; ?>" required></li>
    <li><input type="text" name="nohp" value="<?= $m['nohp']; ?>" required></li>
    <li><input type="email" name="email" value="<?= $m['email']; ?>" required></li>
    <li>
      <select name="jkl">
        <option value="l" <?= $m["jkl"] == "l" ? "selected" : ""; ?>>Laki-laki</option>
        <option value="p" <?= $m["jkl"] == "p" ? "selected" : ""; ?>>Perempuan</option>
      </select>
    </li>
    <li>
      Foto: <input type="file" name="foto">
      <img src="img/<?= $m['foto']; ?>" width="80">
    </li>
    <li>
      <button type="submit" name="submit">Update</button>
      <button type="button" onclick="window.location='index.php'">Batal</button>
    </li>
  </ul>
</form>
</body>
</html>
