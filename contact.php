<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kontak Kami</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f0f0f0;
      margin: 0;
    }
    .navbar {
      background-color: #BFD8B8;
      color: black;
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
      color: black;
      margin-left: 20px;
      text-decoration: none;
      font-weight: bold;
    }
    .navbar .menu a:hover {
      text-decoration: underline;
    }
    .container {
      background-color: white;
      margin: 30px auto;
      padding: 30px;
      border-radius: 8px;
      width: 80%;
      max-width: 600px;
      text-align: center;
    }
    h3 {
      color: #333;
    }
    p {
      font-size: 16px;
      color: #555;
      margin-bottom: 20px;
    }
    .whatsapp-btn {
      display: inline-block;
      padding: 12px 20px;
      background-color: #25D366;
      color: white;
      text-decoration: none;
      font-weight: bold;
      border-radius: 5px;
      font-size: 16px;
      transition: background-color 0.3s ease;
    }
    .whatsapp-btn i {
      margin-right: 8px;
    }
    .whatsapp-btn:hover {
      background-color: #1ebe5d;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<div class="navbar">
  <div class="title">PEMOGRAMAN WEB SI 46</div>
  <div class="menu">
    <a href="index.php">HOME</a>
    <a href="blog.php">BLOG</a>
    <a href="about.php">ABOUT</a>
    <a href="contact.php">CONTACT</a>
  </div>
</div>

<!-- Konten -->
<div class="container">
  <h3>Hubungi Kami</h3>
  <p>Untuk pertanyaan atau informasi lebih lanjut, silakan hubungi kami langsung melalui WhatsApp.</p>

  <a class="whatsapp-btn" href="https://wa.me/62089516378382" target="_blank">
    <i class="fab fa-whatsapp"></i> Hubungi via WhatsApp
  </a>
</div>

</body>
</html>

