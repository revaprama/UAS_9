<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Jadwal Dokter - Klinik Gigi Sehat</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white-50 text-gray-800">
<!--iki gae header e -->
<header class="bg-white shadow-md">
  <div class="container mx-auto flex justify-between items-center p-4">
    <div class="flex items-center space-x-3">
      <img src="gigi.png" alt="Logo Klinik" class="h-12 w-auto" />
      <div>
        <h1 class="text-2xl font-bold text-blue-900 leading-none">Klinik Gigi Sehat</h1>
        <p class="text-xs text-blue-500 tracking-widest">DENTAL CLINIC</p>
      </div>
    </div>

    <!-- Menu Navigasi -->
    <nav class="flex space-x-4">
     <a href="awalan.php" class="mx-3 hover:text-blue-500">Home</a>
      </a>
    </nav>
  </div>
</header>
  <!-- Jadwal Dokter -->
  <section class="py-12 bg-gray-200">
    <div class="container mx-auto px-6">
      <h2 class="text-4xl font-semibold mb-6 text-center">Jadwal Dokter</h2>
      <div class="overflow-x-auto">
        <table class="min-w-full bg-white border text-center">
          <thead>
            <tr class="bg-blue-900 text-white">
              <th class="p-3 border">Nama Dokter</th>
              <th class="p-3 border">Hari</th>
              <th class="p-3 border">Jam</th>
              <th class="p-3 border">Spesialis</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="p-3 border">drg. Andi</td>
              <td class="p-3 border">Senin & Rabu</td>
              <td class="p-3 border">08.00 - 12.00</td>
              <td class="p-3 border">Umum</td>
            </tr>
            <tr class="bg-blue-50">
              <td class="p-3 border">drg. Siti</td>
              <td class="p-3 border">Selasa & Kamis</td>
              <td class="p-3 border">13.00 - 17.00</td>
              <td class="p-3 border">Ortodonti</td>
            </tr>
            <tr>
              <td class="p-3 border">drg. Raka</td>
              <td class="p-3 border">Jumat</td>
              <td class="p-3 border">09.00 - 12.00</td>
              <td class="p-3 border">Bedah Mulut</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</body>
</html>
 