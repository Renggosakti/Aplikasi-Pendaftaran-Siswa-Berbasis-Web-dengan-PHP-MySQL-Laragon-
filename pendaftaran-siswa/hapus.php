<?php
// hapus.php
require_once 'config.php';

$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) {
    header('Location: list-siswa.php');
    exit;
}

// ambil nama file
$stmt = $pdo->prepare("SELECT foto FROM calon_siswa WHERE id = :id");
$stmt->execute([':id' => $id]);
$row = $stmt->fetch();

if ($row) {
    if ($row['foto']) {
        $path = UPLOAD_DIR . $row['foto'];
        if (file_exists($path)) @unlink($path);
    }
    $del = $pdo->prepare("DELETE FROM calon_siswa WHERE id = :id");
    $del->execute([':id' => $id]);
}

header('Location: list-siswa.php');
exit;
