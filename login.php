<?php
require 'config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && $password === $user['password']) { // Ganti jadi hash_verify() jika pakai hash
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        header("Location: " . ($user['role'] == 'admin' ? 'admin.php' : 'index.php'));
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <div class="card mx-auto" style="max-width: 400px;">
    <div class="card-header bg-primary text-white">
      <h4 class="mb-0">Login</h4>
    </div>
    <div class="card-body">
      <?php if ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
      <?php endif; ?>
      <form method="post">
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" name="username" id="username" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Login</button>
      </form>
    </div>
  </div>
</div>
</body>
</html>