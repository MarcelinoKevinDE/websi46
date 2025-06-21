<?php
if (isset($_POST["submit"])) {
  $username = $_POST["username"];
  $dataFile = "users.json";
  $users = file_exists($dataFile) ? json_decode(file_get_contents($dataFile), true) : [];

  if (isset($users[$username])) {
    $message = "Akun ditemukan. Silakan hubungi admin untuk reset password.";
  } else {
    $error = "Username tidak ditemukan.";
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Lupa Password</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: #f0f0f0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      flex-direction: column;
    }

    .card {
      width: 360px;
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
      display: flex;
      flex-direction: column;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .form-group input {
      width: 100%;
      padding: 10px;
      font-size: 14px;
      border: 1px solid #ccc;
      border-radius: 8px;
    }

    .btn {
      padding: 12px;
      background: #999;
      border: none;
      color: white;
      border-radius: 8px;
      cursor: pointer;
      font-size: 16px;
      width: 100%;
    }

    .btn:hover {
      background: #777;
    }

    .message {
      text-align: center;
      font-size: 14px;
      margin-bottom: 10px;
    }

    .message.success {
      color: green;
    }

    .message.error {
      color: red;
    }

    .footer-link {
      margin-top: 20px;
      text-align: center;
      font-size: 14px;
    }

    .footer-link a {
      color: #333;
      text-decoration: none;
    }

    .footer-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <div class="card">
    <?php if (isset($message)) echo "<div class='message success'>$message</div>"; ?>
    <?php if (isset($error)) echo "<div class='message error'>$error</div>"; ?>

    <form method="post">
      <div class="form-group">
        <input type="text" name="username" placeholder="Masukkan Username" required>
      </div>
      <button type="submit" name="submit" class="btn">Cek Akun</button>
    </form>

    <div class="footer-link">
      <a href="login.php">← Kembali ke Login</a>
    </div>
  </div>

</body>
</html>
