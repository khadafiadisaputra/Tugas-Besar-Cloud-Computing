<?php
session_start();

if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: ../login.html");
    exit;
}

include "koneksi.php";
mysqli_set_charset($conn, "utf8mb4");

$id = intval($_POST['id'] ?? 0);
$nama = trim($_POST['nama'] ?? '');
$nim = trim($_POST['nim'] ?? '');
$kelas = trim($_POST['kelas'] ?? '');
$peran = trim($_POST['peran'] ?? '');
$deskripsi = trim($_POST['deskripsi'] ?? '');

if ($id <= 0 || $nama === '' || $nim === '' || $kelas === '' || $peran === '' || $deskripsi === '') {
    echo "Data tidak lengkap. Silakan kembali dan isi semua field.";
    exit;
}

$stmt = $conn->prepare("UPDATE anggota SET nama = ?, nim = ?, kelas = ?, peran = ?, deskripsi = ? WHERE id = ?");
$stmt->bind_param("sssssi", $nama, $nim, $kelas, $peran, $deskripsi, $id);

if ($stmt->execute()) {
    header("Location: ../index.php");
    exit;
}

echo "Gagal update data: " . $conn->error;
?>
