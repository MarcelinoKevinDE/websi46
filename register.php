<?php
session_start();

if (isset($_POST["register"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];

  $dataFile = "users.json";

  $users = file_exists($dataFile) ? json_decode(file_get_contents($dataFile), true) : [];

  // Cek jika username sudah ada
  if (isset($users[$username])) {
    $error = "Username sudah terdaftar!";
  } else {
    $users[$username] = password_hash($password, PASSWORD_DEFAULT);
    file_put_contents($dataFile, json_encode($users, JSON_PRETTY_PRINT));
    $success = "Registrasi berhasil! Silakan login.";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
</head>
<body>
  <h2>Form Registrasi</h2>
  <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
  <?php if (isset($success)) echo "<p style='color:green;'>$success</p>"; ?>

  <form method="post">
    <input type="text" name="username" placeholder="Username" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <button type="submit" name="register">Daftar</button>
  </form>
  <br>
  <a href="login.php">Kembali ke Login</a>
</body>
</html>
