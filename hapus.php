<?php
session_start();
require 'config.php';

// Pastikan hanya admin yang bisa mengakses
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM pendaftaran WHERE id = ?");
    $stmt->execute([$id]);
}

header('Location: admin.php');
exit;
