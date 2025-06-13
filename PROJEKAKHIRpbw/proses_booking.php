<?php
include 'config.php';

$nama = $_POST['nama_pasien'];
$dokter = $_POST['id_dokter'];
$layanan = $_POST['id_layanan'];
$hadir = $_POST['hadir'];

mysqli_query($koneksi, "INSERT INTO booking (nama_pasien, id_dokter, id_layanan, hadir, tanggal_booking)
VALUES ('$nama','$dokter','$layanan','$hadir', NOW())");

header("location:data_booking.php");
?>
