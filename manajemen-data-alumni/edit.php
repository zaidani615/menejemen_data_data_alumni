<?php
session_start();
include 'koneksi.php';


if (!isset($_SESSION['login']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM alumni WHERE id_alumni='$id'");
$d = mysqli_fetch_assoc($data);


if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $angkatan = $_POST['angkatan'];
    $jurusan = $_POST['jurusan'];

    mysqli_query($koneksi, "UPDATE alumni SET
    nama='$nama',
    angkatan='$angkatan',
    jurusan='$jurusan'
    WHERE id_alumni='$id'
    ");

    header("Location: dashboard_admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Alumni</title>
    <link rel="stylesheet" href="./style/edit.css">
</head>

<body>

    <div class="box">
        <h2>Edit Data Alumni</h2>

        <form method="POST">
            <input type="text" name="nama" value="<?= $d['nama'] ?>" required>
            <input type="number" name="angkatan" value="<?= $d['angkatan'] ?>" min="2000" max="2100" required>

            <select name="jurusan">
                <option <?= $d['jurusan'] == "Rekayasa Perangkat Lunak" ? "selected" : "" ?>>Rekayasa Perangkat Lunak</option>
                <option <?= $d['jurusan'] == "Teknik Komputer dan Jaringan" ? "selected" : "" ?>>Teknik Komputer dan Jaringan
                </option>
                <option <?= $d['jurusan'] == "Animasi" ? "selected" : "" ?>>Animasi</option>
                <option <?= $d['jurusan'] == "Teknik Jaringan Akses Telekomunikasi" ? "selected" : "" ?>>Teknik Jaringan Akses
                    Telekomunikasi</option>
            </select>

            <div class="button-group">
                <button type="submit" name="update">Simpan Perubahan</button>
                <a href="dashboard_admin.php">Batal</a>
            </div>
        </form>

    </div>

</body>

</html>