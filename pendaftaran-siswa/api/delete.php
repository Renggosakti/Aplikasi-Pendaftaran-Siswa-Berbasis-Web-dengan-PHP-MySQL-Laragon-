<?php
require '../config.php';
header('Content-Type: application/json');
check_api_key();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["status" => "error", "message" => "Metode harus POST"]);
    exit;
}

$id = $_POST['id'] ?? '';
if (!$id) {
    echo json_encode(["status" => "error", "message" => "ID wajib diisi"]);
    exit;
}

try {
    $stmt = $pdo->prepare("DELETE FROM calon_siswa WHERE id = ?");
    $stmt->execute([$id]);
    echo json_encode(["status" => "success", "message" => "Data siswa berhasil dihapus"]);
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>  