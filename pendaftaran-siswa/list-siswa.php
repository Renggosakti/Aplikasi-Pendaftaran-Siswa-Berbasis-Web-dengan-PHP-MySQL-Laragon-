<?php
// list-siswa.php
require_once 'config.php';

$stmt = $pdo->query("SELECT * FROM calon_siswa ORDER BY id DESC");
$list = $stmt->fetchAll();
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Daftar Calon Siswa</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <div style="margin-bottom:12px">
      <a href="index.php" class="btn btn-ghost">← Dashboard</a>
      <a href="form-daftar.php" class="btn btn-primary" style="margin-left:8px">Tambah Baru</a>
    </div>

    <div class="card">
      <h3 style="margin-top:0">Siswa yang sudah mendaftar</h3>
      <table class="table" aria-describedby="daftar-siswa">
        <thead>
          <tr>
            <th>No</th>
            <th>Foto</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Jenis Kelamin</th>
            <th>Agama</th>
            <th>Sekolah Asal</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($list as $i => $row): ?>
          <tr>
            <td><?= $i+1 ?></td>
            <td>
              <?php if ($row['foto']): ?>
                <img src="<?= UPLOAD_DIR_WEB . htmlspecialchars($row['foto']) ?>" class="thumb" alt="foto">
              <?php else: ?>
                <div style="width:64px;height:64px;border-radius:8px;background:#f3f4f6;display:flex;align-items:center;justify-content:center;color:#9ca3af;font-size:12px">No Photo</div>
              <?php endif; ?>
            </td>
            <td><?= htmlspecialchars($row['nama']) ?></td>
            <td><?= htmlspecialchars($row['alamat']) ?></td>
            <td><?= htmlspecialchars($row['jenis_kelamin']) ?></td>
            <td><?= htmlspecialchars($row['agama']) ?></td>
            <td><?= htmlspecialchars($row['sekolah_asal']) ?></td>
            <td class="actions">
              <a class="edit" href="form-edit.php?id=<?= $row['id'] ?>">Edit</a>
              <a class="delete" href="hapus.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <p class="muted" style="margin-top:12px">Total: <?= count($list) ?></p>
    </div>
  </div>
</body>
</html>
