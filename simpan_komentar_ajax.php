<?php
// simpan_komentar_ajax.php (ganti seluruh file dengan ini)
include 'koneksi.php';
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'error' => 'Metode bukan POST']);
    exit;
}

$name = trim($_POST['namaKomentar'] ?? '');
$email = trim($_POST['emailKomentar'] ?? '');
$comment = trim($_POST['isiKomentar'] ?? '');
$ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';

// Validasi input dasar
if ($name === '' || $email === '' || $comment === '') {
    echo json_encode(['success' => false, 'error' => 'Nama, email, dan komentar wajib diisi.']);
    exit;
}
if (mb_strlen($name) > 50 || mb_strlen($comment) > 250) {
    echo json_encode(['success' => false, 'error' => 'Nama max 50 dan komentar max 250 karakter.']);
    exit;
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'error' => 'Email tidak valid.']);
    exit;
}

// =============================
// PEMBATASAN WAKTU 30 DETIK (ROBUST)
// =============================
// Query memeriksa adakah komentar dari IP ini dalam 30 detik terakhir
$check = $conn->prepare("SELECT id FROM comments WHERE ip_address = ? AND created_at > (NOW() - INTERVAL 30 SECOND) LIMIT 1");
if (!$check) {
    // jika prepare gagal, tampilkan error agar mudah debugging
    echo json_encode(['success' => false, 'error' => 'DB prepare error: ' . $conn->error]);
    exit;
}
$check->bind_param("s", $ip);
$check->execute();
// gunakan store_result sehingga tidak perlu get_result (kompatibel lebih luas)
$check->store_result();
if ($check->num_rows > 0) {
    $check->close();
    echo json_encode(['success' => false, 'error' => 'Tunggu 30 detik sebelum mengirim komentar lagi.']);
    exit;
}
$check->close();

// =============================
// SIMPAN KOMENTAR
// =============================
$stmt = $conn->prepare("INSERT INTO comments (name, email, comment, ip_address, created_at) VALUES (?, ?, ?, ?, NOW())");
if (!$stmt) {
    echo json_encode(['success' => false, 'error' => 'DB prepare error (insert): ' . $conn->error]);
    exit;
}
$stmt->bind_param("ssss", $name, $email, $comment, $ip);
$ok = $stmt->execute();
$stmt->close();

if ($ok) {
    echo json_encode(['success' => true, 'message' => 'Komentar berhasil dikirim.']);
} else {
    echo json_encode(['success' => false, 'error' => 'Gagal menyimpan komentar (DB).']);
}
$conn->close();
