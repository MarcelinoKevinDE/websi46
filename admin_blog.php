<?php
$conn = mysqli_connect("localhost", "root", "", "dbakademiksi46");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = $_POST['judul'];
    $konten = $_POST['konten'];
    $query = "INSERT INTO tb_blog (judul, konten) VALUES ('$judul', '$konten')";
    mysqli_query($conn, $query);
    header("Location: blog.php"); // Setelah berhasil, kembali ke blog
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Artikel</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f0f0f0; margin: 0; }
        .navbar {
            background-color: #BFD8B8;
            color: black;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
        }
        .navbar .title { font-weight: bold; font-size: 18px; }
        .navbar .menu a {
            color: black;
            margin-left: 20px;
            text-decoration: none;
            font-weight: bold;
        }
        .container {
            background: white;
            padding: 20px;
            margin: 20px;
            border-radius: 8px;
        }
        .container h2 { color: #2d572c; }
    </style>
</head>
<body>

<!-- Navbar -->
<div class="navbar">
    <div class="title">Tambah Artikel</div>
    <div class="menu">
        <a href="blog.php">Kembali ke Blog</a>
    </div>
</div>

<!-- Form untuk menambah artikel -->
<div class="container">
    <h2>Tambah Artikel Baru</h2>
    <form method="post">
        <label for="judul">Judul Artikel:</label><br>
        <input type="text" name="judul" id="judul" required><br><br>
        
        <label for="konten">Konten Artikel:</label><br>
        <textarea name="konten" id="konten" rows="5" required></textarea><br><br>
        
        <button type="submit">Tambah Artikel</button>
    </form>
</div>

</body>
</html>
