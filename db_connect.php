<?php
$host = "localhost";  // kalau server kasih IP, ubah ini jadi IP mereka
$user = "user20232010";
$pass = "OAlk8s";
$dbname = "koleksi_militer"; // kamu yang buat nanti

$conn = new mysqli($host, $user, $pass, $dbname);

// cek koneksi
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}
// kalau sukses, gak usah tampilkan apa-apa
?>
