<?php
$DB_HOST = 'localhost';
$DB_USER = 'user20232010';
$DB_PASS = 'OAlk8s';
$DB_NAME = 'user20232010'; // pastikan ini sama dengan nama database di phpMyAdmin

$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if ($conn->connect_errno) {
    die("Koneksi database gagal: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");
?>
