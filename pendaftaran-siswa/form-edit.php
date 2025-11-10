<?php
// form-edit.php
require_once 'config.php';
$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) {
    header('Location: list-siswa.php');
    exit;
}
$stmt = $pdo->prepare("SELECT * FROM calon_siswa WHERE id = :id");
$stmt->execute([':id' => $id]);
$row = $stmt->fetch();
if (!$row) {
    header('Location: list-siswa.php');
    exit;
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Edit: <?= htmlspecialchars($row['nama']) ?></title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <div style="margin-bottom:12px">
      <a href="list-siswa.php" class="btn btn-ghost">← Kembali</a>
    </div>

    <div class="card">
      <h2 style="margin-top:0">Edit Data</h2>
      <form action="proses-edit.php" method="post" enctype="multipart/form-data" style="margin-top:14px">
        <input type="hidden" name="id" value="<?= $row['id'] ?>">
        <div class="form-group">
          <label>Nama</label>
          <input type="text" name="nama" value="<?= htmlspecialchars($row['nama']) ?>" required />
        </div>

        <div class="form-group">
          <label>Alamat</label>
          <textarea name="alamat" required><?= htmlspecialchars($row['alamat']) ?></textarea>
        </div>

        <div class="form-group" style="display:flex;gap:12px">
          <div style="flex:1">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" required>
              <option value="Laki-laki" <?= $row['jenis_kelamin']==='Laki-laki'?'selected':'' ?>>Laki-laki</option>
              <option value="Perempuan" <?= $row['jenis_kelamin']==='Perempuan'?'selected':'' ?>>Perempuan</option>
            </select>
          </div>
          <div style="flex:1">
            <label>Agama</label>
            <input type="text" name="agama" value="<?= htmlspecialchars($row['agama']) ?>" required />
          </div>
        </div>

        <div class="form-group">
          <label>Sekolah Asal</label>
          <input type="text" name="sekolah_asal" value="<?= htmlspecialchars($row['sekolah_asal']) ?>" required />
        </div>

        <div class="form-group">
          <label>Foto Saat Ini</label>
          <div style="margin-top:8px">
          <?php if ($row['foto']): ?>
            <img src="<?= UPLOAD_DIR_WEB . htmlspecialchars($row['foto']) ?>" class="thumb" alt="foto">
          <?php else: ?>
            <div style="width:64px;height:64px;border-radius:8px;background:#f3f4f6;display:flex;align-items:center;justify-content:center;color:#9ca3af;font-size:12px">No Photo</div>
          <?php endif; ?>
          </div>
        </div>

        <div class="form-group">
          <label>Ganti Foto (opsional)</label>
          <input type="file" name="foto" accept="image/*" />
        </div>

        <div style="display:flex;gap:10px">
          <button class="btn btn-primary" type="submit">Simpan</button>
          <a class="btn btn-ghost" href="list-siswa.php">Batal</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
