<?php
session_start();
include 'koneksi.php';

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $data = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    $user = mysqli_fetch_assoc($data);

    if ($user) {

        $_SESSION['login'] = true;
        $_SESSION['role'] = $user['role'];

        if ($user['role'] == 'admin') {
            header("Location: dashboard_admin.php");
        } else {
            header("Location: dashboard_users.php");
            exit;
        }

    } else {
        echo "<script>alert('Username atau password salah')</script>";
    }

}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" href="./style/index.css">
</head>

<body>

    <div class="box">
        <h2>Login</h2>
        <form method="POST">
            <input type="text" name="username" placeholder="Masukkan Username" required>
            <input type="password" name="password" placeholder="Masukkan Password" required>
            <button type="submit" name="login">Masuk</button>

        </form>

    </div>
</body>

</html>