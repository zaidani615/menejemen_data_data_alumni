<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['login']) || $_SESSION['role'] != 'admin'){
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="./style/dashboard.css">
</head>
<body>

<div class="main-wrapper">
    <div class="role-label admin">Admin</div>

    <header>
        <div class="nav-container">
            <h2>Manajemen Data Alumni</h2>
            <a class="logout" href="logout.php">Logout</a>
        </div>
    </header>

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Daftar Alumni</h3>
                <div class="header-actions">
                    <a class="tambah" href="tambah.php">+ Tambah Data</a>
                    
                    <form action="" method="GET" style="display: flex; gap: 5px;">
                        <input type="text" name="cari" placeholder="Search nama..." class="search-input" value="<?= isset($_GET['cari']) ? $_GET['cari'] : '' ?>">
                        <button type="submit" style="display:none;">Cari</button> 
                    </form>
                </div>
            </div>

            <table>
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Angkatan</th>
                    <th>Jurusan</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    
                    // Logika Filter Pencarian
                    if(isset($_GET['cari']) && $_GET['cari'] != ''){
                        $cari = mysqli_real_escape_string($koneksi, $_GET['cari']);
                        $data = mysqli_query($koneksi, "SELECT * FROM alumni WHERE nama LIKE '%$cari%'");
                    } else {
                        // Tampilan default jika tidak ada pencarian
                        $data = mysqli_query($koneksi, "SELECT * FROM alumni");
                    }

                    if(mysqli_num_rows($data) > 0){
                        while($d = mysqli_fetch_array($data)){
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $d['nama'] ?></td>
                            <td><?= $d['angkatan'] ?></td>
                            <td><?= $d['jurusan'] ?></td>
                            <td>
                                <a class="edit" href="edit.php?id=<?= $d['id_alumni'] ?>">Edit</a>
                                <a class="hapus" href="delete.php?id=<?= $d['id_alumni'] ?>" onclick="return confirm('Hapus data?')">Hapus</a>
                            </td>
                        </tr>
                    <?php 
                        }
                    } else {
                        echo "<tr><td colspan='5' style='text-align:center;'>Data tidak ditemukan</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<footer>
    &copy; <?= date('Y') ?>   AHMAD ZAIDANI - All Rights Reserved
</footer>

</body>
</html>