<?php
session_start();

if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

$dataFile = "users.json";

if (isset($_POST["login"])) {
    $user = trim($_POST["username"]);
    $pass = $_POST["password"];

    if (file_exists($dataFile)) {
        $users = json_decode(file_get_contents($dataFile), true);

        if (isset($users[$user])) {
            if (password_verify($pass, $users[$user])) {
                $_SESSION["login"] = true;
                $_SESSION["username"] = $user;
                header("Location: index.php");
                exit;
            } else {
                $error = "Password salah!";
            }
        } else {
            $error = "Username tidak ditemukan!";
        }
    } else {
        $error = "File users.json tidak ditemukan!";
    }
}

if (isset($_POST["register"])) {
    $new_user = trim($_POST["new_username"]);
    $new_pass = password_hash($_POST["new_password"], PASSWORD_DEFAULT);
    $users = file_exists($dataFile) ? json_decode(file_get_contents($dataFile), true) : [];

    if (isset($users[$new_user])) {
        $error = "Username sudah terdaftar!";
    } else {
        $users[$new_user] = $new_pass;
        file_put_contents($dataFile, json_encode($users, JSON_PRETTY_PRINT));
        $success = "Akun berhasil dibuat, silakan login.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Login</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
            position: relative;
            overflow: hidden;
        }

        /* Background dari Uiverse.io */
        .container {
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
            background: conic-gradient(
                    from 0deg at calc(500% / 6) calc(100% / 3),
                    var(--c3) var(--_g)
                ),
                conic-gradient(
                    from -120deg at calc(100% / 6) calc(100% / 3),
                    var(--c2) var(--_g)
                ),
                conic-gradient(
                    from 120deg at calc(100% / 3) calc(500% / 6),
                    var(--c1) var(--_g)
                ),
                conic-gradient(
                    from 120deg at calc(200% / 3) calc(500% / 6),
                    var(--c1) var(--_g)
                ),
                conic-gradient(
                    from -180deg at calc(100% / 3) 50%,
                    var(--c2) 60deg,
                    var(--c1) var(--_g)
                ),
                conic-gradient(
                    from 60deg at calc(200% / 3) 50%,
                    var(--c1) 60deg,
                    var(--c3) var(--_g)
                ),
                conic-gradient(
                    from -60deg at 50% calc(100% / 3),
                    var(--c1) 120deg,
                    var(--c2) 0 240deg,
                    var(--c3) 0
                );
            background-size: calc(var(--s) * 1.732) var(--s);
        }

        .card-wrapper {
            position: relative;
            width: 360px;
            height: 420px;
            perspective: 1000px;
        }

        .flip-card {
            width: 100%;
            height: 100%;
            transition: transform 0.6s;
            transform-style: preserve-3d;
            position: relative;
        }

        .flip-card.flipped {
            transform: rotateY(180deg);
        }

        .card {
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 12px;
            background: white;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            padding: 30px;
            backface-visibility: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .card-back {
            transform: rotateY(180deg);
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

        .toggle-btn {
            margin-top: 15px;
            background: transparent;
            color: #555;
            border: none;
            cursor: pointer;
            font-size: 14px;
            text-decoration: underline;
            text-align: center;
        }

        .message {
            text-align: center;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .message.error {
            color: red;
        }

        .message.success {
            color: green;
        }

        .footer-box {
            background: white;
            margin-top: 20px;
            padding: 10px 15px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            font-size: 14px;
            text-align: center;
            width: 360px;
        }

        .footer-box a {
            color: #333;
            text-decoration: none;
        }

        .footer-box a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <!-- Background -->
    <div class="container"></div>

    <!-- Card Login/Register -->
    <div class="card-wrapper">
        <div class="flip-card" id="flipCard">

            <div class="card">
                <?php if (isset($error)) echo "<div class='message error'>$error</div>"; ?>
                <?php if (isset($success)) echo "<div class='message success'>$success</div>"; ?>
                <form method="POST">
                    <div class="form-group">
                        <input type="text" name="username" placeholder="Username" required />
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" placeholder="Password" required />
                    </div>
                    <button type="submit" name="login" class="btn">Masuk</button>
                </form>
                <button class="toggle-btn" onclick="flipCard()">Belum punya akun? Register</button>
            </div>

            <div class="card card-back">
                <form method="POST">
                    <div class="form-group">
                        <input type="text" name="new_username" placeholder="Username" required />
                    </div>
                    <div class="form-group">
                        <input type="password" name="new_password" placeholder="Password" required />
                    </div>
                    <button type="submit" name="register" class="btn">Daftar</button>
                </form>
                <button class="toggle-btn" onclick="flipCard()">Sudah punya akun? Login</button>
            </div>

        </div>
    </div>

    <div class="footer-box">
        <a href="forgot_password.php">Lupa Password?</a>
    </div>

    <script>
        function flipCard() {
            document.getElementById("flipCard").classList.toggle("flipped");
        }
    </script>

</body>
</html>
