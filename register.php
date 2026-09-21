<?php

include "config.php";

$pesan = "";
$jenis_pesan = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {

    $nama_lengkap = trim($_POST["nama_lengkap"] ?? "");
    $username = trim($_POST["username"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";
    $konfirmasi = $_POST["konfirmasi"] ?? "";

    if (
        $nama_lengkap == "" ||
        $username == "" ||
        $email == "" ||
        $password == "" ||
        $konfirmasi == ""
    ) {

        $pesan = "Semua data wajib diisi!";
        $jenis_pesan = "error";

    } elseif ($password != $konfirmasi) {

        $pesan = "Password tidak cocok!";
        $jenis_pesan = "error";

    } else {

        $nama_lengkap = mysqli_real_escape_string($koneksi, $nama_lengkap);
        $username = mysqli_real_escape_string($koneksi, $username);
        $email = mysqli_real_escape_string($koneksi, $email);

        $cek = mysqli_query(
            $koneksi,
            "SELECT * FROM pengguna
             WHERE username='$username'
             OR email='$email'"
        );

        if (mysqli_num_rows($cek) > 0) {

            $pesan = "Username atau email sudah terdaftar!";
            $jenis_pesan = "error";

        } else {

            $password_hash = md5($password);

            $query = mysqli_query(
                $koneksi,
                "INSERT INTO pengguna
                (nama_lengkap, username, password, email, role)
                VALUES
                ('$nama_lengkap', '$username', '$password_hash', '$email', 'pelanggan')"
            );

            if ($query) {

                $pesan = "Registrasi berhasil! Silakan login.";
                $jenis_pesan = "success";

            } else {

                $pesan = "Registrasi gagal: " . mysqli_error($koneksi);
                $jenis_pesan = "error";
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register Hotel Wina</title>

    <link rel="stylesheet" href="css/register.css">

</head>

<body>

    <div class="register-container">

        <div class="register-card">

            <h1>🏨 Register Hotel Wina</h1>

            <p class="subtitle">
                Buat akun baru untuk melakukan reservasi hotel
            </p>

            <?php if ($pesan != "") { ?>

                <div class="pesan <?php echo $jenis_pesan; ?>">
                    <?php echo htmlspecialchars($pesan); ?>
                </div>

            <?php } ?>


            <form method="POST" action="register.php">

                <div class="form-group">

                    <label>Nama Lengkap</label>

                    <input
                        type="text"
                        name="nama_lengkap"
                        placeholder="Masukkan nama lengkap"
                        value="<?php echo htmlspecialchars($_POST['nama_lengkap'] ?? ''); ?>"
                        required
                    >

                </div>


                <div class="form-group">

                    <label>Username</label>

                    <input
                        type="text"
                        name="username"
                        placeholder="Masukkan username"
                        value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>"
                        required
                    >

                </div>


                <div class="form-group">

                    <label>Email</label>

                    <input
                        type="email"
                        name="email"
                        placeholder="Masukkan email"
                        value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"
                        required
                    >

                </div>


                <div class="form-group">

                    <label>Password</label>

                    <input
                        type="password"
                        name="password"
                        placeholder="Masukkan password"
                        required
                    >

                </div>


                <div class="form-group">

                    <label>Konfirmasi Password</label>

                    <input
                        type="password"
                        name="konfirmasi"
                        placeholder="Masukkan kembali password"
                        required
                    >

                </div>


                <button
                    type="submit"
                    name="register"
                    class="btn-register"
                >
                    Register
                </button>

            </form>


            <p class="login-text">

                Sudah punya akun?

                <a href="login.php">
                    Login
                </a>

            </p>

        </div>

    </div>

</body>

</html>