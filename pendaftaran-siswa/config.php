<?php
// ============================
// CONFIG.PHP
// ============================

// Konfigurasi koneksi database
$db_host = '127.0.0.1';
$db_name = 'pendaftaran_siswa';
$db_user = 'root';
$db_pass = 'seblak26'; // ✅ password MySQL kamu

// Opsi koneksi PDO
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,       // tampilkan error detail
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,  // hasil query berupa array asosiatif
    PDO::ATTR_EMULATE_PREPARES => false,               // keamanan anti SQL Injection
];

try {
    // Koneksi ke database
    $pdo = new PDO(
        "mysql:host=$db_host;dbname=$db_name;charset=utf8mb4",
        $db_user,
        $db_pass,
        $options
    );
} catch (PDOException $e) {
    // Jika gagal koneksi, tampilkan pesan error JSON
    http_response_code(500);
    die(json_encode([
        'status'  => 'error',
        'message' => 'Koneksi database gagal: ' . $e->getMessage()
    ]));
}

// ============================
// UPLOAD SETTINGS
// ============================

// Folder tempat menyimpan file upload (harus bisa ditulis)
define('UPLOAD_DIR', __DIR__ . '/uploads/'); // folder fisik di server
define('UPLOAD_DIR_WEB', 'uploads/');         // path untuk <img src="">
define('MAX_FILE_SIZE', 2 * 1024 * 1024);     // batas maksimal 2MB

// Jenis file yang diizinkan untuk upload
$allowed_types = [
    'image/jpeg',
    'image/png',
    'image/gif'
];

// Pastikan folder uploads sudah ada, kalau belum -> buat otomatis
if (!is_dir(UPLOAD_DIR)) {
    mkdir(UPLOAD_DIR, 0755, true);
}

// ============================
// API SECURITY (opsional, untuk endpoint API)
// ============================
$API_KEY = 'seblak26';

// Validasi API key (jika dibutuhkan di file API)
function check_api_key()
{
    global $API_KEY;
    $headers = getallheaders();

    if (!isset($headers['Authorization'])) {
        unauthorized();
    }

    $token = trim(str_replace('Bearer', '', $headers['Authorization']));
    if ($token !== $API_KEY) {
        unauthorized();
    }
}

function unauthorized()
{
    http_response_code(401);
    echo json_encode([
        'status' => 'error',
        'message' => 'Unauthorized: API key invalid'
    ]);
    exit;
}
?>
