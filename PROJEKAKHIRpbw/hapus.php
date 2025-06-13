<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_klinik_gigii");
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $delete_query = "DELETE FROM booking WHERE id_booking = $id";
    
    if (mysqli_query($koneksi, $delete_query)) {
        header("Location: index.php");
    } else {
        echo "Error deleting record: " . mysqli_error($koneksi);
    }
} else {
    echo "ID not set.";
}
?>
