<?php
// form-daftar.php
require_once 'config.php';
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Formulir Pendaftaran</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <div style="margin-bottom:12px">
      <a href="index.php" class="btn btn-ghost">← Kembali</a>
    </div>

    <div class="card">
      <h2 style="margin-top:0">Formulir Pendaftaran Siswa Baru</h2>
      <form action="proses-pendaftaran.php" method="post" enctype="multipart/form-data" style="margin-top:14px">
        <div class="form-group">
          <label>Nama</label>
          <input type="text" name="nama" required />
        </div>

        <div class="form-group">
          <label>Alamat</label>
          <textarea name="alamat" required></textarea>
        </div>

        <div class="form-group" style="display:flex;gap:12px">
          <div style="flex:1">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" required>
              <option value="Laki-laki">Laki-laki</option>
              <option value="Perempuan">Perempuan</option>
            </select>
          </div>
          <div style="flex:1">
            <label>Agama</label>
            <input type="text" name="agama" required />
          </div>
        </div>

        <div class="form-group">
          <label>Sekolah Asal</label>
          <input type="text" name="sekolah_asal" required />
        </div>

        <div class="form-group">
          <label>Foto (jpg/png/gif) - max 2MB</label>
          <input type="file" name="foto" accept="image/*" id="fotoInput" />
          <div style="margin-top:8px">
            <img id="preview" src="#" alt="preview" style="display:none;width:150px;border-radius:8px;object-fit:cover;border:1px solid rgba(15,23,42,0.04)">
          </div>
        </div>

        <div style="display:flex;gap:10px">
          <button class="btn btn-primary" type="submit">Daftar</button>
          <a class="btn btn-ghost" href="list-siswa.php">Lihat Daftar</a>
        </div>
      </form>
    </div>
  </div>

<script>
  const input = document.getElementById('fotoInput');
  const preview = document.getElementById('preview');
  if (input) {
    input.addEventListener('change', function(){
      const file = this.files[0];
      if(!file){ preview.style.display='none'; return; }
      preview.src = URL.createObjectURL(file);
      preview.style.display = 'block';
    });
  }
</script>
</body>
</html>
