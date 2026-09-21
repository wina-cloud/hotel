<?php
include 'config.php';

// Jika sudah login, langsung alihkan ke index.php
if (isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

$error = "";

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = md5($_POST['password']);

   $query = mysqli_query($koneksi, 
    "SELECT * FROM pengguna WHERE email='$email' AND password='$password'"
);

    if (mysqli_num_rows($query) > 0) {
        $user = mysqli_fetch_assoc($query);

        $_SESSION['login'] = true;
        $_SESSION['id'] = $user['id'];
        $_SESSION['nama'] = $user['nama'];
        $_SESSION['role'] = $user['role'];

        // Mengarahkan ke index.php setelah berhasil login
        header("Location: index.php");
        exit;
    } else {
        $error = "Email atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Hotel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="auth-body">

<div class="auth-box">
    <h2>🏨 Login Hotel Wina</h2>

    <?php if ($error): ?>
        <div class="alert error"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit" name="login">Login</button>
    </form>

    <p>Belum punya akun? <a href="register.php">Daftar</a></p>
</div>

</body>
</html>