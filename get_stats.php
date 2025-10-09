<?php
include 'koneksi.php';
header('Content-Type: application/json; charset=utf-8');

$data = [];
$res = $conn->query("SELECT label, value FROM stats ORDER BY id ASC");
while ($r = $res->fetch_assoc()) {
    $data[] = $r;
}
echo json_encode($data);
