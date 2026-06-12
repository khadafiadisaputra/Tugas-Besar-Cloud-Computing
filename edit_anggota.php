<?php
session_start();

if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: login.html");
    exit;
}

include __DIR__ . "/backend/koneksi.php";
mysqli_set_charset($conn, "utf8mb4");

function e($value) {
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

$id = intval($_GET['id'] ?? 0);

$stmt = $conn->prepare("SELECT * FROM anggota WHERE id = ? LIMIT 1");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$anggota = $result->fetch_assoc();

if (!$anggota) {
    echo "Data anggota tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Anggota</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="edit-page">

<main class="edit-card">
    <div class="edit-header">
        <a href="index.php" class="back-link">← Kembali</a>
        <h1>Edit Data Anggota</h1>
        <p>Ubah data mahasiswa. Setelah disimpan, data pada halaman utama akan ikut berubah.</p>
    </div>

    <form action="backend/update_anggota.php" method="POST" class="edit-form">
        <input type="hidden" name="id" value="<?php echo e($anggota['id']); ?>">

        <div class="form-group">
            <label for="nama">Nama</label>
            <input id="nama" type="text" name="nama" value="<?php echo e($anggota['nama']); ?>" required>
        </div>

        <div class="form-group">
            <label for="nim">NIM</label>
            <input id="nim" type="text" name="nim" value="<?php echo e($anggota['nim']); ?>" required>
        </div>

        <div class="form-group">
            <label for="kelas">Kelas</label>
            <input id="kelas" type="text" name="kelas" value="<?php echo e($anggota['kelas']); ?>" required>
        </div>

        <div class="form-group">
            <label for="peran">Peran</label>
            <input id="peran" type="text" name="peran" value="<?php echo e($anggota['peran']); ?>" required>
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi" required><?php echo e($anggota['deskripsi']); ?></textarea>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-submit">Simpan Perubahan</button>
            <a href="index.php" class="btn-cancel">Batal</a>
        </div>
    </form>
</main>

</body>
</html>
