<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['login']) || $_SESSION['role'] != 'user'){
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Manajemen Data Alumni</title>
<link rel="stylesheet" href="style/dashboard.css">
</head>
<body>

<div class="main-wrapper">
    <div class="role-label user">User</div>

    <header>
        <div class="nav-container">
            <h2>Manajemen Data Alumni</h2>
            <a class="logout" href="logout.php">Logout</a>
        </div>
    </header>

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Data Alumni</h3>
            </div>

            <table>
                <thead>
                <tr>
                    <th width="50">No</th>
                    <th>Nama</th>
                    <th>Angkatan</th>
                    <th>Jurusan</th>
                </tr>
                </thead>

                <tbody>
                    <?php
                    $no = 1;
                    $data = mysqli_query($koneksi, "SELECT * FROM alumni");

                    while($d = mysqli_fetch_array($data)){
                    ?>

                 <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $d['nama'] ?></td>
                    <td><?= $d['angkatan'] ?></td>
                    <td><?= $d['jurusan'] ?></td>
                </tr>
                    <?php } ?>
                </tbody>

            </table>
        </div>
    </div>
</div>

<footer>
    &copy; <?= date('Y') ?>  AHMAD ZAIDANI - All Rights Reserved
</footer>

</body>
</html>
