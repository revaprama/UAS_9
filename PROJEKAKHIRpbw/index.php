<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "db_klinik_gigii");
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Proses simpan data saat form dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_pasien = $_POST['nama_pasien'];
    $telepon_pasien = $_POST['telepon_pasien'];
    $email_pasien = $_POST['email_pasien'];
    $id_dokter = $_POST['id_dokter'];
    $id_layanan = $_POST['id_layanan'];
    $hadir = $_POST['hadir'];
    $tanggal_booking = $_POST['tanggal_booking'];
    $jam_booking = $_POST['jam_booking'];
    
    // Kolom tambahan
    $status_booking = 'Pending';
    $kode_konfirmasi = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 8);

    $query = "INSERT INTO booking (
        nama_pasien,id_layanan,id_dokter,hadir,telepon_pasien, email_pasien,
        jam_booking,tanggal_booking,
        status_booking,kode_konfirmasi
    ) VALUES (
        '$nama_pasien', '$id_layanan', '$id_dokter', '$hadir', '$telepon_pasien', '$email_pasien',
        '$jam_booking', '$tanggal_booking',
        '$status_booking', '$kode_konfirmasi'
    )";

    if (mysqli_query($koneksi, $query)) {
        // Redirect ke halaman data
        header("Location: data_booking.php");
        exit;
    } else {
        echo "Gagal menyimpan data: " . mysqli_error($koneksi) . "<br>Query: " . $query;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Booking Klinik Gigi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container">
    <h2>Form Booking Klinik Gigi</h2>
    <form method="POST">
        <div class="mb-3">
            <label>Nama Pasien</label>
            <input type="text" name="nama_pasien" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Telepon Pasien</label>
            <input type="text" name="telepon_pasien" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email Pasien</label>
            <input type="email" name="email_pasien" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Tanggal Booking</label>
            <input type="date" name="tanggal_booking" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Jam Booking</label>
            <input type="time" name="jam_booking" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Pilih Dokter</label>
            <select name="id_dokter" class="form-select" required>
                <option value="">--Pilih Dokter--</option>
                <?php
                $dokter = mysqli_query($koneksi, "SELECT * FROM dokter");
                while ($d = mysqli_fetch_array($dokter)) {
                    echo "<option value='{$d['id_dokter']}'>{$d['nama_dokter']} ({$d['spesialis']})</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Pilih Layanan</label>
            <select name="id_layanan" class="form-select" required>
                <option value="">--Pilih Layanan--</option>
                <?php
                $layanan = mysqli_query($koneksi, "SELECT * FROM layanan");
                while ($l = mysqli_fetch_array($layanan)) {
                    echo "<option value='{$l['id_layanan']}'>{$l['nama_layanan']} - Rp {$l['harga']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Konfirmasi Kehadiran</label>
            <select name="hadir" class="form-select" required>
                <option value="1">Hadir</option>
                <option value="0">Belum</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Booking</button>
    </form>

    <a href="data_booking.php" class="btn btn-link mt-3">Lihat Data Booking</a>
</div>
</body>
</html>
