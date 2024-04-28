<?php
include ('database/koneksi.php');
session_start();

if(isset($_SESSION['id_user'])){
    header("Location: user/pemesanan.php");
    exit;
}

$message = "";

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    // query untuk mencari pengguna dengan email dan password yang sesuai
    $query = "SELECT * FROM tbl_login WHERE email='$username' AND password='$password'";
    $result = mysqli_query($konek, $query);

    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);

        if ($row['role']=="admin") {
            // buat session login dan email
            $_SESSION['id_user'] = $row['id_user'];
            $_SESSION['email'] = $username;
            $_SESSION['role'] = "admin";
            // alihkan ke halaman dashboard admin
            header("location:admin1/index.php");
            exit;
        }elseif ($row['role']=="user") {
            $_SESSION['id_user'] = $row['id_user'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['role'] = "user";

            header("Location: user/halaman.php");
            exit;
        }
    }else{
        $message = "Email atau password salah.";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="css/style3.css">
    <link rel="shortcut icon" href="./image/1.png" type="image/x-icon" />
    <title>Login Form</title>
</head>
<body style="background-image: url(image/gambar8.jpeg);">
    <div class="container">
        <form method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
            <div class="input-group">
                <input type="email" placeholder="Email" name="username" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password" required>
            </div>
            <div class="input-group">
                <button name="login" class="btn">Login</button>
            </div>
            <p class="login-register-text">Tidak memiliki akun? <a href="register.php">Daftar disini</a>.</p>
            <p class="error-message"><?php echo $message; ?></p> <!-- Menampilkan pesan kesalahan -->
        </form>
    </div>
</body>
</html>
