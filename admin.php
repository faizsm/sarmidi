<?php
require 'config.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit;
}

// Ambil data pendaftar
$pendaftar = $pdo->query("SELECT * FROM pendaftaran ORDER BY tanggal_daftar DESC")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_status'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];

    // Update status pendaftar
    $stmt = $pdo->prepare("UPDATE pendaftaran SET status = ? WHERE id = ?");
    $stmt->execute([$status, $id]);

    // Refresh halaman setelah update
    header("Location: admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Daftar Pendaftar Les</h4>
    <a href="logout.php" class="btn btn-danger">Logout</a>
  </div>
  <?php if (empty($pendaftar)): ?>
    <div class="alert alert-warning">Belum ada pendaftar.</div>
  <?php else: ?>
    <table class="table table-bordered">
      <thead class="table-light">
        <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Usia</th>
        <th>Nama Orang Tua</th>
        <th>Jenis Kelamin</th>
        <th>Agama</th>
        <th>Alamat</th>
        <th>Jenis Les</th>
        <th>Status</th>
        <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($pendaftar as $i => $p ): ?>
          <tr>
            <td class="text-break"><?= $i + 1 ?></td>
            <td><?= $p['nama'] ?></td>
            <td><?= $p['usia'] ?></td>
            <td class="text-break"><?= $p['nama_orang_tua'] ?></td>
            <td><?= $p['jenis_kelamin'] ?></td>
            <td><?= $p['agama'] ?></td>
            <td class="text-break"><?= $p['alamat'] ?></td>
            <td><?= $p['jenis_les'] ?></td>
            <td><?= $p['status'] ?></td>
            <td>
              <!-- Form untuk update status -->
              <form method="POST" class="d-inline-block">
                <input type="hidden" name="id" value="<?= $p['id'] ?>">
                <select name="status" class="form-select" style="width: 100px;">
                  <option value="terima" <?= $p['status'] == 'terima' ? 'selected' : '' ?>>Terima</option>
                  <option value="tidak terima" <?= $p['status'] == 'tidak terima' ? 'selected' : '' ?>>Tidak Terima</option>
                </select>
                <button type="submit" name="update_status" class="btn btn-warning btn-sm mt-2">Update</button>
              </form>
            </td>
            <td>
                            <a href="hapus.php?id=<?= $p['id'] ?>" 
                               class="btn btn-danger btn-sm" 
                               onclick="return confirm('Yakin ingin menghapus peserta ini?');">Hapus</a>
                        </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>
</body>
</html>
