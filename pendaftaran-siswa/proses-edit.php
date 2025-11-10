<?php
// proses-edit.php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: list-siswa.php');
    exit;
}

$id = (int)($_POST['id'] ?? 0);
$nama = trim($_POST['nama'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');
$jenis_kelamin = $_POST['jenis_kelamin'] ?? '';
$agama = trim($_POST['agama'] ?? '');
$sekolah_asal = trim($_POST['sekolah_asal'] ?? '');

if ($id <= 0) {
    header('Location: list-siswa.php');
    exit;
}

// ambil data lama
$stmt = $pdo->prepare("SELECT foto FROM calon_siswa WHERE id = :id");
$stmt->execute([':id' => $id]);
$old = $stmt->fetch();

$foto_filename = $old['foto'] ?? null;
if (!empty($_FILES['foto']) && $_FILES['foto']['error'] !== UPLOAD_ERR_NO_FILE) {
    global $allowed_types;
    $file = $_FILES['foto'];
    if ($file['error'] !== UPLOAD_ERR_OK) {
        die("Error upload file.");
    }
    if ($file['size'] > MAX_FILE_SIZE) {
        die("Ukuran file terlalu besar.");
    }
    if (!in_array(mime_content_type($file['tmp_name']), $allowed_types)) {
        die("Tipe file tidak diizinkan.");
    }

    if (!is_dir(UPLOAD_DIR)) mkdir(UPLOAD_DIR,0755,true);
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $newname = time() . '_' . bin2hex(random_bytes(6)) . '.' . $ext;
    $dest = UPLOAD_DIR . $newname;
    if (!move_uploaded_file($file['tmp_name'], $dest)) {
        die("Gagal menyimpan file.");
    }

    // hapus foto lama jika ada
    if ($old && $old['foto']) {
        $oldpath = UPLOAD_DIR . $old['foto'];
        if (file_exists($oldpath)) @unlink($oldpath);
    }
    $foto_filename = $newname;
}

// update db
$sql = "UPDATE calon_siswa SET nama = :nama, alamat = :alamat, jenis_kelamin = :jk, agama = :agama, sekolah_asal = :sekolah_asal, foto = :foto WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':nama' => $nama,
    ':alamat' => $alamat,
    ':jk' => $jenis_kelamin,
    ':agama' => $agama,
    ':sekolah_asal' => $sekolah_asal,
    ':foto' => $foto_filename,
    ':id' => $id
]);

header('Location: list-siswa.php');
exit;
