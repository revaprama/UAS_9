<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "db_klinik_gigii";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_booking = $_POST['id_booking'];
    $status_booking = $_POST['status_booking'];

    $sql = "UPDATE booking SET status_booking = ? WHERE id_booking = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status_booking, $id_booking);

    if ($stmt->execute()) {
        echo "<script>alert('Status booking berhasil diperbarui'); window.location='data_booking.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Ambil data booking berdasarkan ID
$idBooking = $_GET['id'];
$result = mysqli_query($conn, "
    SELECT b.*, l.nama_layanan, d.jam_mulai, d.jam_selesai 
    FROM booking b 
    LEFT JOIN layanan l ON b.id_layanan = l.id_layanan 
    LEFT JOIN dokter d ON b.id_dokter = d.id_dokter
    WHERE b.id_booking = '$idBooking'
");
$data = mysqli_fetch_assoc($result);

// Format jadwal
$jadwal = "-";
if (!empty($data['jam_mulai']) && !empty($data['jam_selesai'])) {
    $jadwal = date("H:i", strtotime($data['jam_mulai'])) . " - " . date("H:i", strtotime($data['jam_selesai']));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Status Booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="w-full max-w-2xl bg-white shadow-md rounded-lg p-8">
    <h2 class="text-2xl font-bold mb-6 text-center text-blue-700">Edit Status Booking</h2>

    <form method="post" action="" class="space-y-4">
        <input type="hidden" name="id_booking" value="<?php echo $data['id_booking']; ?>">

        <!-- Data Pasien dan Booking -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Nama Pasien</label>
            <input type="text" value="<?php echo $data['nama_pasien']; ?>" class="mt-1 block w-full bg-gray-100 border-gray-300 rounded-md shadow-sm" readonly>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Layanan</label>
            <input type="text" value="<?php echo $data['nama_layanan']; ?>" class="mt-1 block w-full bg-gray-100 border-gray-300 rounded-md shadow-sm" readonly>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Jadwal</label>
            <input type="text" value="<?php echo $jadwal; ?>" class="mt-1 block w-full bg-gray-100 border-gray-300 rounded-md shadow-sm" readonly>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Kehadiran</label>
            <input type="text" value="<?php echo $data['hadir'] ? 'Hadir' : 'Belum'; ?>" class="mt-1 block w-full bg-gray-100 border-gray-300 rounded-md shadow-sm" readonly>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Telepon Pasien</label>
            <input type="text" value="<?php echo $data['telepon_pasien']; ?>" class="mt-1 block w-full bg-gray-100 border-gray-300 rounded-md shadow-sm" readonly>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Email Pasien</label>
            <input type="text" value="<?php echo $data['email_pasien']; ?>" class="mt-1 block w-full bg-gray-100 border-gray-300 rounded-md shadow-sm" readonly>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Tanggal Booking</label>
            <input type="text" value="<?php echo $data['tanggal_booking']; ?>" class="mt-1 block w-full bg-gray-100 border-gray-300 rounded-md shadow-sm" readonly>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Jam Booking</label>
            <input type="text" value="<?php echo $data['jam_booking']; ?>" class="mt-1 block w-full bg-gray-100 border-gray-300 rounded-md shadow-sm" readonly>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">ID Dokter</label>
            <input type="text" value="<?php echo $data['id_dokter']; ?>" class="mt-1 block w-full bg-gray-100 border-gray-300 rounded-md shadow-sm" readonly>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">ID Layanan</label>
            <input type="text" value="<?php echo $data['id_layanan']; ?>" class="mt-1 block w-full bg-gray-100 border-gray-300 rounded-md shadow-sm" readonly>
        </div>

        <!-- Status Booking Edit -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Status Booking</label>
            <select name="status_booking" required class="mt-1 block w-full border-gray-300 bg-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="Pending" <?= $data['status_booking'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                <option value="Dikonfirmasi" <?= $data['status_booking'] == 'Dikonfirmasi' ? 'selected' : '' ?>>Dikonfirmasi</option>
                <option value="Selesai" <?= $data['status_booking'] == 'Selesai' ? 'selected' : '' ?>>Selesai</option>
                <option value="Batal" <?= $data['status_booking'] == 'Batal' ? 'selected' : '' ?>>Batal</option>
            </select>
        </div>

        <div class="text-center">
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>

</body>
</html>
