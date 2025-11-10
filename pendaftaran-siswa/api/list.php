<?php
require '../config.php';
header('Content-Type: application/json; charset=utf-8');

// ✅ Pastikan respons tidak di-cache (biar data selalu update)
header('Cache-Control: no-cache, must-revalidate');
header('Expires: 0');

// ✅ Cek API key
check_api_key();

try {
    // Ambil semua data siswa terbaru
    $stmt = $pdo->query("SELECT * FROM calon_siswa ORDER BY id DESC");
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        "status" => "success",
        "count" => count($data),
        "data" => $data
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}
?>
