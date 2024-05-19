<?php
$host = "localhost"; // Perbaikan variabel
$user = "root";
$password = "";
$db = "db_bimble";

$kon = mysqli_connect($host, $user, $password, $db);
if (!$kon) { // Perbaikan kondisi if
    die("Koneksi Gagal: " . mysqli_connect_error());
}
?>
