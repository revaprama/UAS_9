<?php
include 'config.php';
$id = $_GET['id'];
mysqli_query($koneksi, "DELETE FROM booking WHERE id_booking='$id'");
header("location:data_booking.php");
?>
