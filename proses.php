<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $usia = $_POST['usia'];
    $nama_orang_tua = $_POST['nama_orang_tua'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $agama = $_POST['agama'];
    $alamat = $_POST['alamat'];
    $jenis_les = $_POST['jenis_les'];

    $stmt = $pdo->prepare("INSERT INTO pendaftaran (nama, usia, nama_orang_tua, jenis_kelamin,agama,alamat, jenis_les, status) VALUES (?, ?, ?, ?, ? , ? , ? , 'tidak terima')");
    $stmt->execute([$nama, $usia, $nama_orang_tua, $jenis_kelamin,$agama,$alamat, $jenis_les]);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Hasil Pendaftaran</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <div class="card shadow-sm">
      <div class="card-header bg-success text-white">
        <h4 class="mb-0">Pendaftaran Berhasil</h4>
      </div>
      <div class="card-body">
        <p><strong>Nama:</strong> <?= $nama ?></p>
        <p><strong>Usia:</strong> <?= $usia ?> tahun</p>
        <p><strong>Nama Orang Tua:</strong> <?= $nama_orang_tua ?> </p>
        <p><strong>Jenis Kelamin:</strong> <?= $jenis_kelamin ?> </p>
        <p><strong>Agama:</strong> <?= $agama ?> </p>
        <p><strong>Alamat:</strong> <?= $alamat ?> </p>
        <p><strong>Jenis Les:</strong> <?= $jenis_les ?></p>
        <a href="index.php" class="btn btn-primary">Daftar Lagi</a>
      </div>
    </div>
  </div>
</body>
</html>