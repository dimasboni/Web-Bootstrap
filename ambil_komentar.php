<?php
// ambil_komentar.php
include 'koneksi.php';
header('Content-Type: application/json; charset=utf-8');

$result = $conn->query("SELECT name, comment, created_at FROM comments ORDER BY created_at DESC");

$komentar = [];
while ($row = $result->fetch_assoc()) {
    $komentar[] = [
        'name' => htmlspecialchars($row['name']),
        'comment' => nl2br(htmlspecialchars($row['comment'])),
        'created_at' => $row['created_at']
    ];
}

echo json_encode($komentar);
?>
