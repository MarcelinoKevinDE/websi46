<?php
session_start();
if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

$conn = mysqli_connect("localhost", "root", "", "dbakademiksi46");

$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
$query = "SELECT * FROM tbmahasiswa";
if ($keyword != '') {
  $query .= " WHERE nim LIKE '%$keyword%' OR nama LIKE '%$keyword%' OR prodi LIKE '%$keyword%'";
}
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Data Mahasiswa</title>
  <style>
    .bg-container {
      position: fixed;
      top: 0;
      left: 0;
      z-index: -1;
      width: 100%;
      height: 100%;
      --s: 84px;
      --c1: #f2f2f2;
      --c2: #cdcbcc;
      --c3: #999999;
      --_g: 0 120deg, #0000 0;
      background: conic-gradient(from 0deg at calc(500% / 6) calc(100% / 3), var(--c3) var(--_g)),
                  conic-gradient(from -120deg at calc(100% / 6) calc(100% / 3), var(--c2) var(--_g)),
                  conic-gradient(from 120deg at calc(100% / 3) calc(500% / 6), var(--c1) var(--_g)),
                  conic-gradient(from 120deg at calc(200% / 3) calc(500% / 6), var(--c1) var(--_g)),
                  conic-gradient(from -180deg at calc(100% / 3) 50%, var(--c2) 60deg, var(--c1) var(--_g)),
                  conic-gradient(from 60deg at calc(200% / 3) 50%, var(--c1) 60deg, var(--c3) var(--_g)),
                  conic-gradient(from -60deg at 50% calc(100% / 3), var(--c1) 120deg, var(--c2) 0 240deg, var(--c3) 0);
      background-size: calc(var(--s) * 1.732) var(--s);
    }

    body {
      font-family: Arial;
      margin: 0;
      background-color: #f0f0f0;
    }

    h3 {
      text-align: center;
      margin-top: 20px;
      color: black;
    }

    .navbar {
      background-color: #1d3557;
      color: white;
      padding: 15px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .navbar .title {
      font-weight: bold;
      font-size: 18px;
    }

    .navbar .menu a {
      color: white;
      margin-left: 20px;
      text-decoration: none;
      font-weight: bold;
    }

    .navbar .menu a:hover {
      text-decoration: underline;
    }

    .container {
      background: #fff;
      padding: 20px;
      margin: 20px;
      border-radius: 8px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      padding: 10px;
      border: 1px solid #ccc;
    }

    th {
      background: #d9d9d9;
      color: black;
    }

    img {
      width: 60px;
    }

    a {
      text-decoration: none;
      margin: 0 5px;
    }

    .btn {
      padding: 8px 12px;
      background: #1d3557;
      color: white;
      border-radius: 4px;
      display: inline-block;
      margin-bottom: 10px;
    }

    .btn.excel {
      background: #007bff;
    }

    .btn.pdf {
      background: #dc3545;
    }

    input[type="text"] {
      padding: 6px;
      width: 200px;
      color: black;
    }

    button {
      padding: 6px 10px;
      background: #999;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    button:hover {
      background: #777;
    }
  </style>
</head>
<body>

<div class="bg-container"></div>

<div class="navbar">
  <div class="title">PEMOGRAMAN WEB SI 46</div>
  <div class="menu">
    <a href="index.php">HOME</a>
    <a href="blog.php">BLOG</a>
    <a href="about.php">ABOUT</a>
    <a href="contact.php">CONTACT</a>
  </div>
</div>

<h3>Data Mahasiswa</h3>
<div class="container">
  <form method="get" style="margin-bottom: 10px;">
    <input type="text" name="keyword" placeholder="Cari NIM/Nama/Prodi" value="<?= htmlspecialchars($keyword); ?>">
    <button type="submit">Cari</button>
    <a href="logout.php" style="float: right; background: #dc3545; color: white; padding: 6px 10px; text-decoration: none; border-radius: 4px;">Logout</a>
  </form>

  <a class="btn" href="tambah.php">+ Tambah Data</a>
  <a class="btn excel" href="export_excel.php">Export Excel</a>
  <a class="btn pdf" href="export_pdf.php">Export PDF</a>

  <table>
    <tr>
      <th>No</th>
      <th>Foto</th>
      <th>NIM</th>
      <th>Nama</th>
      <th>Kelas</th>
      <th>Prodi</th>
      <th>Alamat</th>
      <th>No HP</th>
      <th>Email</th>
      <th>JKL</th>
      <th>Aksi</th>
    </tr>
    <?php $i = 1; while ($m = mysqli_fetch_assoc($result)) : ?>
    <tr>
      <td><?= $i++; ?></td>
      <td><img src="img/<?= $m['foto']; ?>"></td>
      <td><?= $m['nim']; ?></td>
      <td><?= $m['nama']; ?></td>
      <td><?= $m['kelas']; ?></td>
      <td><?= $m['prodi']; ?></td>
      <td><?= $m['alamat']; ?></td>
      <td><?= $m['nohp']; ?></td>
      <td><?= $m['email']; ?></td>
      <td><?= $m['jkl'] == 'l' ? 'Laki-laki' : 'Perempuan'; ?></td>
      <td>
        <a href="update.php?nim=<?= $m['nim']; ?>">Update</a> |
        <a href="delete.php?nim=<?= $m['nim']; ?>" onclick="return confirm('Yakin?')">Delete</a>
      </td>
    </tr>
    <?php endwhile; ?>
  </table>
</div>
</body>
</html>
