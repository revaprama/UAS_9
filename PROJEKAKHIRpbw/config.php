<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_klinik_gigii");

if (mysqli_connect_errno()) {
    echo "Koneksi database gagal: " . mysqli_connect_error();
    exit;
}
?>
