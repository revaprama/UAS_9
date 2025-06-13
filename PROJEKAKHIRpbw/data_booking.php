<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_klinik_gigii");
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Data Booking Klinik Gigi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container">
  <h2>Data Booking Pasien</h2>
  <a href="index.php" class="btn btn-success mb-3">+ Booking Baru</a>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Nama Pasien</th>
        <th>Layanan</th>
        <th>Jadwal</th>
        <th>Kehadiran</th>
        <th>No telp</th>
        <th>email</th>
        <th>Jam_booking</th>
        <th>tanggal_booking</th>
        <th>Status_booking</th>
        <th>Kode_konfirmasi</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $query = "
        SELECT *
        FROM booking b
        JOIN dokter d ON b.id_dokter = d.id_dokter
        JOIN layanan l ON b.id_layanan = l.id_layanan
        ORDER BY b.id_booking DESC
      ";
      $result = mysqli_query($koneksi, $query);
      while ($row = mysqli_fetch_assoc($result)) {
        $status = $row['hadir'] ? "Hadir" : "Belum";
        echo "<tr>
                <td>{$row['nama_pasien']}</td>
                <td>{$row['nama_layanan']}</td>
                <td>{$row['jam_mulai']} - {$row['jam_selesai']}</td>
                <td>$status</td>
                <td>{$row['telepon_pasien']}</td>
                <td>{$row['email_pasien']}</td>
                <td>{$row['jam_booking']}</td>
                <td>{$row['tanggal_booking']}</td>
                <td>{$row['status_booking']}</td>
                <td>{$row['kode_konfirmasi']}</td>
                <td>
                  <a href='edit.php?id=" . $row['id_booking'] . "'
                  class='btn btn-warning btn-sm'>Edit</a>

                  <a href='hapus_booking.php?id=" . $row['id_booking'] . "
                  onclick=" . "return confirm('Hapus data ini?')'". " class='btn btn-
                  danger btn-sm'>Hapus</a>
                </td>
              </tr>";
      }
      ?>
    </tbody>
  </table>
</div>
</body>
</html>