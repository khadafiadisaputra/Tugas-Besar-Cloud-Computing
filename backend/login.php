<?php
session_start();
include "koneksi.php";

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$stmt = $conn->prepare("SELECT id, username FROM users WHERE username = ? AND password = ? LIMIT 1");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $_SESSION['admin'] = true;
    $_SESSION['username'] = $username;

    header("Location: ../index.php");
    exit;
}

echo "<script>alert('Login gagal. Username atau password salah.'); window.history.back();</script>";
?>
