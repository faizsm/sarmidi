<?php
require 'config.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'user') {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Pendaftaran Les AHE</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script>
    // Konfirmasi sebelum kirim form
    function konfirmasiSubmit() {
      return confirm("Apakah Anda yakin dengan data yang Anda isi?");
    }
  </script>
</head>
<body class="bg-light">
  <!-- Tombol Logout -->
  <div class="container mt-3 text-end">
    <?php if (isset($_SESSION['username'])): ?>
      <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
    <?php endif; ?>
  </div>

  <!-- Formulir Pendaftaran -->
  <div class="container mt-2">
    <div class="card shadow-sm">
      <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Formulir Pendaftaran Les</h4>
      </div>
      <div class="card-body">
        <form action="proses.php" method="post" onsubmit="return konfirmasiSubmit()">
          <div class="mb-3">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <input type="text" name="nama" id="nama" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="usia" class="form-label">Usia</label>
            <input type="number" name="usia" id="usia" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="nama_orang_tua" class="form-label">Nama Orang Tua</label>
            <input type="text" name="nama_orang_tua" id="nama_orang_tua" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
            <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" required>
              <option value="">-- Pilih Jenis Kelamin --</option>
              <option value="Laki-laki">Laki-laki</option>
              <option value="Perempuan">Perempuan</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="agama" class="form-label">Agama</label>
            <select name="agama" id="agama" class="form-select" required>
              <option value="">-- Pilih Agama --</option>
              <option value="Islam">Islam</option>
              <option value="Kristen">Kristen</option>
              <option value="Katolik">Katolik</option>
              <option value="Hindu">Hindu</option>
              <option value="Buddha">Buddha</option>
              <option value="Konghucu">Konghucu</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea name="alamat" id="alamat" rows="3" class="form-control" required></textarea>
          </div>
          <div class="mb-3">
            <label for="jenis_les" class="form-label">Pilihan Les</label>
            <select name="jenis_les" id="jenis_les" class="form-select" required>
              <option value="">-- Pilih Jenis Les --</option>
              <option value="Les Inggris">Les Inggris</option>
              <option value="Les AGA">Les AGA</option>
              <option value="Les Pracalis">Les Pracalis</option>
              <option value="Les Hitung">Les Hitung</option>
              <option value="Les Baca">Les Baca</option>
            </select>
          </div>
          <button type="submit" class="btn btn-success">Daftar</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
