<?php
// proses-pendaftaran.php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: form-daftar.php');
    exit;
}

$nama = trim($_POST['nama'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');
$jenis_kelamin = $_POST['jenis_kelamin'] ?? '';
$agama = trim($_POST['agama'] ?? '');
$sekolah_asal = trim($_POST['sekolah_asal'] ?? '');

$errors = [];
if ($nama === '') $errors[] = "Nama wajib diisi.";
if ($alamat === '') $errors[] = "Alamat wajib diisi.";

$foto_filename = null;
if (!empty($_FILES['foto']) && $_FILES['foto']['error'] !== UPLOAD_ERR_NO_FILE) {
    global $allowed_types;
    $file = $_FILES['foto'];
    if ($file['error'] !== UPLOAD_ERR_OK) {
        $errors[] = "Error upload file.";
    } else {
        if ($file['size'] > MAX_FILE_SIZE) $errors[] = "Ukuran file terlalu besar (max 2MB).";
        if (!in_array(mime_content_type($file['tmp_name']), $allowed_types)) $errors[] = "Tipe file tidak diizinkan.";
    }

    if (empty($errors)) {
        if (!is_dir(UPLOAD_DIR)) mkdir(UPLOAD_DIR, 0755, true);
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $foto_filename = time() . '_' . bin2hex(random_bytes(6)) . '.' . $ext;
        $dest = UPLOAD_DIR . $foto_filename;
        if (!move_uploaded_file($file['tmp_name'], $dest)) $errors[] = "Gagal menyimpan file.";
    }
}

if (!empty($errors)) {
    echo "<div style='font-family:Inter,Arial,sans-serif;padding:20px'><h3>Terjadi kesalahan:</h3><ul>";
    foreach ($errors as $e) echo "<li>" . htmlspecialchars($e) . "</li>";
    echo "</ul><a href='form-daftar.php'>Kembali</a></div>";
    exit;
}

$sql = "INSERT INTO calon_siswa (nama, alamat, jenis_kelamin, agama, sekolah_asal, foto) VALUES (:nama, :alamat, :jk, :agama, :sekolah_asal, :foto)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':nama' => $nama,
    ':alamat' => $alamat,
    ':jk' => $jenis_kelamin,
    ':agama' => $agama,
    ':sekolah_asal' => $sekolah_asal,
    ':foto' => $foto_filename,
]);

header('Location: list-siswa.php');
exit;
