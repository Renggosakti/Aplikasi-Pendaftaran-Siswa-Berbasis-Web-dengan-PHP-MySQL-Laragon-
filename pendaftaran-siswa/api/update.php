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
$nama = $_POST['nama'] ?? '';
$alamat = $_POST['alamat'] ?? '';
$jenis_kelamin = $_POST['jenis_kelamin'] ?? '';
$agama = $_POST['agama'] ?? '';
$sekolah_asal = $_POST['sekolah_asal'] ?? '';

if (!$id || !$nama || !$alamat || !$jenis_kelamin || !$agama || !$sekolah_asal) {
    echo json_encode(["status" => "error", "message" => "Semua field wajib diisi"]);
    exit;
}

// Cek jika ada foto baru
$foto_nama = null;
if (!empty($_FILES['foto']['name'])) {
    global $allowed_types;
    if ($_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $type = mime_content_type($_FILES['foto']['tmp_name']);
        if (in_array($type, $allowed_types)) {
            $foto_nama = time() . '_' . basename($_FILES['foto']['name']);
            move_uploaded_file($_FILES['foto']['tmp_name'], UPLOAD_DIR . $foto_nama);
        }
    }
}

try {
    if ($foto_nama) {
        $stmt = $pdo->prepare("UPDATE calon_siswa SET nama=?, alamat=?, jenis_kelamin=?, agama=?, sekolah_asal=?, foto=? WHERE id=?");
        $stmt->execute([$nama, $alamat, $jenis_kelamin, $agama, $sekolah_asal, $foto_nama, $id]);
    } else {
        $stmt = $pdo->prepare("UPDATE calon_siswa SET nama=?, alamat=?, jenis_kelamin=?, agama=?, sekolah_asal=? WHERE id=?");
        $stmt->execute([$nama, $alamat, $jenis_kelamin, $agama, $sekolah_asal, $id]);
    }

    echo json_encode(["status" => "success", "message" => "Data siswa berhasil diperbarui"]);
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
