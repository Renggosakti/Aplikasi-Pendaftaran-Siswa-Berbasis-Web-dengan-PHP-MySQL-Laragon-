<?php
require '../config.php';
header('Content-Type: application/json');
check_api_key();

// Validasi input
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["status" => "error", "message" => "Metode harus POST"]);
    exit;
}

$nama = $_POST['nama'] ?? '';
$alamat = $_POST['alamat'] ?? '';
$jenis_kelamin = $_POST['jenis_kelamin'] ?? '';
$agama = $_POST['agama'] ?? '';
$sekolah_asal = $_POST['sekolah_asal'] ?? '';

if (!$nama || !$alamat || !$jenis_kelamin || !$agama || !$sekolah_asal) {
    echo json_encode(["status" => "error", "message" => "Semua field wajib diisi"]);
    exit;
}

// Upload foto (jika ada)
$foto_nama = null;
if (!empty($_FILES['foto']['name'])) {
    global $allowed_types;
    if ($_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
        echo json_encode(["status" => "error", "message" => "Gagal upload foto"]);
        exit;
    }

    $type = mime_content_type($_FILES['foto']['tmp_name']);
    if (!in_array($type, $allowed_types)) {
        echo json_encode(["status" => "error", "message" => "Tipe file tidak diizinkan"]);
        exit;
    }

    if ($_FILES['foto']['size'] > MAX_FILE_SIZE) {
        echo json_encode(["status" => "error", "message" => "Ukuran file melebihi 2MB"]);
        exit;
    }

    // Simpan file
    $foto_nama = time() . '_' . basename($_FILES['foto']['name']);
    move_uploaded_file($_FILES['foto']['tmp_name'], UPLOAD_DIR . $foto_nama);
}

try {
    $stmt = $pdo->prepare("INSERT INTO calon_siswa (nama, alamat, jenis_kelamin, agama, sekolah_asal, foto)
                           VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$nama, $alamat, $jenis_kelamin, $agama, $sekolah_asal, $foto_nama]);

    echo json_encode(["status" => "success", "message" => "Data siswa berhasil ditambahkan"]);
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
