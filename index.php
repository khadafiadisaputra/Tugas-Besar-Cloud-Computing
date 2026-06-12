<?php
session_start();
include __DIR__ . "/backend/koneksi.php";

mysqli_set_charset($conn, "utf8mb4");

$isAdmin = isset($_SESSION['admin']) && $_SESSION['admin'] === true;

function e($value) {
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

// Indikator instance untuk kebutuhan pengujian Load Balancer.
// Pada instance 1, isi file instance.txt dengan angka 1.
// Pada instance 2, isi file instance.txt dengan angka 2.
$serverInstance = getenv('SERVER_INSTANCE');
if (!$serverInstance && file_exists(__DIR__ . '/instance.txt')) {
    $serverInstance = trim(file_get_contents(__DIR__ . '/instance.txt'));
}
if (!$serverInstance) {
    $serverInstance = '1';
}

$query = "SELECT * FROM anggota ORDER BY id ASC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelompok Komputasi Awan</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js" defer></script>
</head>
<body>

<header class="hero">
    <nav class="navbar">
        <a class="brand" href="index.php">
            <span class="brand-icon">☁</span>
            <span>Cloud Project</span>
        </a>

        <div class="nav-actions">
            <?php if ($isAdmin) { ?>
                <span class="admin-badge">Mode Admin Aktif</span>
                <a href="backend/logout.php" class="nav-login logout">Logout</a>
            <?php } else { ?>
                <a href="login.html" class="nav-login">Login Admin</a>
            <?php } ?>
        </div>
    </nav>

    <div class="hero-content">
        <div class="hero-text">
            <p class="eyebrow">Tugas Besar BBK3CAB3</p>
            <h1>Kelompok Komputasi Awan</h1>
            <p class="subtitle">
                Website identitas anggota kelompok yang mengambil data dari database,
                memiliki halaman login admin, detail mahasiswa, dan indikator server instance
                untuk pengujian load balancer.
            </p>
        </div>

        <div class="instance-card">
            <span>Webserver Instance</span>
            <strong id="server"><?php echo e($serverInstance); ?></strong>
            <small>Kode instance yang sedang merespons request.</small>
        </div>
    </div>
</header>

<main>
    <section class="info-section">
        <div class="info-box">
            <span class="info-number">01</span>
            <div>
                <h2>Database Server</h2>
                <p>Data anggota diambil dari tabel <b>anggota</b> pada database <b>cloud_project</b>.</p>
            </div>
        </div>

        <div class="info-box">
            <span class="info-number">02</span>
            <div>
                <h2>Webserver Instance</h2>
                <p>Website berjalan di instance webserver dan menampilkan indikator server 1 atau 2.</p>
            </div>
        </div>

        <div class="info-box">
            <span class="info-number">03</span>
            <div>
                <h2>Admin Edit</h2>
                <p>Admin dapat login lalu mengubah nama, NIM, kelas, peran, dan deskripsi anggota.</p>
            </div>
        </div>
    </section>

    <section class="members-section">
        <div class="section-heading">
            <p>Profil Kelompok</p>
            <h2>Anggota Kelompok</h2>
            <span>Klik kartu anggota untuk melihat detail mahasiswa.</span>
        </div>

        <div class="members-grid">
            <?php if ($result && mysqli_num_rows($result) > 0) { ?>
                <?php while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['id'] ?? '';
                    $nama = $row['nama'] ?? 'Nama belum diisi';
                    $nim = $row['nim'] ?? 'NIM belum diisi';
                    $kelas = $row['kelas'] ?? 'Kelas belum diisi';
                    $peran = $row['peran'] ?? 'Anggota';
                    $deskripsi = $row['deskripsi'] ?? 'Mahasiswa anggota kelompok Tugas Besar Komputasi Awan.';
                    $foto = $row['foto'] ?? 'default.jpg';
                ?>
                    <article class="member-card detail-card"
                             tabindex="0"
                             role="button"
                             aria-label="Lihat detail <?php echo e($nama); ?>"
                             data-nama="<?php echo e($nama); ?>"
                             data-nim="<?php echo e($nim); ?>"
                             data-kelas="<?php echo e($kelas); ?>"
                             data-peran="<?php echo e($peran); ?>"
                             data-deskripsi="<?php echo e($deskripsi); ?>"
                             data-foto="images/<?php echo e($foto); ?>">
                        <div class="photo-wrap">
                            <img src="images/<?php echo e($foto); ?>" alt="Foto <?php echo e($nama); ?>">
                        </div>

                        <span class="role-badge"><?php echo e($peran); ?></span>
                        <h3><?php echo e($nama); ?></h3>
                        <p><?php echo e($kelas); ?></p>
                        <span class="nim-preview">NIM: <?php echo e($nim); ?></span>

                        <div class="card-actions">
                            <button type="button" class="detail-btn">Lihat Detail</button>
                            <?php if ($isAdmin) { ?>
                                <a href="edit_anggota.php?id=<?php echo e($id); ?>" class="edit-btn">Edit Data</a>
                            <?php } ?>
                        </div>
                    </article>
                <?php } ?>
            <?php } else { ?>
                <div class="empty-state">
                    <h3>Data anggota belum tersedia</h3>
                    <p>Pastikan database sudah di-import dan koneksi database sudah benar.</p>
                </div>
            <?php } ?>
        </div>
    </section>
</main>

<div id="detailModal" class="modal" aria-hidden="true">
    <div class="modal-content">
        <button id="closeModal" class="close-modal" type="button" aria-label="Tutup modal">×</button>

        <div class="modal-photo-wrap">
            <img id="modalFoto" src="" alt="Foto Mahasiswa">
        </div>

        <h2 id="modalNama"></h2>

        <div class="detail-list">
            <p><strong>NIM</strong><span id="modalNim"></span></p>
            <p><strong>Kelas</strong><span id="modalKelas"></span></p>
            <p><strong>Peran</strong><span id="modalPeran"></span></p>
            <p><strong>Deskripsi</strong><span id="modalDeskripsi"></span></p>
        </div>
    </div>
</div>

<footer>
    <p>© 2026 Kelompok Komputasi Awan - BBK3CAB3</p>
</footer>

</body>
</html>
